<?php

namespace Engine\Page\Element;

class DataListOption extends VoidElement
{
	private string $value;
	
	public function render(): string
	{
		$this->addAttribute(new Attribute("value", $this->value));

		return parent::render();
	}

	protected function getTag()
	{
		return "option";
	}

	public function setValue(string $value) : self
	{
		$this->value = $value;
	
		return $this;
	}
}