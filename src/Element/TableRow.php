<?php

namespace Engine\Page\Element;

class TableRow extends ContainerElement
{
	private bool $isHeader = false;
	private array $data;

	public function render(): string
	{
		/** @var TableHeader|TableData */
		$cell = $this->isHeader ? TableHeader::class : TableData::class;

		foreach($this->data as $datum)
		{
			$toShow = "";

			if(is_array($datum))
				$toShow = implode(", ", $datum);
			else $toShow = $datum;

			$this->addElement
			(
				$cell::create()
				->setContents((string)$toShow)
			);
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
	
		return $this;
	}

	public function setIsHeader(bool $isHeader = true) : self
	{
		$this->isHeader = $isHeader;
	
		return $this;
	}
}