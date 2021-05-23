<?php

namespace Engine\Page;

abstract class DataProvider
{
	protected Page $page;

	public final function __construct(Page $page)
	{
		$this->page = $page;
	}

	abstract public function setData();
}