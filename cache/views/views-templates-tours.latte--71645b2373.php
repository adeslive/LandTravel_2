<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../views/templates/tours.latte

use Latte\Runtime as LR;

class Template71645b2373 extends Latte\Runtime\Template
{
	public $blocks = [
		'css' => 'blockCss',
		'body' => 'blockBody',
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'css' => 'html',
		'body' => 'html',
		'scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('css', get_defined_vars());
?>

		<script src="https://kit.fontawesome.com/6df6898a32.js" crossorigin="anonymous"></script>
	</head>

	<header>
<?php
		/* line 13 */
		$this->createTemplate('base/nav.latte', $this->params, "include")->renderToContentType('html');
?>
	</header>
	<body>
		<div class="container mt-2">
<?php
		$this->renderBlock('body', get_defined_vars());
?>
		</div>
	</body>

	<footer>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<?php
		$this->renderBlock('scripts', get_defined_vars());
?>
	</footer>
</html>
<?php
		return get_defined_vars();
	}


	function blockCss($_args)
	{
?>		
<?php
	}


	function blockBody($_args)
	{
		extract($_args);
		/* line 18 */
		$this->createTemplate('components/tours.latte', $this->params, "include")->renderToContentType('html');
		
	}


	function blockScripts($_args)
	{
?>		<script src="js/popover.js"></script>
<?php
	}

}
