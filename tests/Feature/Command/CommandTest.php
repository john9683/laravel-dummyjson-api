<?php

namespace Command;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CommandTest extends TestCase
{
    /**
     * @var string
     */
    private static string $GET_COMMAND = 'app:http-get-command';

    /**
     * @var string
     */
    private static string $OPTION = ' --title=iPhone';

    /**
     * @var string
     */
    private static string $POST_COMMAND = 'app:http-post-command';

    /**
     * @var string
     */
    private static string $TITLE = '%iPhone%';

    /**
     * @return void
     */
    public function test_http_get_with_title_command(): void
    {
        system('php artisan ' . self::$GET_COMMAND . self::$OPTION);

        $countProduct = DB::table('products')->where('title', 'like', self::$TITLE)->count();
        $countProduct =  $countProduct !== 0 ? $countProduct : 'ERROR';

        $this->artisan(self::$GET_COMMAND . self::$OPTION)
            ->expectsOutput( 'В базу данных добавлено продуктов: ' . $countProduct)
            ->assertExitCode(0);
    }

    /**
     * @return void
     */
    public function test_http_get_all_command(): void
    {
        system('php artisan ' . self::$GET_COMMAND);

        $countProduct = DB::table('products')->count();
        $countProduct =  $countProduct !== 0 ? $countProduct : 'ERROR';

        $this->artisan(self::$GET_COMMAND)
            ->expectsOutput( 'В базу данных добавлено продуктов: ' . $countProduct)
            ->assertExitCode(0);
    }

    /**
     * @return void
     */
    public function test_http_post_command(): void
    {
        $this->artisan(self::$POST_COMMAND)
            ->expectsOutput( 'Запись успешно добавлена')
            ->assertExitCode(0);
    }
}
