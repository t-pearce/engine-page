<?php

namespace Engine\Page\Template;

abstract class Template
{
	use \Engine\Traits\Singleton;

	abstract protected function outputHeader() : void;
	abstract protected function outputBodyOpen() : void;
	abstract protected function outputBodyClose() : void;
	abstract protected function outputFooter() : void;

	public final function renderHeader() : string
	{
		return $this->renderSection([$this, "outputHeader"]);
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