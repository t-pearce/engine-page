<?php

namespace Engine\Page\Element;

class Anchor extends ContainerElement
{
	public function setSource(string $source) : self
	{
		$this->attributes['href'] = new Attribute("href", $source);

		return $this;
	}

	protected function getTag()
	{
		return "a";
	}
}