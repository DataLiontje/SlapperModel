<?php


namespace DataLion\SlapperModels;


use DataLion\SlapperModels\utils\SetModelSession;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as C;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Player;
use slapper\entities\SlapperHuman;

class EventListener implements Listener
{
    public function onLeave(PlayerQuitEvent $event){
        $playerName = $event->getPlayer()->getName();

        $playerSession = SetModelSession::getPlayerSession($playerName);
        if($playerSession === null) return;

        $playerSession->destroy();
    }

    public function onSlapperHit(EntityDamageByEntityEvent $event){
        $damager = $event->getDamager();
        if(!$damager instanceof Player) return;

        $playerName = $damager->getName();

        // Get SetModelSession of Player
        $playerSession = SetModelSession::getPlayerSession($playerName);
        if($playerSession === null) return;

        $prefix = Main::getInstance()->prefix;

        $slapper = $event->getEntity();
        if(!$slapper instanceof SlapperHuman){
            $damager->sendMessage($prefix.C::RED."Entity must be Slapper human");
            return;
        }

        $skin = $playerSession->getNewSkin();

        $playerSession->destroy();

        $slapper->setSkin($skin);
        $slapper->sendSkin();
        $damager->sendMessage($prefix.C::GREEN."Model updated.");




    }


}