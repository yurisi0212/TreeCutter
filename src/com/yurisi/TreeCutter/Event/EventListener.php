<?php

namespace com\yurisi\TreeCutter\Event;

use com\yurisi\TreeCutter\main;
use pocketmine\block\Block;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\math\Vector3;

class EventListener implements Listener{

	private $flag;

	/**
	 * @param $event BlockBreakEvent
	 * @return bool
	 * @priority MONITOR
	 */
	public function onBreak(BlockBreakEvent $event){
		$x = $event->getBlock()->getFloorX();
		$y = $event->getBlock()->getFloorY();
		$z = $event->getBlock()->getFloorZ();
		$id = $event->getBlock()->getId();
		$name = $event->getPlayer()->getName();
		if ($this->flag[$name] === null or $this->flag[$name] === false) {
			if (main::isOn($event->getPlayer())) {
				if (!($event->isCancelled())) {
					if ($y <= 0) {
						$event->setCancelled();
						return true;
					}
					if ($id === 17 or $id === 162) {
						if ($event->getBlock()->getSide(Vector3::SIDE_DOWN)->getId() === $id) {
							$event->getPlayer()->sendPopup("[TreeCutter]§a木は下から堀りましょう");
							$event->setCancelled();
							return true;
						} else {
							$this->flag[$name] = true;
							$n = 1;
							$item=$event->getPlayer()->getInventory()->getItemInHand();
							while ($event->getPlayer()->getLevel()->getBlock(new Vector3($x, $y + $n, $z))->getId() === $id) {
								$event->getPlayer()->getLevel()->useBreakOn(new Vector3($x, $y + $n, $z),$item , $event->getPlayer(), true);
								$n++;
							}
							$this->flag[$name]=false;
						}
					}
				}
			}
		}
		return true;
	}
}