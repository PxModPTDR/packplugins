<?php
namespace root\pxmodptdr;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use root\pxmodptdr\command\FeedCommand;
use root\pxmodptdr\command\FurnaceCommand;
use root\pxmodptdr\command\HealCommand;
use root\pxmodptdr\command\RepairCommand;

class Main extends PluginBase {
    use SingletonTrait;

    public function onLoad(): void
    {
        self::setInstance($this);
    }

    public function onEnable(): void
    {
        // Ne pas partager ni copier ce plugin ! Même si vous l'avez acheté, ce n'est pas une raison dans tous les cas !
        $this->saveDefaultConfig();
        $this->getLogger()->info("§1Activation du plugin Pack by PxModPTDR (RootShop)");
        $this->getServer()->getCommandMap()->register("", new FurnaceCommand());
        $this->getServer()->getCommandMap()->register("", new HealCommand());
        $this->getServer()->getCommandMap()->register("", new FeedCommand());
        $this->getServer()->getCommandMap()->register("", new RepairCommand());
    }
}