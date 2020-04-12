<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../views/templates/guias/tours.latte

use Latte\Runtime as LR;

class Templatefb2d109d72 extends Latte\Runtime\Template
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

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('css', get_defined_vars());
?>

<?php
		$this->renderBlock('body', get_defined_vars());
?>

<?php
		$this->renderBlock('scripts', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		$this->parentName = '../base/base.latte';
		
	}


	function blockCss($_args)
	{
?><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.0/main.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.0/main.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.4.0/main.css">
<link rel="stylesheet" href="css/main.css">
<?php
	}


	function blockBody($_args)
	{
?><div class="row">
    <div class="col"></div>
    <div class="col-md-6"><div id="calendar"></div></div>
</div>
<div class="row">
    <div class="col text-right mt-3">
        <button class="btn btn-primary">Descargar</button>
    </div>
</div>
<?php
	}


	function blockScripts($_args)
	{
?><script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.4.0/main.min.js"></script>
<script src="js/calendario.js"></script>
<?php
	}

}
