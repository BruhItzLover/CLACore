<?php
namespace CLACore;
use Events\onKickEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\Textformat as C;
#Commands
use CLACore\Commands\Ping;
use CLACore\Commands\hub;
#Events
use Events\onRespawnEvent;
use Events\onJoinEvent;
use Events\onLoginEvent;
use Ranks\Rank;
class Core extends PluginBase{

    public $cfg;
    private $onRespawnEvent;
    private $onJoinEvent;
    private $onLoginEvent;
    private $onKickEvent;

    public function onEnable(){
        $this->onConfig();
        $this->onEvent();
        $this->onCommands();
        $this->getLogger()->info(C::GREEN."Enabled.");
    }
    public function onDisable(){
        $this->getLogger()->info(C::RED."Disabled.");
    }
    public function onConfig(){
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->saveResource("rank.yml");
        $this->saveResource("title.yml");
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }
    public function onEvent(){
        if($this->cfg->get("Allow-Rank") == true){
            $this->getServer()->getPluginManager()->registerEvents(($this->Rank = new Rank($this)), $this);
        }
        $this->getServer()->getPluginManager()->registerEvents(($this->onRespawnEvent = new onRespawnEvent($this)), $this);
        $this->getServer()->getPluginManager()->registerEvents(($this->onJoinEvent = new onJoinEvent($this)), $this);
        $this->getServer()->getPluginManager()->registerEvents(($this->onLoginEvent = new onLoginEvent($this)), $this);
        $this->getServer()->getPluginManager()->registerEvents(($this->onKickEvent = new onKickEvent($this)), $this);
    }
    private function onCommands(){
        $this->getServer()->getCommandMap()->register("hub", new hub("hub", $this));
        $this->getServer()->getCommandMap()->register("ping", new Ping("ping", $this));
    }
}