<?php

namespace Engine\Page\Element;

class Button extends ContainerElement
{
	use \Engine\Page\Element\Traits\SelfName;

	public function __construct()
	{
		$this->attributes["type"] = new Attribute("type", "button");
	}

	public function setContents(string $contents) : self
	{
		$this->setElements
		([
			(new Literal())->setContents($contents)
		]);

		return $this;
	}
}