<?php

namespace Engine\Page\Element;

abstract class Element implements \Engine\Page\Renderable
{
	/** @var Attribute[] */
	protected array $attributes;

	public function render() : string
	{
		return $this->constructOpeningTag() . $this->constructClosingTag();
	}

	protected function constructClosingTag() : string
	{
		return "</" . $this->getTag() . ">";
	}

	protected function constructOpeningTag() : string
	{
		return "<" . $this->getTag() . " {$this->constructAttributes()}>";
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

	protected function getTag()
	{
		return strtolower(static::class);
	}
}