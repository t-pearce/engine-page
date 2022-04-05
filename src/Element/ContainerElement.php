<?php

namespace Engine\Page\Element;

abstract class ContainerElement extends Element
{
	/** @var Element[] */
	protected array $elements = [];

	public function render() : string
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

	public function addElement(Element $element) : static
	{
		$this->elements[] = $element;

		return $this;
	}
	/**
	 * @param Element[] $elements
	 */
	public function setElements(array $elements) : static
	{
		$this->elements = $elements;
	
		return $this;
	}

	public function getScripts() : array
	{
		$scripts = [...$this->scripts];

		foreach($this->elements as $element)
		{
			$scripts = [...$scripts, ...$element->getScripts()];
		}

		return $scripts;
	}

	public function getStyles() : array
	{
		$styles = [...$this->styles];

		foreach($this->elements as $element)
		{
			$styles = [...$styles, ...$element->getStyles()];
		}

		return $styles;
	}
}