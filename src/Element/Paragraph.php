<?php

namespace Engine\Page\Element;

class Paragraph extends ContainerElement
{
	protected function getTag()
	{
		return "p";
	}

	public function setText(string $string) : self
	{
		$this->elements = [Literal::create()->setContents($string)];

		return $this;
	}
}