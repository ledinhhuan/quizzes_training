<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\Interfaces\TopicRepository::class, \App\Repositories\Eloquents\TopicRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\QuestionRepository::class, \App\Repositories\Eloquents\QuestionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\AnswerRepository::class, \App\Repositories\Eloquents\AnswerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\UserRepository::class, \App\Repositories\Eloquents\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ResultRepository::class, \App\Repositories\Eloquents\ResultRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\TestResultRepository::class, \App\Repositories\Eloquents\TestResultRepositoryEloquent::class);
        //:end-bindings:
    }
}
