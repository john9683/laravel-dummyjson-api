<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class LogService implements LogInterface
{
    /**
     * @param string $uri
     * @param string|null $title
     * @param int $count
     * @param int $responseStatus
     * @return void
     */
    public function loggerHttpGet(string $uri, ?string $title, int $count, int $responseStatus): void
    {
        $messageLog = $uri . '; имя товара: ' . ($title == null ? 'все товары' : $title)
            . '; результат: в базу данных добавлено продуктов: ' . $count;

        $log = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/api.log'),
        ]);

        if ($count > 0) {
            $log->info($messageLog);
        } else {
            $log->error($messageLog . ' статус ответа: ' . $responseStatus);
        }
    }

    /**
     * @param int $responseStatus
     * @param string $uri
     * @param array $attributes
     * @return void
     */
    public function loggerHttpPost(int $responseStatus, string $uri, array $attributes): void
    {
        $messageLog = $responseStatus === 201
            ? $uri . '; продукт: ' . $attributes['title'] . ' - успешно добавлен'
            : $uri . '; продукт: ' . $attributes['title'] . ' - произошла ошибка, статус ответа: ' . $responseStatus;

        $log = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/api.log'),
        ]);

        if ($responseStatus === 201) {
            $log->info($messageLog);
        } else {
            $log->error($messageLog);
        }
    }
}
