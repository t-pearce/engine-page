<?php

namespace Engine\Page\Element;

abstract class Element implements \Engine\Page\Renderable
{
	/** @var Attribute[] */
	protected array $attributes = [];
	protected string $id;

	use \Engine\Traits\Creatable;
	use \Engine\Page\Trait\Scripted;
	use \Engine\Page\Trait\Styled;

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

		$classes = [];

		foreach($this->attributes as $attribute)
		{
			if($attribute->getName() === "class")
				$classes[] = $attribute->getValue();
			else $attributes[] = "{$attribute->getName()}=\"{$attribute->getValue()}\"";
		}

		if(count($classes) > 0)
			$attributes[] = "class=\"" . implode(" ", $classes) . "\"";

		return implode(" ", $attributes);
	}

	public function addAttribute(Attribute $attribute, bool $exclusive = false) : self
	{
		if($exclusive)
			$this->attributes[$attribute->getName()] = $attribute;
		else $this->attributes[] = $attribute;

		return $this;
	}

	protected function getTag()
	{
		$reflection = new \ReflectionClass(static::class);

		return strtolower($reflection->getShortName());
	}
}