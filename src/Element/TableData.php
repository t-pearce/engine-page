<?php

namespace Engine\Page\Element;

class TableData extends ContainerElement
{
	public function setContents(string|Element $contents): self
	{
		if(is_string($contents))
			$element = (new Literal())->setContents($contents);
		else $element = $contents;

		$this->setElements([$element]);

		return $this;
	}

	protected function getTag()
	{
		return "td";
	}
}