<?php

namespace App\Providers;

use App\Http\Abstraction\Classes\UserTransformerClass;
use App\Http\Abstraction\Classes\ValidatingUserClass;
use App\Http\Abstraction\Factories\UsersDTOFactory;
use App\Http\Abstraction\Interfaces\UsersRepositoryInterface;
use App\Http\Abstraction\Interfaces\UserTransformInterface;
use App\Http\Abstraction\Interfaces\ValidatingUserInterface;
use App\Http\Abstraction\Repositories\UsersRepository;
use Illuminate\Support\ServiceProvider;
use pcrov\JsonReader\JsonReader;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UsersRepositoryInterface::class, function () {
            return new UsersRepository(new JsonReader(), request()->get('provider'));
        });
        $this->app->bind(UserTransformInterface::class, function () {
            return new UserTransformerClass();
        });
        $this->app->bind(ValidatingUserInterface::class, function (){
            return new ValidatingUserClass(
                UsersDTOFactory::create(array_keys(config('data_providers'))[0], [])
            );
        });
    }
}
