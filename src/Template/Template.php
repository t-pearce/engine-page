<?php

namespace Engine\Page\Template;

abstract class Template
{
	use \Engine\Traits\Singleton;

	abstract protected function outputHeaderOpen() : void;
	abstract protected function outputHeaderClose() : void;
	abstract protected function outputBodyOpen() : void;
	abstract protected function outputBodyClose() : void;
	abstract protected function outputFooter() : void;

	public final function renderHeaderOpen() : string
	{
		return $this->renderSection([$this, "outputHeaderOpen"]);
	}
	public final function renderHeaderClose() : string
	{
		return $this->renderSection([$this, "outputHeaderClose"]);
	}
	public final function renderBodyOpen() : string
	{
		return $this->renderSection([$this, "outputBodyOpen"]);
	}
	public final function renderBodyClose() : string
	{
		return $this->renderSection([$this, "outputBodyClose"]);
	}
	public final function renderFooter() : string
	{
		return $this->renderSection([$this, "outputFooter"]);
	}

	private function renderSection(callable $function) : string
	{
		ob_start();
		$function();
		return ob_get_clean();
	}
}