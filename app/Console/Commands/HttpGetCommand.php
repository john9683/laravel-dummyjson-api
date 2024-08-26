<?php

namespace App\Console\Commands;

use App\Events\ErrorApiEvent;
use App\Services\HttpInterface;
use App\Services\ImageInterface;
use App\Services\LogInterface;
use App\Services\ProductInterface;
use App\Services\ReviewInterface;
use Illuminate\Console\Command;

class HttpGetCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:http-get-command {--category=smartphones} {--title=}';

    /**
     * @var string
     */
    protected $description = 'Получение списка товаров';

    /**
     * @param HttpInterface $httpService
     * @param ProductInterface $productService
     * @param ImageInterface $imageService
     * @param ReviewInterface $reviewService
     * @param LogInterface $logService
     * @return void
     */
    public function handle(
        HttpInterface $httpService,
        ProductInterface $productService,
        ImageInterface $imageService,
        ReviewInterface $reviewService,
        LogInterface $logService
    ) {
        $uri = env('API_DUMMYJSON_GET');

        $category = $this->option('category');
        $title = $this->option('title');

        $response = $httpService->httpGet(10, 10000, $uri . $category);

        if ($response->status() >= 400) {
            $this->error('Произошла ошибка, статус ответа: ' . $response->status());
            $logService->loggerHttpGet($uri . $category, $title, 0, $response->status());

            ErrorApiEvent::dispatch($uri . $category, 'GET', $response->status());

            return;
        }

        if ($title === null) {
            $productArray = json_decode(json_encode($response->json()["products"]), true);
        } else {
            $productArray = $productService->filterProduct($response->json(), $title);
        }

        $productObjectArray = $productService->createProductFromArray($productArray, $imageService, $reviewService);

        $logService->loggerHttpGet($uri . $category, $title, count($productObjectArray), $response->status());

        $messageCommand = 'В базу данных добавлено продуктов: ' . count($productObjectArray);

        if (count($productObjectArray) > 0) {
            $this->info($messageCommand);
        } else {
            $this->error($messageCommand);
            ErrorApiEvent::dispatch($uri . $category, 'GET', $response->status());
        }
    }
}
