<?php

namespace root\pxmodptdr\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Durable;
use pocketmine\player\Player;
use root\pxmodptdr\Main;

class RepairCommand extends Command
{
public function __construct()
{
    parent::__construct(Main::getInstance()->getConfig()->get("repair_name"), Main::getInstance()->getConfig()->get("repair_desc"), Main::getInstance()->getConfig()->get("repair_use"));
    $this->setPermission("repair.cmd");
    $this->setPermissionMessage(Main::getInstance()->getConfig()->get("repair_perm_message"));
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args) : void
    {
        if ($sender instanceof Player) {
            $item = $sender->getInventory()->getItemInHand();
            if ($item->isNull()) {
                $sender->sendMessage(Main::getInstance()->getConfig()->get("repair_impossible"));
                return;
            }
            if (!$item instanceof Durable) {
                $sender->sendMessage(Main::getInstance()->getConfig()->get("repair_impossible"));
                return;
            }
            if ($item->getDamage() === 0) {
                $sender->sendMessage(Main::getInstance()->getConfig()->get("deja_repair"));
                return;
            }
            $item->setDamage(0);
            $sender->getInventory()->setItemInHand($item);
            $sender->sendMessage(Main::getInstance()->getConfig()->get("repair_success"));
        }

    }
}