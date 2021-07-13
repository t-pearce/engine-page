<?php

namespace Engine\Page\Element;

class Legend extends ContainerElement
{
	private string $value;

	use \Engine\Page\Element\Traits\SelfName;

	public function render(): string
	{
		return "<legend>{$this->value}</legend>";
	}
	
	public function setValue(string $value) : self
	{
		$this->value = $value;
	
		return $this;
	}
}