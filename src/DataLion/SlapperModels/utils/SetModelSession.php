<?php


namespace DataLion\SlapperModels\utils;


use pocketmine\entity\Skin;
use pocketmine\Player;

class SetModelSession
{
    /** @var SetModelSession[] */
    private static $sessions = [];

    /** @var string */
    private $playerName;

    /** @var Skin */
    private $newSkin;

    /**
     * SetModelSession constructor.
     * @param string $playerName
     * @param Skin $newSkin
     */
    public function __construct(string $playerName, Skin $newSkin)
    {
        $this->playerName = $playerName;
        $this->newSkin = $newSkin;

        self::$sessions[] = $this;
    }

    /**
     * @return string
     */
    public function getPlayerName(): string
    {
        return $this->playerName;
    }

    /**
     * @return Skin
     */
    public function getNewSkin(): Skin
    {
        return $this->newSkin;
    }

    public function destroy(){
        $sessions = self::$sessions;
        $newSessions = [];
        foreach ($sessions as $session){
            if($session !== $this) $newSessions[] = $session;
        }
        self::$sessions = $newSessions;
    }

    /**
     * @return SetModelSession[]
     */
    public static function getSessions(): array
    {
        return self::$sessions;
    }

    /**
     * @param string $username
     * @return SetModelSession|null
     */
    public static function getPlayerSession(string $username): ?SetModelSession
    {
        $sessions = self::$sessions;

        foreach ($sessions as $session){
            if($session->getPlayerName() === $username) return $session;
        }

        return null;
    }





}