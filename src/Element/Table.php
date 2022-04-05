<?php

namespace Engine\Page\Element;

class Table extends ContainerElement
{
	private bool $isRowscoped;

	use \Engine\Page\Element\Traits\SelfName;

	public function render() : string
	{
		foreach($this->elements as $element)
		{
			if(isset($this->isRowscoped) && $element instanceof TableRow)
			{
				$element->setIsRowscoped($this->isRowscoped);
			}
		}

		return parent::render();
	}

	public function setIsRowscoped(bool $isRowscoped = true) : self
	{
		$this->isRowscoped = $isRowscoped;
	
		return $this;
	}
}