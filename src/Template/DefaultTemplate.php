<?php

namespace Engine\Page\Template;

class DefaultTemplate extends Template
{
	public function renderHeader(): string
	{
		ob_start();
?>
<html>
	<head>
	</head>
<?php
		return ob_get_clean();
	}

	public function renderBodyOpen(): string
	{
		ob_start();
?>
	<body>
<?php
		return ob_get_clean();
	}


	public function renderBodyClose(): string
	{
		ob_start();
?>
	</body>
<?php
		return ob_get_clean();
	}

	public function renderFooter(): string
	{
		ob_start();
?>
</html>
<?php
		return ob_get_clean();
	}

}