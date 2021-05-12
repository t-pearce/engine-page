<?php

namespace Engine\Page\Element;

abstract class VoidElement extends Element
{
	protected function constructClosingTag() : string
	{
		return "";
	}

	protected function constructOpeningTag() : string
	{
		return "<" . $this->getTag() . " {$this->constructAttributes()} />";
	}

	protected function constructAttributes() : string
	{
		$attributes = [];

		foreach($this->attributes as $attribute)
		{
			$attributes[] = "{$attribute->getName()}=\"{$attribute->getValue()}\"";
		}

		return implode(" ", $attributes);
	}
}