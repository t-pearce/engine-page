<?php

namespace Engine\Page\Element;

class TableHeader extends TableData
{
	public function setContents(string|Element $contents): self
	{
		if(is_string($contents))
			$element = (new Literal())->setContents(ucwords(implode(" ", preg_split('/(?=[A-Z])/',$contents))));
		else $element = $contents;

		$this->setElements([$element]);

		return $this;
	}

	protected function getTag()
	{
		return "th";
	}
}