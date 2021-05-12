<?php

namespace Engine\Page\Element;

abstract class ContainerElement extends Element
{
	/** @var Element[] */
	private array $elements;

	public function render(): string
	{
		$html = "";

		$html .= $this->constructOpeningTag();

		foreach($this->elements as $element)
		{
			$html .= $element->render();
		}

		$html .= $this->constructClosingTag();

		return $html;
	}

	public function addElement(Element $element) : self
	{
		$this->elements[] = $element;

		return $this;
	}
	/**
	 * @param Element[] $elements
	 */
	public function setElements(array $elements) : self
	{
		$this->elements = $elements;
	
		return $this;
	}
}