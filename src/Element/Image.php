<?php

namespace Engine\Page\Element;

class Image extends VoidElement
{
	public function setSrc(string $src) : self
	{
		$this->attributes[] = new Attribute("src", $src);
	
		return $this;
	}

	protected function getTag()
	{
		return "img";
	}
}