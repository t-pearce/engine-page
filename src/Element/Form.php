<?php

namespace Engine\Page\Element;

class Form extends ContainerElement
{
	use \Engine\Page\Element\Traits\SelfName;

	public function render(): string
	{
		$this->addElement
		(
			Input::create()
			->setType("submit")
			->setName("submit")
			->setValue("Submit")
		);

		return parent::render();
	}

	public function usePost()
	{
		$this->addAttribute(new Attribute("method", "post"), true);
	}

	public function useGet()
	{
		$this->addAttribute(new Attribute("method", "get"), true);
	}
}