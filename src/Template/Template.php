<?php

namespace Engine\Page\Template;

abstract class Template
{
	use \Engine\Traits\Singleton;

	abstract public function renderHeader() : string;
	abstract public function renderBodyOpen() : string;
	abstract public function renderBodyClose() : string;
	abstract public function renderFooter() : string;
}