<?php

namespace Engine\Page\Element;

class Input extends VoidElement
{
	private bool $hasName = false;
	private bool $hasType = false;
	private string $dataList;
	private ?string $value;

	use \Engine\Page\Element\Traits\SelfName;

	public function render(): string
	{
		if(!$this->hasType)
			throw new \LogicException("Input has not been configured correctly; no type given");
		if(!$this->hasName)
			throw new \LogicException("Input has not been configured correctly; no name given");

		if(isset($this->value))
			$this->addAttribute(new Attribute("value", htmlentities($this->value)));
		
		if(isset($this->dataList))
			$this->addAttribute(new Attribute("list", $this->dataList));

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
		if($type instanceof \Engine\Page\Element\Enum\FormInputTypes)
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
	public function setDataList(string $dataList) : self
	{
		$this->dataList = $dataList;
	
		return $this;
	}
}