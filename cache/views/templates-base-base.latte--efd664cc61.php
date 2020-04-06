<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\views\templates\base\base.latte

use Latte\Runtime as LR;

class Templateefd664cc61 extends Latte\Runtime\Template
{
	public $blocks = [
		'css' => 'blockCss',
		'header' => 'blockHeader',
		'container' => 'blockContainer',
		'body' => 'blockBody',
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'css' => 'html',
		'header' => 'html',
		'container' => 'html',
		'body' => 'html',
		'scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/6df6898a32.js" crossorigin="anonymous"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="css/login.css">
<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('css', get_defined_vars());
?>
	</head>

	<header>
<?php
		$this->renderBlock('header', get_defined_vars());
?>
	</header>

	<body>
		
<?php
		$this->renderBlock('container', get_defined_vars());
?>

		<div id="overlay">
		<div>
	</body>

	<footer>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="js/login.js"></script>
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
?>		<link rel="stylesheet" href="css/main.css">
<?php
	}


	function blockHeader($_args)
	{
		extract($_args);
		/* line 17 */
		$this->createTemplate('nav.latte', $this->params, "include")->renderToContentType('html');
		
	}


	function blockContainer($_args)
	{
		extract($_args);
?>
		<div class="container">
            <?php
		$this->renderBlock('body', get_defined_vars());
?>
		</div>
<?php
	}


	function blockBody($_args)
	{
		
	}


	function blockScripts($_args)
	{
		
	}

}
