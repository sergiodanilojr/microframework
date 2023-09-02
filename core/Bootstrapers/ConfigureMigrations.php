<?php

namespace Core\Bootstrapers;

use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\Configuration;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\Configuration\Migration\ExistingConfiguration;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Metadata\Storage\TableMetadataStorageConfiguration;
use Doctrine\Migrations\Tools\Console\Command;
use Symfony\Component\Console\Application;

class ConfigureMigrations
{
    private ?DependencyFactory $dependencyFactory;

    public static function initialize(Application &$application)
    {
        $application->addCommands((new self)->bootstrap()->commands());
    }

    private function connection()
    {
        $databaseConnection = config('database.connection');

        $databaseConfig = config("database.connections.$databaseConnection");

        return DriverManager::getConnection([
            'dbname' => $databaseConfig['database'],
            'user' => $databaseConfig['username'],
            'password' => $databaseConfig['password'],
            'host' => $databaseConfig['host'],
            'driver' => "pdo_{$databaseConfig['driver']}",
        ]);
    }

    private function bootstrap(): self
    {
        // dd(config('database.migrations.path'));
        $configuration = new Configuration($connection = $this->connection());

        $configuration->addMigrationsDirectory(
            config('database.migrations.namespace'),
            config('database.migrations.path')
        );

        $configuration->setAllOrNothing(true);
        $configuration->setCheckDatabasePlatform(false);

        $storageConfiguration = new TableMetadataStorageConfiguration();
        $storageConfiguration->setTableName(config('database.migrations.table'));

        $configuration->setMetadataStorageConfiguration($storageConfiguration);

        $this->dependencyFactory = DependencyFactory::fromConnection(
            new ExistingConfiguration($configuration),
            new ExistingConnection($connection)
        );

        return $this;
    }

    private function commands(): array
    {
        return [
            new Command\DumpSchemaCommand($this->dependencyFactory),
            new Command\ExecuteCommand($this->dependencyFactory),
            new Command\GenerateCommand($this->dependencyFactory),
            new Command\LatestCommand($this->dependencyFactory),
            new Command\ListCommand($this->dependencyFactory),
            new Command\MigrateCommand($this->dependencyFactory),
            new Command\RollupCommand($this->dependencyFactory),
            new Command\StatusCommand($this->dependencyFactory),
            new Command\SyncMetadataCommand($this->dependencyFactory),
            new Command\VersionCommand($this->dependencyFactory),
        ];
    }
}