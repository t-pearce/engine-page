<?php

namespace Engine\Page\Element\Model;

class DataListEntry extends \Engine\Model\Model
{
	protected string $key;
	protected string $value;

	public function __construct(string $key, string $value)
	{
		$this->key = $key;
		$this->value = $value;
	}
}