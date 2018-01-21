<?php

namespace Ranks;

use pocketmine\Player;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\player\PlayerChatEvent;

use pocketmine\utils\Config;

use CLACore\Core;

class Rank implements Listener{

    private $core;
    
    public function __construct(Core $plugin){
        $this->plugin = $plugin;
        
    }

    public function onLogin(PlayerLoginEvent $event) : void {
        $player = $event->getPlayer();
        $this->setRank($player);
    }

    public function onJoin(PlayerJoinEvent $event) : void {
        $player = $event->getPlayer();
        $this->setRank($player);
    }

    public function onRespawn(PlayerRespawnEvent $event) : void {
        $player = $event->getPlayer();
        $this->setRank($player);
    }

    public function setRank(Player $player) {
        $name = $player->getName();
        $config = new Config($this->core->getDataFolder() . "rank.yml", Config::YAML);
        $rank = $config->get($name);

        ## Default ##
        $default = $config->get("Default-Tag");
        $default = str_replace("{name}", $name, $default);
        $player->setNameTag($default);

        ## VIP ##
        if($rank == "VIP"){
            $vip = $config->get("VIP-Tag");
            $vip = str_replace("{name}", $name, $vip);
            $player->setNameTag($vip);
        }

        ## VIP+ ##
        if($rank == "VIP+"){
            $vipplus = $config->get("VIP+-Tag");
            $vipplus = str_replace("{name}", $name, $vipplus);
            $player->setNameTag($vipplus);
        }

        ## MVP ##
        if($rank == "MVP"){
            $mvp = $config->get("MVP-Tag");
            $mvp = str_replace("{name}", $name, $mvp);
            $player->setNameTag($mvp);
        }

        ## MVP+ ##
        if($rank == "MVP+"){
            $mvpplus = $config->get("MVP+-Tag");
            $mvpplus = str_replace("{name}", $name, $mvpplus);
            $player->setNameTag($mvpplus);
        }

        ## YouTuber ##
        if($rank == "YouTuber"){
            $yt = $config->get("YouTuber-Tag");
            $yt = str_replace("{name}", $name, $yt);
            $player->setNameTag($yt);
        }

        ## Creator ##
        if($rank == "Creator"){
            $creator = $config->get("Creator-Tag");
            $creator = str_replace("{name}", $name, $creator);
            $player->setNameTag($creator);
        }

        ## Owner ##
        if($rank == "Owner"){
            $owner = $config->get("Owner-Tag");
            $owner = str_replace("{name}", $name, $owner);
            $player->setNameTag($owner);
        }

        ## CoOwner ##
        if($rank == "CoOwner"){
            $coowner = $config->get("CoOwner-Tag");
            $coowner = str_replace("{name}", $name, $coowner);
            $player->setNameTag($coowner);
        }

        ## Admin ##
        if($rank == "Admin"){
            $admin = $config->get("Admin-Tag");
            $admin = str_replace("{name}", $name, $admin);
            $player->setNameTag($admin);
        }

        ## Mod ##
        if($rank == "Mod"){
            $mod = $config->get("Mod-Tag");
            $mod = str_replace("{name}", $name, $mod);
            $player->setNameTag($mod);
        }

        ## Developer ##
        if($rank == "Developer"){
            $devtag = $rankcfg->get("Developer-Tag");
            $devtag = str_replace("{name}", $name, $devtag);
            $player->setNameTag($devtag);
        }

        ## Helper ##
        if($rank == "Helper"){
            $helpertag = $rankcfg->get("Helper-Tag");
            $helpertag = str_replace("{name}", $name, $helpertag);
            $player->setNameTag($helpertag);
        }

        ## Staff ##
        if($rank == "Staff"){
            $stafftag = $rankcfg->get("Staff-Tag");
            $stafftag = str_replace("{name}", $name, $stafftag);
            $player->setNameTag($stafftag);
        }
    }

