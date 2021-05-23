<?php

namespace Engine\Page;

use Engine\Page\Element\Element;

abstract class Page implements Renderable
{
	private \Engine\Page\Template\Template $template;
	private DataProvider $dataProvider;

	/** @var Element[] */
	private array $elements;

	public function __construct(?\Engine\Page\Template\Template $template = null)
	{
		$this->template = $template ?? \Engine\Page\Template\DefaultTemplate::getInstance();
		$this->elements = [];
	}

	protected function addElement(\Engine\Page\Element\Element $element)
	{
		$this->elements[] = $element;
	}

	public function render() : string
	{
		if(isset($this->dataProvider))
			$this->dataProvider->setData();

		$this->addElements();

		$html  = "";
		$html .= $this->template->renderHeaderOpen();

		$html .= $this->getScriptHtml();
		$html .= $this->getStyleHtml();

		$html .= $this->template->renderHeaderClose();
		$html .= $this->template->renderBodyOpen();

		foreach($this->elements as $element)
		{
			$html .= $element->render();
		}

		$html .= $this->template->renderBodyClose();
		$html .= $this->template->renderFooter();

		return $html;
	}

	private function getScriptHtml()
	{
		$scripts = [];

		foreach($this->elements as $element)
		{
			$scripts = [...$scripts, ...$element->getScripts()];
		}

		$html = "";

		foreach($scripts as $tag)
		{
			$html .= $tag->render();
		}
		
		return $html;
	}

	private function getStyleHtml()
	{
		$html  = "";

		$styles = [$this->getStyle()];

		foreach($this->elements as $element)
		{
			$styles = [...$styles, ...$element->getStyles()];
		}

		foreach(array_filter($styles) as $tag)
		{
			$html .= $tag->render();
		}

		return $html;
	}

	public function setDataProvider(DataProvider $dataProvider) : self
	{
		$this->dataProvider = $dataProvider;
	
		return $this;
	}

	abstract protected function addElements();

	protected function getStyle() : ?\Engine\Page\Element\Style
	{
		return null;
	}
}