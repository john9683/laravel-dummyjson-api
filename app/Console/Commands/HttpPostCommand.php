<?php

namespace App\Console\Commands;

use App\Events\ErrorApiEvent;
use App\Services\HttpInterface;
use App\Services\LogInterface;
use Illuminate\Console\Command;

class HttpPostCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:http-post-command';

    /**
     * @var array
     */
    private static array $ATTRIBUTES = ['title' => 'newProduct'];

    /**
     * @param HttpInterface $httpService
     * @param LogInterface $logService
     * @return void
     */
    public function handle(HttpInterface $httpService, LogInterface $logService)
    {
        $uri = env('API_DUMMYJSON_POST');

        $response = $httpService->httpPost(10, 10000, $uri, self::$ATTRIBUTES);

        $logService->loggerHttpPost($response->status(), $uri, self::$ATTRIBUTES);

        if ($response->status() === 201) {
            $this->info('Запись успешно добавлена');
        } else {
            $this->error('Произошла ошибка, статус ответа: ' . $response->status());
            ErrorApiEvent::dispatch($uri, 'POST', $response->status());
        }
    }
}
