<?php

namespace Engine\Page;

use Engine\Page\Element\Element;

class Page implements Renderable
{
	private \Engine\Page\Template\Template $template;
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
		$html  = "";
		$html .= $this->template->renderHeader();
		$html .= $this->template->renderBodyOpen();

		foreach($this->elements as $element)
		{
			$html .= $element->render();
		}

		$html .= $this->template->renderBodyClose();
		$html .= $this->template->renderFooter();

		return $html;
	}
}