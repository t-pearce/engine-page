<?php

namespace Engine\Page\Element;

class DescriptionListTerm extends ContainerElement
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
		return "dt";
	}

	public function setValue(string $value) : self
	{
		$this->value = $value;
	
		return $this;
	}
}