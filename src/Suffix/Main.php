<?php



namespace Suffix;



use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener
{

    public function onEnable()
    {
        $this->getLogger()->info(TextFormat::GREEN . "Suffix succesfully enabled!");
    }
    public function onDisable()
    {
        $this->getLogger()->info(TextFormat::RED . "Suffix disabled!");
    }

    function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch ($command->getName()){
            case "addtag":

                if ($sender->hasPermission("suffix.addtag")){
                    if (isset($args[0])){
                        if (($args[0])){
                            $sender->sendMessage("Tag added");
                            $this->getConfig()->set("tags",["$args[0]"]);
                        }
                    }
                }
                break;

            case "tag":

                if ($sender->hasPermission("suffix.tag")){
                    if (isset($args[1])){
                        $pl = $this->getServer()->getPlayer($args[1]);
                        if ($pl instanceof Player){
                            if (isset($args[2])){
                                $sender->sendMessage(TextFormat::GREEN . "Succesfully gave $args[1] the tag $args[2]");

                            } else {

                                $sender->sendMessage("The tag $args[2] not found");
                            }

                            } else {
                                if ($args[1] instanceof Player){
                                    $sender->sendMessage("The player $args[1] not found");
                                }
                            }
                        }

                    }
                }
        return true;
    }
}