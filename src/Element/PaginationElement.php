<?php

namespace Engine\Page\Element;

class PaginationElement extends Div
{
	private int $itemCount;
	private int $itemsPerPage;
	private int $pageOffset;
	private int $pagesEitherSide;

	private bool $showGoToStart = true;
	private bool $showGoToPrevious = true;
	private bool $showGoToNext = true;
	private bool $showGoToLast = true;

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

		if($this->showGoToStart && $this->pageOffset > 1)
			$this->addElement($this->getButton("<<", 1));
		if($this->showGoToPrevious && $this->pageOffset > 1)
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

		if($this->showGoToNext && $this->pageOffset < $pages)
			$this->addElement($this->getButton(">", $this->pageOffset + 1));
		if($this->showGoToLast && $this->pageOffset < $pages)
			$this->addElement($this->getButton(">>", $pages ));

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
	public function setShowGoToLast(bool $showGoToLast) : self
	{
		$this->showGoToLast = $showGoToLast;
	
		return $this;
	}
	public function setShowGoToNext(bool $showGoToNext) : self
	{
		$this->showGoToNext = $showGoToNext;
	
		return $this;
	}
	public function setShowGoToPrevious(bool $showGoToPrevious) : self
	{
		$this->showGoToPrevious = $showGoToPrevious;
	
		return $this;
	}
	public function setShowGoToStart(bool $showGoToStart) : self
	{
		$this->showGoToStart = $showGoToStart;
	
		return $this;
	}
}