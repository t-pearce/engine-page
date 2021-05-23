<?php

namespace Engine\Page\Template;

class DefaultTemplate extends Template
{
	protected function outputHeaderOpen() : void
	{
?><html>
	<head><?php
	}

	protected function outputHeaderClose() : void
	{
?></head><?php
	}

	protected function outputBodyOpen(): void
	{
?><body><?php
	}


	protected function outputBodyClose(): void
	{
?></body><?php
	}

	protected function outputFooter(): void
	{
?></html><?php
	}

}