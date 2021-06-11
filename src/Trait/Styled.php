<?php

namespace Engine\Page\Trait;

trait Styled
{
	protected array $styles = [];

	public function addStyle(string $stylePath) : self
	{
		if(!in_array($stylePath, $this->styles))
			$this->styles[] = $stylePath;

		return $this;
	}

	public function getStyles()
	{
		return $this->styles;
	}
}