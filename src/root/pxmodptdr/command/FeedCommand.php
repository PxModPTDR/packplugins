<?php

namespace root\pxmodptdr\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use root\pxmodptdr\Main;

class FeedCommand extends Command
{
public function __construct()
{
    parent::__construct(Main::getInstance()->getConfig()->get("feed_name"), Main::getInstance()->getConfig()->get("feed_desc") , Main::getInstance()->getConfig()->get("feed_use"));
    $this->setPermission("feed.cmd");
    $this->setPermissionMessage(Main::getInstance()->getConfig()->get("feed_perm_message"));
}
public function execute(CommandSender $sender, string $commandLabel, array $args) : void
{
    if ($sender instanceof Player) {
        $sender->getHungerManager()->setFood(20);
        $sender->getHungerManager()->addSaturation(Main::getInstance()->getConfig()->get("feed_saturation_number"));
        $sender->sendMessage(Main::getInstance()->getConfig()->get("feed_give"));
    }
}
}