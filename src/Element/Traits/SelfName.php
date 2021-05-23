<?php

namespace Engine\Page\Element\Traits;

trait SelfName
{
	protected function getTag()
	{
		$reflection = new \ReflectionClass(self::class);

		return strtolower($reflection->getShortName());
	}
}