    public function onChat(PlayerChatEvent $e){
        $player = $e->getPlayer();
        $name = $player->getName();
        $msg = $e->getMessage();
        $rankcfg = new Config($this->core->getDataFolder() . "rank.yml", Config::YAML);
        $rank = $rankcfg->get($name);

        ## Default ##
        $defchat = $rankcfg->get("Default-Chat");
        $defchat = str_replace("{name}", $name, $defchat);
        $defchat = str_replace("{msg}", $msg, $defchat);
        $e->setFormat($defchat);

        ## VIP ##
        if($rank == "VIP"){
            $vipchat = $rankcfg->get("VIP-Chat");
            $vipchat = str_replace("{name}", $name, $vipchat);
            $vipchat = str_replace("{msg}", $msg, $vipchat);
            $e->setFormat($vipchat);
        }

        ## VIP+ ##
        elseif($rank == "VIP+"){
            $vippluschat = $rankcfg->get("VIP+-Chat");
            $vippluschat = str_replace("{name}", $name, $vippluschat);
            $vippluschat = str_replace("{msg}", $msg, $vippluschat);
            $e->setFormat($vippluschat);
        }

        ## MVP ##
        if($rank == "MVP"){
            $mvpchat = $rankcfg->get("MVP-Chat");
            $mvpchat = str_replace("{name}", $name, $mvpchat);
            $mvpchat = str_replace("{msg}", $msg, $mvpchat);
            $e->setFormat($mvpchat);
        }

        ## MVP+ ##
        elseif($rank == "MVP+"){
            $mvppluschat = $rankcfg->get("MVP+-Chat");
            $mvppluschat = str_replace("{name}", $name, $mvppluschat);
            $mvppluschat = str_replace("{msg}", $msg, $mvppluschat);
            $e->setFormat($mvppluschat);
        }

        ## YouTuber ##
        if($rank == "YouTuber"){
            $ytchat = $rankcfg->get("YouTuber-Chat");
            $ytchat = str_replace("{name}", $name, $ytchat);
            $ytchat = str_replace("{msg}", $msg, $ytchat);
            $e->setFormat($ytchat);
        }

        ## Creator ##
        if($rank == "Creator"){
            $creatorchat = $rankcfg->get("Creator-Chat");
            $creatorchat = str_replace("{name}", $name, $creatorchat);
            $creatorchat = str_replace("{msg}", $msg, $creatorchat);
            $e->setFormat($creatorchat);
        }

        ## Owner ##
        if($rank == "Owner"){
            $ownertag = $rankcfg->get("Owner-Chat");
            $ownertag = str_replace("{name}", $name, $ownertag);
            $ownertag = str_replace("{msg}", $msg, $ownertag);
            $e->setFormat($ownertag);
        }

        ## CoOwner ##
        if($rank == "CoOwner"){
            $coownerchat = $rankcfg->get("CoOwner-Chat");
            $coownerchat = str_replace("{name}", $name, $coownerchat);
            $coownerchat = str_replace("{msg}", $msg, $coownerchat);
            $e->setFormat($coownerchat);
        }

        ## Admin ##
        if($rank == "Admin"){
            $adminchat = $rankcfg->get("Admin-Chat");
            $adminchat = str_replace("{name}", $name, $adminchat);
            $adminchat = str_replace("{msg}", $msg, $adminchat);
            $e->setFormat($adminchat);
        }

        ## Mod ##
        if($rank == "Mod"){
            $modchat = $rankcfg->get("Mod-Chat");
            $modchat = str_replace("{name}", $name, $modchat);
            $modchat = str_replace("{msg}", $msg, $modchat);
            $e->setFormat($modchat);
        }

        ## Developer ##
        if($rank == "Developer"){
            $devchat = $rankcfg->get("Developer-Chat");
            $devchat = str_replace("{name}", $name, $devchat);
            $devchat = str_replace("{msg}", $msg, $devchat);
            $e->setFormat($devchat);
        }

        ## Helper ##
        if($rank == "Helper"){
            $helperchat = $rankcfg->get("Helper-Chat");
            $helperchat = str_replace("{name}", $name, $helperchat);
            $helperchat = str_replace("{msg}", $msg, $helperchat);
            $e->setFormat($helperchat);
        }

        ## Staff ##
        if($rank == "Staff"){
            $staffchat = $rankcfg->get("Staff-Chat");
            $staffchat = str_replace("{name}", $name, $staffchat);
            $staffchat = str_replace("{msg}", $msg, $staffchat);
            $e->setFormat($staffchat);
        }
    }
}
