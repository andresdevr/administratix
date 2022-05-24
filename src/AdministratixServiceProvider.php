<?php

namespace Andresdevr\Administratix;

use Andresdevr\Administratix\Providers\ServiceProvider;
use Symfony\Component\Console\Output\ConsoleOutput;

class AdministratixServiceProvider extends ServiceProvider
{
    /**
     * Register the singletons
     * 
     * @return array
     */
    public function singletons() : array
    {
        return [
            'console-output' => fn($app) => new ConsoleOutput()
        ];
    }

    /**
     *  Register the binds
     * 
     * @return array
     */
    public function binds() : array
    {
        return [

        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->configurations(__DIR__ . "/../config");
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerSingletons($this->singletons());
        $this->registerBinds($this->binds());
    }

}