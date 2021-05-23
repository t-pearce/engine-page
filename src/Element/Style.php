<?php

namespace Engine\Page\Element;

class Style extends ContainerElement
{
	public function setContents(string $source) : self
	{
		$this->addElement(Literal::create()->setContents($source));

		return $this;
	}
}