<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino;

use Fakerino\Configuration\ConfigurationFile\Helper\FileConfigurationLoaderFactory;
use Fakerino\Configuration\FakerinoConf;
use Fakerino\Core\FakeDataFactory;

/**
 * Class Fakerino,
 * initialize the system.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class Fakerino
{
    /**
     * @var array
     */
    private static $fakerinoConf = null;

    /**
     * @param null|string $configFilePath
     *
     * @return FakeDataFactory
     */
    static public function create($configFilePath = null)
    {
        self::$fakerinoConf = new FakerinoConf();
        if (!is_null($configFilePath)) {
            $confTypeFactory = new FileConfigurationLoaderFactory(
                $configFilePath,
                self::$fakerinoConf->get('supportedConfExts')
            );
            $confParser = $confTypeFactory->load();
            $conf = $confParser->toArray();
            self::$fakerinoConf->loadConfiguration($conf);
        }

        return new FakeDataFactory(self::$fakerinoConf);
    }

    /**
     * Get the global configuration.
     * 
     * @return array
     */
    static public function getConfig()
    {
        return self::$fakerinoConf->toArray();
    }
}
