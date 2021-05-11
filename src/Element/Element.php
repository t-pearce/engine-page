<?php

namespace Engine\Page\Element;

abstract class Element implements \Engine\Page\Renderable
{
	protected static string $tag;

	/** @var Attribute[] */
	protected array $attributes;

	public function render() : string
	{
		return $this->constructOpeningTag();
	}

	protected function constructClosingTag() : string
	{
		return "</" . self::$tag . ">";
	}

	protected function constructOpeningTag() : string
	{
		return "<" . self::$tag . " {$this->constructAttributes()}>";
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