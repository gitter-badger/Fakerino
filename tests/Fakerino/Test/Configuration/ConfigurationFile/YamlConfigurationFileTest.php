<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\Configuration\ConfigurationFile;

use Fakerino\Configuration\ConfigurationFile\YamlConfigurationFile;
use Fakerino\DataSource\File\File;

class YamlConfigurationFileTest extends \PHPUnit_Framework_TestCase
{
    public function testIniToArray()
    {
        $fileDir = __DIR__ . '/../../Fixtures/';
        $ymlFilePath = $fileDir . 'file.yml';
        $confFile = new File($ymlFilePath);
        $ymlConf = new YamlConfigurationFile();
        $ymlConf->loadConfiguration($confFile);
        $result = $ymlConf->toArray();

        $this->assertInternalType('array', $result);
        $this->assertNotEmpty($result);
    }
}