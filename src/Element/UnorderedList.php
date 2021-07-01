<?php

namespace Engine\Page\Element;

class UnorderedList extends ListElement
{
	public function getTag(): string 
	{
		return "ul";
	}

	protected function getChildElement(): ListItem
	{
		return ListItem::create();
	}
}