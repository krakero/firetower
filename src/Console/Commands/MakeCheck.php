<?php

namespace Krakero\FireTower\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeCheck extends GeneratorCommand
{
    public $signature = 'make:firetower-check {name}';

    public $description = 'Generates a new FireTower Check';

    public $type = 'Check';

    public function handle(): int
    {
        if (parent::handle() === false) {
            return false;
        }

        return self::SUCCESS;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/../../../resources/stubs/check.php.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if (!is_dir(app_path('Checks'))) {
            mkdir(app_path('Checks'));
        }

        return $rootNamespace . '\\Checks';
    }
}
