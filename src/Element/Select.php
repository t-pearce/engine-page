<?php

namespace Engine\Page\Element;

class Select extends ContainerElement
{
	private array $options;
	
	use \Engine\Page\Element\Traits\SelfName;

	public function render(): string
	{
		foreach($this->options as $value => $label)
		{
			$this->addElement
			(
				Option::create()
				->setLabel($label)
				->setValue($value)
			);
		}

		return parent::render();
	}

	public function setOptions(array $options) : self
	{
		$this->options = $options;
	
		return $this;
	}
}