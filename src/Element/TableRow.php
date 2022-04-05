<?php

namespace Engine\Page\Element;

class TableRow extends ContainerElement
{
	private bool $isHeader = false;
	private bool $isRowScoped = false;
	private array $data;

	public function render(): string
	{
		$cell = $this->isHeader ? TableHeader::class : TableData::class;

		$first = true;
		foreach($this->data as $datum)
		{
			$toShow = "";

			if(is_array($datum))
				$toShow = implode(", ", $datum);
			else $toShow = $datum;

			if($this->isRowScoped && $first)
			{
				if($first)
				{
					$this->addElement(TableHeader::create()->setContents((string)$toShow));
					$first = false;
				}
				else $this->addElement(TableData::create()->setContents((string)$toShow));
			}
			else
			{
				$this->addElement
				(
					$cell::create()
					->setContents((string)$toShow)
				);
			}
		}

		return parent::render();
	}

	protected function getTag()
	{
		return "tr";
	}

	public function setData(array $data) : self
	{
		$this->data = $data;

		/** @var \Renderable $datum  */
		foreach($data as $datum)
		{
			if(is_object($datum) && \Engine\Util\Classes::hasTrait($datum::class, \Engine\Page\Trait\Scripted::class))
			{
				foreach($datum->getScripts() as $script)
				{
					$this->addScript($script);
				}
			}

			if(is_object($datum) && \Engine\Util\Classes::hasTrait($datum::class, \Engine\Page\Trait\Styled::class))
			{
				foreach($datum->getStyles() as $style)
				{
					$this->addStyle($style);
				}
			}
		}
	
		return $this;
	}

	public function setIsHeader(bool $isHeader = true) : self
	{
		$this->isHeader = $isHeader;
	
		return $this;
	}
	public function setIsRowscoped(bool $isRowscoped = true) : self
	{
		$this->isRowScoped = $isRowscoped;
	
		return $this;
	}
}