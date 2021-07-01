<?php

namespace Engine\Page\Element;

class DataDefinition extends ContainerElement
{
	private string $value;

	public function render(): string
	{
		$this->addElement
		(
			Literal::create()
			->setContents($this->value)
		);

		return parent::render();
	}
	protected function getTag()
	{
		return "dd";
	}

	public function setValue(string $value) : self
	{
		$this->value = $value;
	
		return $this;
	}
}