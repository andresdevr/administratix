<?php


namespace Andresdevr\Administratix\Console;

use Andresdevr\Administratix\Concerns\FileActions;
use Illuminate\Console\Command;

class Installer extends Command
{
    use FileActions;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:install';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the installer adding the administratix stuff in your app';
 
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->copyResources();
    }

    /**
     * Copy the resources
     * 
     * @return void
     */
    public function copyResources()
    {
        $this->copyDirectory(__DIR__ . '/../../resources/administratix', resource_path(''));
    }
}