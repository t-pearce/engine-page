<?php

namespace Engine\Page\Element;

class PaginationElement extends Div
{
	private int $itemCount;
	private int $itemsPerPage;
	private int $pageOffset;
	private int $pagesEitherSide;

	public function __construct()
	{
		// @TODO Import styles from engine plugins
	}

	protected function getTag()
	{
		return "div";
	}

	public function render() : string
	{
		$pages = ceil($this->itemCount / $this->itemsPerPage);

		$this->addElement($this->getButton("<", $this->pageOffset - 1));

		for
		(
			$i = max(1, $this->pageOffset - $this->pagesEitherSide);
			$i <= min($pages, $this->pageOffset + $this->pagesEitherSide);
			$i++
		)
		{
			$button = $this->getButton($i, $i);

			if($i === $this->pageOffset)
				$button->addAttribute(new Attribute("class", "selected"));

			$this->addElement($button);
		}

		$this->addElement($this->getButton(">", $this->pageOffset + 1));

		return parent::render();
	}

	public function getButton($text, $offset) : Element
	{
		return Anchor::create()
		->addElement
		(
			Button::create()
			->addElement
			(
				Literal::create()
				->setContents($text)
			)
		)
		->setSource(\Engine\Routing\Url::currentPage()->setQueryValue("page", $offset)->toString())
		->addAttribute(new Attribute("class", "pagination_button"));
	}

	public function setItemsPerPage(int $itemsPerPage) : self
	{
		$this->itemsPerPage = $itemsPerPage;
	
		return $this;
	}
	public function setItemCount(int $itemCount) : self
	{
		$this->itemCount = $itemCount;
	
		return $this;
	}
	public function setPageOffset(int $pageOffset) : self
	{
		$this->pageOffset = $pageOffset;
	
		return $this;
	}
	public function setPagesEitherSide(int $pagesEitherSide) : self
	{
		$this->pagesEitherSide = $pagesEitherSide;
	
		return $this;
	}
}