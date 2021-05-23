<?php

namespace Engine\Page\Element;

final class Literal extends Element
{
	private string $contents;

	public function render(): string
	{
		return $this->contents;
	}
	protected function constructClosingTag() : string
	{
		return "";
	}

	protected function constructOpeningTag() : string
	{
		return "";
	}
	public function setContents(string $contents) : self
	{
		$this->contents = $contents;
	
		return $this;
	}
}