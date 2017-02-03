<?php

use App\User;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://laravel.dev';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
//        putenv('DB_DEFAULT=mysql_test');

        $app = require __DIR__ . '/../../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();


        $this->baseUrl = env('URL_BASE', $this->baseUrl);
//        $this->baseUrl = (app()->environment()=='local' ? getenv('APP_BASE') : config('app.url'));
//        $this->baseUrl .= App::getLocale()."/";


        return $app;
    }


    /**
     * Migrates the database and set the mailer to 'pretend'.
     * This will cause the tests to run quickly.
     *
     */
    private function prepareForTests()
    {
        Artisan::call('migrate');
        Mail::pretend(true);
    }

    /**@param  string $table
     * @param  array $data
     * @param  string $connection
     * @return $this
     */
    protected function seeIsNotSoftDeletedInDatabase($table, array $data, $connection = null)
    {
        $database = $this->app->make('db');

        $connection = $connection ?: $database->getDefaultConnection();

        $count = $database->connection($connection)
            ->table($table)
            ->where($data)
            ->whereNull('deleted_at')
            ->count();

        $this->assertGreaterThan(0, $count, sprintf(
            'Found unexpected records in database table [%s] that matched attributes [%s].', $table, json_encode($data)
        ));

        return $this;
    }

    /**
     * Assert that a given where condition matches a soft deleted record
     *
     * @param  string $table
     * @param  array $data
     * @param  string $connection
     * @return $this
     */
    protected function seeIsSoftDeletedInDatabase($table, array $data, $connection = null)
    {
        $database = $this->app->make('db');

        $connection = $connection ?: $database->getDefaultConnection();

        $count = $database->connection($connection)
            ->table($table)
            ->where($data)
            ->whereNotNull('deleted_at')
            ->count();

        $this->assertGreaterThan(0, $count, sprintf(
            'Found unexpected records in database table [%s] that matched attributes [%s].', $table, json_encode($data)
        ));

        return $this;
    }

    /**
     * @param User $newUser
     */
    public function logWithUser(User $newUser){
        Auth::loginUsingId($newUser->id);
        Lang::setLocale($newUser->locale);
    }
}