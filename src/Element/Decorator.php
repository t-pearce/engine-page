<?php

namespace Engine\Page\Element;

abstract class Decorator extends Div
{
	protected mixed $value;

	public function setValue(mixed $value) : self
	{
		$this->value = $value;
	
		return $this;
	}
}