<?php

namespace Engine\Page\Trait;

trait Scripted
{
	protected array $scripts = [];

	public function addScript(string $striptPath) : self
	{
		if(!in_array($striptPath, $this->scripts))
			$this->scripts[] = $striptPath;

		return $this;
	}

	public function getScripts()
	{
		return $this->scripts;
	}
}