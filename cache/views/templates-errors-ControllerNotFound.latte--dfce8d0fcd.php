<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../views/templates/errors/ControllerNotFound.latte

use Latte\Runtime as LR;

class Templatedfce8d0fcd extends Latte\Runtime\Template
{
	public $blocks = [
		'body' => 'blockBody',
	];

	public $blockTypes = [
		'body' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('body', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		$this->parentName = '../base/base.latte';
		
	}


	function blockBody($_args)
	{
?>    <h1> El controlador no existe, verifica las rutas</h1>
<?php
	}

}
