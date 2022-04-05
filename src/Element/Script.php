<?php

namespace Engine\Page\Element;

class Script extends ContainerElement
{
	private bool $runAfterPageLoad = false;

	use \Engine\Page\Element\Traits\SelfName;

	public function render() : string
	{
		$html = "";

		$html .= $this->constructOpeningTag();

		if($this->runAfterPageLoad)
		{
			$html .= Literal::create()->setContents("$(document).ready(function() {\n")->render();
		}

		foreach($this->elements as $element)
		{
			$html .= $element->render();
		}

		if($this->runAfterPageLoad)
		{
			$html .= Literal::create()->setContents("\n});\n")->render();
		}

		$html .= $this->constructClosingTag();

		return $html;
	}

	public function setSource(string $source) : self
	{
		$this->attributes['src'] = new Attribute("src", $source);

		return $this;
	}

	public function setContents(string $source) : self
	{
		$this->addElement(Literal::create()->setContents($source));

		return $this;
	}

	protected function getTag()
	{
		$reflection = new \ReflectionClass(self::class);

		return strtolower($reflection->getShortName());
	}

	public function getRunAfterPageLoad() : bool
	{
		return $this->runAfterPageLoad;
	}
	public function setRunAfterPageLoad(bool $runAfterPageLoad = true) : self
	{
		$this->runAfterPageLoad = $runAfterPageLoad;
	
		return $this;
	}
}