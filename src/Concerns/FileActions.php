<?php

namespace Andresdevr\Administratix\Concerns;

use Andresdevr\Administratix\Facades\ConsoleOutput;
use Illuminate\Support\Str;

trait FileActions
{
    /**
     * The clock
     *
     * @var array
     */
    protected $clock = [

    ];

    /**
     * Check if the file exists, if exists returns true, if not
     * throw an error, but if has the option, create the file
     * 
     * @param  string $filename
     * @return bool
     */
    protected function fileExists($filename, $createIfNotExists = false)
    {

    }
    
    /**
     * Replace the content of the file
     * 
     * @param  string $from
     * @param  string $to
     * @param  string $replacers
     * @return void
     */
    public function replaceFile($from, $to = null, $replacers = [])
    {
        $this->startCommand("Replacing", $to);

        $content = Str::of(file_get_contents($from));

        foreach($replacers as $search => $replace)
            $content = $content->replace($search, $replace);

        file_put_contents($to, (string) $content);

        $this->endCommand("Replaced", $to);
    }

    /**
     * Delete a file 
     * 
     * @param  string $filepathname
     * @return bool
     */
    public function deleteFile($filepathname)
    {

    }

    /**
     * Start the commnand
     * 
     * @param  string $action
     * @param  string $file
     * @return void
     */
    private function startClock($action, $file)
    {
        method_exists($this, 'getOutput') ?
            $this->writeln("<comment>{$action}:</comment>  {$file}") :
            ConsoleOutput::writeln("<comment>{$action}:</comment>  {$file}");

        $this->clock[$action] = microtime(true);
    }

    /**
     * end the command
     * 
     * @return void
     */
    private function endClock($action, $file)
    {
        $runTime = number_format((microtime(true) - $this->clock[$action]) * 1000, 2);

        method_exists($this, 'getOutput') ?
            $this->writeln("<info>{$action}:</info>   {$file} ({$runTime}ms)") :
            ConsoleOutput::writeln("<info>{$action}:</info>   {$file} ({$runTime}ms)");
    }

}