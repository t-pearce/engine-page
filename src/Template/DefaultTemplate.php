<?php

namespace Engine\Page\Template;

class DefaultTemplate extends Template
{
	protected function outputHeader() : void
	{
?>
<html>
	<head>
	</head>
<?php
	}

	protected function outputBodyOpen(): void
	{
?>
	<body>
<?php
	}


	protected function outputBodyClose(): void
	{
?>
	</body>
<?php
	}

	protected function outputFooter(): void
	{
?>
</html>
<?php
	}

}