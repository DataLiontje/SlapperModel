<?php

declare(strict_types=1);

namespace DataLion\SlapperModels;

use DataLion\SlapperModels\commands\SetSlapperModelCommand;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase{

    /** @var Main */
    private static $instance;

    public $prefix;

    /**
     * @return Main
     */
    public static function getInstance(): Main
    {
        return self::$instance;
    }

	public function onEnable() : void{
        // Set Prefix
        $this->prefix = C::GREEN."[".C::YELLOW.$this->getName().C::GREEN."] ";

        // Define main instance property
        self::$instance = $this;

        // Register EventListener
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);

		// Register Command
        $this->getServer()->getCommandMap()->register("setslappermodel", new SetSlapperModelCommand("setslappermodel", $this));

        // Save Resources
        $this->saveResource("Models/ExampleDog.json");
        $this->saveResource("Textures/ExampleDog.png");
        $this->saveResource("models.json");



	}

}
