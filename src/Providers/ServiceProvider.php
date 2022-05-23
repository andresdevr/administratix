<?php

namespace Andresdevr\Administratix\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider as Base;
use Livewire\Livewire;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewFactory;
use Illuminate\Support\Str;


abstract class ServiceProvider extends Base
{
    /**
     * Register the livewire components
     *
     * @param array $components
     * @param string $prefix
     * @return void
     */
    protected function livewire(array $components, $prefix = '')
    {
        foreach($components as $alias => $component)
        {
            Livewire::component($prefix . $alias, $component);
        }
    }

    /**
     * Register variable helpers
     *
     * @return void
     * @param array $composers
     * @example [
     *              ['*' => \Composer::class],
     *              ['*' => \Composer::class]
     *          ]
     */
    protected function viewComposers(array $composers)
    {
        foreach($composers as $composer)
        {
            foreach(Arr::wrap($composer) as $variable => $class)
            {
                View::composer($variable, $class);
            }
        }
    }

    /**
     * Load configuration files
     *
     * @param string $folder
     * @return void
     */
    protected function configurations(string $folder)
    {
        foreach(File::allFiles($folder) as $file)
        {
            $this->mergeConfigFrom($file->getPathname(), $file->getFilenameWithoutExtension());
        }
    }

    /**
     * load the rules
     *
     * @param  array $rules
     * @return void
     */
    protected function rules(array $rules)
    {
        foreach($rules as $name => $rule)
        {
            Validator::extend($name, function($attribute, $value, $parameters, $validator) use ($rule) {
                return $this->app->make($rule, $parameters)->passes($attribute, $value);
            });
        }
    }

    /**
     * load middlewares
     *
     * @return void
     */
    protected function middlewares(array $middlewares)
    {
        foreach($middlewares as $alias => $middleware)
        {
            $this->app['router']->aliasMiddleware($alias, $middleware);
        }
    }

    /**
     * Register middlware groups
     *
     * @return void
     */
    protected function middlewareGroups(array $middlewareGroups)
    {
        foreach($middlewareGroups as $group => $middlewares)
        {
            $this->app['router']->middlewareGroup($group, $middlewares);
        }
    }

    /**
     * Register the components views via variable helpers
     *
     * @param  array $components
     * @return void
     */
    public function componentVariables(array $components, $prefix = '')
    {
        foreach($components as $name => $component)
        {
            if(is_array($component))
            {
                $this->componentVariables($component, $prefix . ucfirst($name));
            }
            else
            {
                View::composer('*', function(ViewFactory $view) use ($prefix, $name, $component) {
                    $view->with((string) Str::of($name)->ucfirst()->start($prefix)->start("component"), $component);
                });
            }
        }
    }
}