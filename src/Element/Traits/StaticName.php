<?php

namespace Engine\Page\Element\Traits;

trait StaticName
{
	protected function getTag()
	{
		$reflection = new \ReflectionClass(static::class);

		return strtolower($reflection->getShortName());
	}
}