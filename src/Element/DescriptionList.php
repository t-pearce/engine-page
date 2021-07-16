<?php

namespace Engine\Page\Element;

class DescriptionList extends ContainerElement
{
	protected array $entries = [];
	private bool $reverse = false;

	protected function getChildElement(): ListItem 
	{
		return ListItem::create();
	}

	public function render(): string
	{
		$elements = [];

		foreach($this->entries as $element)
		{
			if(!$this->reverse)
				$elements[] = DescriptionListTerm::create()
				->setValue($element->getKey());

			$elements[] = DescriptionListDefinition::create()
			->setValue($element->getValue());

			if($this->reverse)
				$elements[] = DescriptionListTerm::create()
				->setValue($element->getKey());
		}

		$this->setElements($elements);

		return parent::render();
	}

	public function setEntries(...$entries) : self
	{
		$this->entries = $entries;
	
		return $this;
	}

	public function getTag() : string
	{
		return "dl";
	}

	public function setReverse(bool $reverse = true) : self
	{
		$this->reverse = $reverse;
	
		return $this;
	}
}