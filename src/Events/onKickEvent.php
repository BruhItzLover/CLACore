<?php

namespace Events;

use pocketmine\event\Listener;
use CLACore\Core;
use pocketmine\event\player\PlayerKickEvent;
use pocketmine\utils\TextFormat as C;

class onKickEvent implements Listener{

    private $core;

    public function __construct(Core $core){
        $this->core = $core;
    }

    public function onKick(PlayerKickEvent $e){
        $p = $e->getPlayer();
        $ping = $p->getPing();
        if($ping > 350){
            $p->kick(C::RED . "You have been removed from the game because you have a high ping");
        }
    }
}