<?php

namespace com\yurisi\TreeCutter\Command;

use pocketmine\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use com\yurisi\TreeCutter\main;

class tcCommand extends Command{

    public function __construct(){
        parent::__construct("tc", "原木一括破壊のon/off", "/tc");
    }

    /**
     * @param CommandSender $sender
     * @param string $label
     * @param array $args
     * @return bool
     */
    public function execute(CommandSender $sender, string $label, array $args){
        if ($sender instanceof Player) {
            $tag = $sender->namedtag;
            if (main::isOn($sender)) {
				$tag->setInt(main::PLUGIN_NAME, 0);
				$sender->sendMessage("[TreeCutter]§aOFFにいたしました。");
            } else {
				$tag->setInt(main::PLUGIN_NAME, 1);
				$sender->sendMessage("[TreeCutter]§aONにしました。");
            }
        }
        return true;
    }
}