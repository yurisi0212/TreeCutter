<?php

namespace com\yurisi\TreeCutter;

use com\yurisi\TreeCutter\Command\tcCommand;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

use com\yurisi\TreeCutter\Event\EventListener;

class main extends PluginBase implements Listener{

    /**
     * @var string
     */
    public $plugin="TreeCutter";

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(),$this);
        $this->getServer()->getCommandMap()->register("tc", new tcCommand());
        $this->getLogger()->info("§bTreeCutterを開きました");
    }

    /**
     * @param Player $player
     * @return bool
     */
    public static function isOn(Player $player){
        $tag = $player->namedtag;
        if (!$tag->offsetExists("TreeCutter")) {
            return false;
        }
        if ($tag->getInt("TreeCutter") == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function onDisable() {
        $this->getLogger()->info("§aTreeCutterを閉じました");
    }
}