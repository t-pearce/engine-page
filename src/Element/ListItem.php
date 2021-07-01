<?php

namespace Engine\Page\Element;

class ListItem extends Element
{
	private mixed $entry;

	public function setEntry(mixed $entry) : self
	{
		$this->entry = $entry;
	
		return $this;
	}

	protected function getTag()
	{
		return "li";
	}

	public function render() : string
	{
		return $this->constructOpeningTag() . $this->entry . $this->constructClosingTag();
	}

}