<?php

namespace Engine\Page\Element;

class DataList extends ContainerElement
{
	protected string $id;
	use \Engine\Page\Element\Traits\SelfName;

	public function render(): string
	{
		$this->addAttribute(new Attribute("id", $this->id));

		return parent::render();
	}

	public function setOptions(DataListOption ...$options) : self
	{
		$this->setElements($options);

		return $this;
	}

	public function setId(string $id) : self
	{
		$this->id = $id;
	
		return $this;
	}

}