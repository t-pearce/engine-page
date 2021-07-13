<?php

namespace Engine\Page\Element;

class Option extends ContainerElement
{
	private string $value;
	private string $label;
	
	public function render(): string
	{
		$this->addAttribute(new Attribute("value", $this->value));
		$this->addElement(Literal::create()->setContents($this->label));

		return parent::render();
	}

	public function setLabel(string $label) : self
	{
		$this->label = $label;
	
		return $this;
	}
	public function setValue(string $value) : self
	{
		$this->value = $value;
	
		return $this;
	}
}