<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\FakeHandler;

/**
 * Class CustomFakerClass,
 * processes the request to the custom classes,
 * if defined.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class CustomFakerClass extends Handler
{
    /**
     * @var array custom class container
     */
    private static $defaultClasses = array();

    /**
     * {@inheritdoc}
     */
    protected function process($data)
    {
        $this->setUpDefaultClass();
        $elementName = strtolower($data->getName());
        if (in_array(ucfirst($elementName), self::$defaultClasses)) {

            return $this->getOutput($this->getDataClass($elementName), $data->getOptions());
        }

        return;
    }

    private function setUpDefaultClass()
    {
        $customFileDir = __DIR__
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR
            . 'FakeData'
            . DIRECTORY_SEPARATOR
            . 'Custom';

        foreach (new \DirectoryIterator($customFileDir) as $file) {
            if ($file->isDot()) {
                continue;
            }
            $classFile = $file->getFilename();
            self::$defaultClasses[] = str_replace('.php', '', $classFile);
        }
    }

    private function getDataClass($className)
    {
        return 'Fakerino\\FakeData\\Custom\\' . ucfirst($className);
    }
}