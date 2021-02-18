<?php


namespace DataLion\SlapperModels\commands;


use DataLion\SlapperModels\Main;
use DataLion\SlapperModels\utils\ModelLoader;
use DataLion\SlapperModels\utils\SetModelSession;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat as C;

class SetSlapperModelCommand extends PluginCommand
{
    public function __construct(string $name, Plugin $owner)
    {
        parent::__construct($name, $owner);
        $this->setPermission("slappermodels.command.setslappermodel");
        $this->setDescription("Set Slapper human model");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $prefix = Main::getInstance()->prefix;
        // Making sure Sender is a player
        if(!$sender instanceof Player){
            $sender->sendMessage($prefix.C::RED."This command can only be used in-game.");
            return;
        }

        if(!isset($args[0])){
            $sender->sendMessage($prefix.C::GRAY."Usage: ".C::WHITE."/".$this->getName()." <modelName>");
            return;
        }

        // Destroy session if player session already exists
        $playerSession = SetModelSession::getPlayerSession($sender->getName());
        if($playerSession !== null){
            $playerSession->destroy();
        }


        $modelName = $args[0];
        $skin = ModelLoader::loadModel($modelName);
        if($skin === null){
            $sender->sendMessage($prefix.C::RED."Couldn't find or load Model make sure you have configured: \"models.json\" in the plugin_data right.");
            return;
        }

        new SetModelSession($sender->getName(), $skin);
        $sender->sendMessage($prefix.C::GREEN."Hit a slapper human to change the model.");

    }
}