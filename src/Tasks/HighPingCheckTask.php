<?php

namespace Tasks;

use CLACore\Core;
use pocketmine\scheduler\PluginTask;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as C;

class HighPingCheckTask extends PluginTask {

    private $plugin;

    public function __construct(Core $plugin){
        $this->plugin = $plugin;
        $this->plugin->getScheduler()->scheduleRepeatingTask(new $this($this->plugin), 100);
        parent::__construct($plugin);
    }

    public  function onRun(int $currentTick){
        $config = new Config($this->plugin->getDataFolder()."config.yml", Config::YAML);
        foreach (Server::getInstance()->getOnlinePlayers() as $players){
            if ($players->getPing() > $config->get("Max-Ping")){
                $players->kick(C::RED . "You have been removed from the game because you have a high ping", false);
            }
        }
    }
}
