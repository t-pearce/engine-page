<?php

namespace Engine\Page\Element;

abstract class ListElement extends ContainerElement
{
	protected array $entries = [];

	abstract protected function getChildElement() : ListItem;

	public function render(): string
	{
		foreach($this->entries as $entry)
		{
			$element = $this->getChildElement()
			->setEntry($entry);

			$this->addElement($element);
		}
		
		return parent::render();
	}

	public function setEntries(...$entries) : self
	{
		$this->entries = $entries;
	
		return $this;
	}
}