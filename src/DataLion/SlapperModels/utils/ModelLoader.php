<?php


namespace DataLion\SlapperModels\utils;


use DataLion\SlapperModels\Main;
use pocketmine\entity\Skin;
use pocketmine\utils\UUID;

class ModelLoader
{
    public static function loadModel(string $name): ?Skin
    {
        $modelList = json_decode(file_get_contents(Main::getInstance()->getDataFolder()."models.json"), true);

        $foundData = null;
        foreach ($modelList as $modelData){
            if(isset($modelData["Name"]) && $modelData["Name"] === $name) $foundData = $modelData;
        }

        if(is_null($foundData)) return null;

        // Making sure all keys exist
        $requiredKeys = [
            "geometry_file",
            "geometry_identifier",
            "texture_file"
        ];

        foreach ($requiredKeys as $requiredKey){
            if(!isset($foundData[$requiredKey])) return null;
        }

        $model = $foundData["geometry_file"];
        $geometryIdentifier = $foundData["geometry_identifier"];
        $texture = $foundData["texture_file"];

        $texturePath = Main::getInstance()->getDataFolder()."Textures/".$texture;


        if(!file_exists($texturePath)) return null;


        // Magic SkinBytes creator
        $img = @imagecreatefrompng($texturePath);

        $size = getimagesize($texturePath);
        $skinbytes = "";
        for ($y = 0; $y < $size[1]; $y++) {
            for ($x = 0; $x < $size[0]; $x++) {
                $colorat = @imagecolorat($img, $x, $y);
                $a = ((~((int)($colorat >> 24))) << 1) & 0xff;
                $r = ($colorat >> 16) & 0xff;
                $g = ($colorat >> 8) & 0xff;
                $b = $colorat & 0xff;
                $skinbytes .= chr($r) . chr($g) . chr($b) . chr($a);
            }
        }

        @imagedestroy($img);

        $modelPath = Main::getInstance()->getDataFolder()."Models/". $model;

        // Making sure Model file exists
        if(!file_exists($modelPath)) return null;

        return new Skin(UUID::fromRandom()->toString()."Custom", $skinbytes, "", $geometryIdentifier, file_get_contents($modelPath));

    }

}