<?php

namespace Engine\Page\Element\Factory;

class DataCollectionElementFactory
{
	public function getDataCollectionElement(array $array, bool $ordered = false)
	{
		if(!\Engine\Util\Arrays::isAssoc($array))
		{
			if($ordered)
			{
				return \Engine\Page\Element\OrderedList::create()
				->setEntries($array);
			}
			else
			{
				return \Engine\Page\Element\UnorderedList::create()
				->setEntries($array);
			}
		}
		else
		{
			$dataListEntries = [];

			foreach($array as $key => $value)
			{
				$dataListEntries[] = new \Engine\Page\Element\Model\DataListEntry($key, $value);
			}

			return \Engine\Page\Element\DataList::create()
			->setEntries(...$dataListEntries);
		}
	}
}