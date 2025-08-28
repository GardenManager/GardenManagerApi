<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Config;

class ConfigLocationResolver
{
    /**
     * @param array<int, string> $additionalConfigFileMap Additional files that used to generate
     * a list of loaded config files. each file needs a priority defined as the key of the array.
     * Example:
     * <pre>
     * [
     *     // This file gets loaded last (if you have many config file, it's recommended to start with a high priority)
     *     1000 => '/var/config/generated_prod_config.php'
     * ]
     * </pre>
     */
    public function __construct(
        private readonly string $configPath,
        private readonly string $environment,
        private readonly array $additionalConfigFileMap = []
    )
    {
    }

    /**
     * The order of resolution:
     *  - Files in app/config folder
     *  - Files in app/$env folder
     * Each file gets assigned a priority starting from 0 and increment by one on each new file.
     */
    public function resolveByEnvironment()
    {
        $configFiles                   = $this->listFilesInDirectory($this->configPath);
        $environmentSpecificConfigPath = $this->configPath  . '/' . $this->environment;

        if (is_dir($environmentSpecificConfigPath) && is_readable($environmentSpecificConfigPath)) {
            $configFiles = array_merge($configFiles, $this->listFilesInDirectory($environmentSpecificConfigPath));
        }

        return array_merge($configFiles, $this->additionalConfigFileMap);
    }

    /**
     * @param string $directory
     *
     * @return array<string>
     */
    private function listFilesInDirectory(string $directory): array
    {
        $directoryIterator = new \DirectoryIterator($directory);
        $configFiles       = [];

        foreach ($directoryIterator as $file) {
            if ($file->isFile() && $file->isReadable() && $file->getExtension() === 'php') {
                $configFiles[] = $file->getRealPath();
            }
        }

        return $configFiles;
    }
}
