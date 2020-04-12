<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../views/templates/errors/ControllerNotFound.latte

use Latte\Runtime as LR;

class Templatedfce8d0fcd extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<h1> El controlador no existe, verifica las rutas</h1>
<?php
		return get_defined_vars();
	}

}
