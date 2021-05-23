<?php

namespace Engine\Page\Element;

class Link extends ContainerElement
{
	public function setSource(string $source) : self
	{
		$this->attributes['href'] = new Attribute("href", $source);

		return $this;
	}
}