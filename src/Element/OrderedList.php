<?php

namespace Engine\Page\Element;

class OrderedList extends ListElement
{
	public function getTag(): string 
	{
		return "ol";
	}

	protected function getChildElement(): ListItem
	{
		return ListItem::create();
	}
}