<?php

namespace Core\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class MakeModel extends Command
{
    protected static $defaultDescription = 'Create a new model for your Application.';
    protected static $defaultName = 'make:model';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $stubFile = __DIR__ . '/../Stubs/model.stub';

        $commandName = $input->getArgument('name');
        $className = $this->getCommandName($commandName);

        $contentStub = file_get_contents($stubFile);

        $contentStub = str_replace('{{ NAME }}', $className, $contentStub);
        $contentStub = str_replace('{{ TABLE }}', mb_strtolower($className), $contentStub);

        file_put_contents($this->getFilePath($className), $contentStub);

        return Command::SUCCESS;
    }

    protected function configure()
    {
        parent::configure();

        $this->addArgument('name', InputArgument::REQUIRED, 'The name of the Model');

    }


    private function getNamespace($argument): string
    {
        if (!str_contains($argument, '/') && !str_contains($argument, '\\')) {
            return config('console.default_namespace');
        }

        $argument = str_replace(["\\", "/"], ['/'], $argument);
        $argument = str_replace(config('console.default_namespace'), "", $argument);
        $argument = array_reverse(explode("/", $argument));

        array_shift($argument);

        return implode("\\", array_reverse($argument));
    }

    private function getCommandName($argument): string
    {
        $argument = str_replace(["\\", "/"], ['/'], $argument);
        return (string)array_reverse(explode("/", $argument))[0];
    }

    public function getFilePath($name)
    {
        if(!is_dir($dir = __DIR__.'/../../app/Models')){
            mkdir(directory: $dir, recursive: true);
        }

        return $dir . DIRECTORY_SEPARATOR . $name . '.php';
    }

}