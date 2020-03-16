<?php

namespace com\yurisi\TreeCutter;

use com\yurisi\TreeCutter\Command\tcCommand;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

use com\yurisi\TreeCutter\Event\EventListener;

class main extends PluginBase implements Listener{

    const PLUGIN_NAME="TreeCutter";

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(),$this);
        $this->getServer()->getCommandMap()->register("tc", new tcCommand());
        $this->getLogger()->info("§b".self::PLUGIN_NAME."を開きました");
    }

    /**
     * @param Player $player
     * @return bool
     */
    public static function isOn(Player $player):bool{
        $tag=$player->namedtag;
		if (!$tag->offsetExists("TreeCutter")) {
			return false;
		}
        return ($tag->getInt(self::PLUGIN_NAME) === 1);
    }

    public function onDisable() {
        $this->getLogger()->info("§a".self::PLUGIN_NAME."を閉じました");
    }
}