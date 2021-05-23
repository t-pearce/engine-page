<?php

namespace Engine\Page\Element;

abstract class Element implements \Engine\Page\Renderable
{
	/** @var Attribute[] */
	protected array $attributes = [];
	protected string $id;

	use \Engine\Traits\Creatable;

	public function __construct()
	{
		$this->id = uniqid("attr_set_");
	}

	public function render() : string
	{
		return $this->constructOpeningTag() . $this->constructClosingTag();
	}

	protected function constructClosingTag() : string
	{
		return "</" . $this->getTag() . ">\n";
	}

	protected function constructOpeningTag() : string
	{
		return "<" . $this->getTag() . " {$this->constructAttributes()}>\n";
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
		$reflection = new \ReflectionClass(static::class);

		return strtolower($reflection->getShortName());
	}

	public function getScripts() : array
	{
		return [];
	}
	public function getStyles() : array
	{
		return [];
	}
}