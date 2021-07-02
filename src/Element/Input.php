<?php

namespace Engine\Page\Element;

class Input extends VoidElement
{
	private bool $hasName = false;
	private bool $hasType = false;
	private ?string $value;

	use \Engine\Page\Element\Traits\SelfName;

	public function render(): string
	{
		if(!$this->hasType)
			throw new \LogicException("Input has not been configured correctly; no type given");
		if(!$this->hasName)
			throw new \LogicException("Input has not been configured correctly; no name given");

		if(isset($this->value))
			$this->addAttribute(new Attribute("value", $this->value));

		return parent::render();
	}

	public function setPlaceholder(string $placeholder) : self
	{
		$this->addAttribute(new Attribute("placeholder", $placeholder), true);

		$this->hasName = true;
	
		return $this;
	}

	public function setName(string $name) : self
	{
		$this->addAttribute(new Attribute("name", $name), true);

		$this->hasName = true;
	
		return $this;
	}

	public function setType(string $type) : self
	{
		if(!\Engine\Page\Element\Enum\FormInputTypes::isConstantValue($type))
			throw new \LogicException("{$type} is an invalid input type");

		$this->addAttribute(new Attribute("type", $type), true);

		$this->hasType = true;
	
		return $this;
	}

	public function setValue(?string $value) : self
	{
		$this->value = $value;
	
		return $this;
	}
}