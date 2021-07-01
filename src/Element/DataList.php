<?php

namespace Engine\Page\Element;

class DataList extends ContainerElement
{
	protected array $entries = [];
	private bool $reverse = false;

	protected function getChildElement(): ListItem 
	{
		return ListItem::create();
	}

	public function render(): string
	{
		$terms = [];
		$defs  = [];

		foreach($this->entries as $element)
		{
			$terms[] = DataTerm::create()
			->setValue($element->getKey());

			$defs[] = DataDefinition::create()
			->setValue($element->getValue());
		}

		$termsDiv = Div::create()
		->setElements($terms);

		$defsDiv = Div::create()
		->setElements($defs);

		if($this->reverse)
		{
			$this->setElements
			([
				$defsDiv,
				$termsDiv,
			]);
		}
		else
		{
			$this->setElements
			([
				$termsDiv,
				$defsDiv
			]);
		}

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