<?php

namespace Engine\Page\Element;

final class Heading extends ContainerElement
{
	private string $contents;
	private int $level = 1;

	protected function constructClosingTag() : string
	{
		return "</h{$this->level}>";
	}

	protected function constructOpeningTag() : string
	{
		return "<h{$this->level}>";
	}
	public function setContents(string $contents) : self
	{
		$this->addElement((new Literal())->setContents($contents));
	
		return $this;
	}
	public function setLevel(int $level) : self
	{
		if($level < 1 || $level > 6)
			throw new \LogicException("Heading Level {$level} is not supported");

		$this->level = $level;
	
		return $this;
	}

}