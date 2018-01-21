<?php

declare(strict_types=1);

namespace CLACore;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;
use pocketmine\utils\Textformat as C;

#Commands
use Commands\Ping;
use Commands\Spawn;
use Commands\Fly;

#Economy
use Commands\AddMoney;
use Commands\Money;
use Commands\SeeMoney;
use Commands\SetMoney;
use Commands\TakeMoney;

#Events
use Events\onRespawnEvent;
use Events\onJoinEvent;
use Events\onLoginEvent;
use Events\onExhaustEvent;
use Events\onMoveEvent;

#Rank
use Ranks\Rank;

#Tasks
use Tasks\HighPingCheckTask;

class Core extends PluginBase{

    public $cfg;
    public $money;

    public function onEnable() : void {
        $this->registerConfigs();
        $this->registerEvents();
        $this->registerCommands();
        $this->registerEconomy();
        $this->registerTasks();
        $this->getLogger()->info(C::GREEN . "Enabled");
    }

    public function onDisable() : void {
        $this->getLogger()->info(C::RED . "Disabled");
    }

    public function registerConfigs() {
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->saveResource("rank.yml");
        $this->saveResource("title.yml");
        $this->saveResource("money.yml");
        $this->money = new Config($this->getDataFolder() . "money.yml", Config::YAML);
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
   }

    public function registerEvents() {
        if($this->config->get("Allow-Rank") == true) {
            new Rank($this);
        }
        new onRespawnEvent($this);
        new onJoinEvent($this);
        new onLoginEvent($this);
        new onExhaustEvent($this);
        new onMoveEvent($this);
    }

    private function registerCommands() {
        new Spawn($this);
        new Ping($this);
        new Fly($this);
    }

    private function registerEconomy() {
        if($this->cfg->get("Allow-Money") == true) {
            new AddMoney($this);
            new TakeMoney($this);
            new SetMoney($this);
            new SeeMoney($this);
            new Money($this);
        }
    }

    private function registerTasks(){
        if ($this->cfg->get("Enable-HighPingKick") == true){
            new HighPingCheckTask($this);
        }
    }

    public function myMoney(Player $player){
        return $this->money->get(strtolower($player->getName()));
    }

    public function reduceMoney(Player $player, Integer $money) {
        $this->money->set(strtolower($player->getName()), (int)$this->money->get(strtolower($player->getName())) - $money);
        $this->money->save();
        return true;
    }

    public function addMoney($player, $money) {
        $this->money->set(strtolower($player->getName()), (int)$this->money->get(strtolower($player->getName())) + $money);
        $moneyconf->save();
        return true;
    }
}
