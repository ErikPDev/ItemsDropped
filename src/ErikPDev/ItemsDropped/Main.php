<?php

declare(strict_types=1);

namespace ErikPDev\ItemsDropped;

use ErikPDev\ItemsDropped\entity\Item;
use pocketmine\entity\Entity;
use pocketmine\entity\object\ItemEntity;
use pocketmine\plugin\PluginBase;


class Main extends PluginBase {

    public function onEnable()
    {
        Entity::registerEntity(Item::class, true, ["Item", "minecraft:item"]);
    }
}