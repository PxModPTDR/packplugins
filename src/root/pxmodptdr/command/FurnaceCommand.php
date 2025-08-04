<?php

namespace root\pxmodptdr\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\crafting\FurnaceType;
use pocketmine\player\Player;
use pocketmine\Server;
use root\pxmodptdr\Main;

class FurnaceCommand extends Command
{
    public function __construct()
    {
        parent::__construct(Main::getInstance()->getConfig()->get("furnace_name"), Main::getInstance()->getConfig()->get("furnace_desc"), Main::getInstance()->getConfig()->get("furnace_use"));
        $this->setPermission("furnace.cmd");
        $this->setPermissionMessage(Main::getInstance()->getConfig()->get("furnace_perm_message"));
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args) : void
    {
        if ($sender instanceof Player) {
            if (isset($args[0]) and $args[0] === "all") {
                foreach ($sender->getInventory()->getContents() as $index => $item) {
                    $furnacemanager = Server::getInstance()->getCraftingManager()->getFurnaceRecipeManager(FurnaceType::FURNACE);
                    if ($furnacemanager->match($item) === null) {
                        continue;
                    }
                    $result = $furnacemanager->match($item)->getResult();
                    $sender->getInventory()->setItem($index, $result->setCount($item->getCount()));
                }
                return;
            }
            $item = $sender->getInventory()->getItemInHand();
            $furnacemanager = Server::getInstance()->getCraftingManager()->getFurnaceRecipeManager(FurnaceType::FURNACE);
            if ($furnacemanager->match($item) === null) {
                $sender->sendMessage(Main::getInstance()->getConfig()->get("furnace_no_cuit"));
                return;
            }
            $result = $furnacemanager->match($item)->getResult();
            $sender->getInventory()->setItemInHand($result->setCount($item->getCount()));
            $sender->sendMessage(str_ireplace("{item}", $item->getName(), Main::getInstance()->getConfig()->get("furnace_cuit")));
        }
    }
}