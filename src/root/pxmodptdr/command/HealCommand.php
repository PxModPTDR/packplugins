<?php

namespace root\pxmodptdr\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use root\pxmodptdr\Main;

class HealCommand extends Command
{
    public function __construct()
    {
        parent::__construct(Main::getInstance()->getConfig()->get("heal_name"), Main::getInstance()->getConfig()->get("heal_desc"), Main::getInstance()->getConfig()->get("heal_use"));
        $this->setPermission("heal.cmd");
        $this->setPermissionMessage(Main::getInstance()->getConfig()->get("heal_perm_message"));
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : void
{
    if ($sender instanceof Player) {
        $healh = $sender->getHealth();
        $maxhealth = $sender->getMaxHealth();
        if ($healh < $maxhealth) {
            $sender->setHealth($maxhealth);
            $sender->sendMessage(Main::getInstance()->getConfig()->get("heal_give"));
        } else {
            $sender->sendMessage(Main::getInstance()->getConfig()->get("heal_full"));
        }
    }
}
}