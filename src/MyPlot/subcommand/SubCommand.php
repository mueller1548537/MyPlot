<?php
declare(strict_types=1);
namespace MyPlot\subcommand;

use MyPlot\forms\MyPlotForm;
use MyPlot\MyPlot;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\plugin\Plugin;

abstract class SubCommand implements PluginIdentifiableCommand
{
	/** @var MyPlot $plugin */
    private $plugin;
	/** @var string $name */
    private $name;

    /**
     * @param MyPlot $plugin
     * @param string $name
     */
	public function __construct(MyPlot $plugin, string $name) {
        $this->plugin = $plugin;
        $this->name = $name;
    }

    /**
     * @return MyPlot
     */
	public final function getPlugin() : Plugin {
        return $this->plugin;
    }

    /**
     * @param string $str
     * @param (float|int|string)[] $params
     *
     * @param string $onlyPrefix
     * @return string
     */
	protected function translateString(string $str, array $params = [], string $onlyPrefix = null) : string {
        return $this->plugin->getLanguage()->translateString($str, $params, $onlyPrefix);
    }

    /**
     * @param CommandSender $sender
     * @return bool
     */
	public abstract function canUse(CommandSender $sender) : bool;

    /**
     * @return string
     */
	public function getUsage() : string {
        $usage = $this->getPlugin()->getFallBackLang()->get($this->name . ".usage"); // TODO: use normal language when command autofill gains support
        return ($usage == $this->name . ".usage") ? "" : $usage;
    }

    /**
     * @return string
     */
	public function getName() : string {
        $name = $this->getPlugin()->getLanguage()->get($this->name . ".name");
        return ($name == $this->name . ".name") ? "" : $name;
    }

    /**
     * @return string
     */
	public function getDescription() : string {
        $desc = $this->getPlugin()->getLanguage()->get($this->name . ".desc");
        return ($desc == $this->name . ".desc") ? "" : $desc;
    }

    /**
     * @return string
     */
	public function getAlias() : string {
        $alias = $this->getPlugin()->getLanguage()->get($this->name . ".alias");
        return ($alias == $this->name . ".alias") ? "" : $alias;
    }

	/**
	 * @return MyPlotForm|null
	 */
	public abstract function getForm() : ?MyPlotForm;

	/**
	 * @param CommandSender $sender
	 * @param string[] $args
	 *
	 * @return bool
	 */
	public abstract function execute(CommandSender $sender, array $args) : bool;
}