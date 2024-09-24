<?php

declare(strict_types=1);

namespace kanteejump;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class SparkFactions extends PluginBase
{
    use SingletonTrait;

    protected function onLoad(): void
    {
        if (!is_dir($this->getDataFolder())) {
            mkdir($this->getDataFolder());
        }
        self::setInstance($this);
    }
}
