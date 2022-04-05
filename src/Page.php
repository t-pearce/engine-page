<?php

namespace Engine\Page;

use Engine\Page\Element\Element;

abstract class Page implements Renderable
{
	private \Engine\Page\Template\Template $template;
	private DataProvider $dataProvider;

	protected array $post;
	protected array $get;

	/** @var Element[] */
	private array $elements;

	use \Engine\Page\Trait\Scripted;
	use \Engine\Page\Trait\Styled;

	public function __construct(?\Engine\Page\Template\Template $template = null)
	{
		$this->template = $template ?? \Engine\ConfigManager::getInstance()->get(\Engine\Config::PAGE_DEFAULT_TEMPLATE);
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

		$html .= $this->template->renderHeaderClose();
		$html .= $this->template->renderBodyOpen();

		foreach($this->elements as $element)
		{
			$html .= $element->render();
		}

		$html .= $this->template->renderBodyClose();

		$html .= $this->getScriptHtml();
		$html .= $this->getStyleHtml();

		$html .= $this->template->renderFooter();

		return $html;
	}

	private function getScriptHtml()
	{
		$html    = "";
		$scripts = [...$this->getScripts()];

		foreach($this->elements as $element)
		{
			foreach($element->getScripts() as $script)
			{
				$scripts[] = $script;
			}
		}

		$scripts = array_unique(array_filter($scripts));

		foreach(array_filter($scripts) as $script)
		{
			$html .= $script->render();
		}

		return $html;
	}

	private function getStyleHtml()
	{
		$html    = "";
		$styles = [...$this->getStyles()];

		foreach($this->elements as $element)
		{
			foreach($element->getStyles() as $style)
			{
				$styles[] = $style;
			}
		}

		$styles = array_unique(array_filter($styles));

		foreach(array_filter($styles) as $stylePath)
		{
			$html .= \Engine\Page\Element\Link::create()
			->setSource($stylePath)
			->addAttribute(new \Engine\Page\Element\Attribute("rel", "stylesheet"))
			->render();
		}

		return $html;
	}

	public function setDataProvider(DataProvider $dataProvider) : self
	{
		$this->dataProvider = $dataProvider;
	
		return $this;
	}

	public function setGet(array $get) : self
	{
		$this->get = $get;
	
		return $this;
	}
	public function setPost(array $post) : self
	{
		$this->post = $post;
	
		return $this;
	}

	abstract protected function addElements();
}