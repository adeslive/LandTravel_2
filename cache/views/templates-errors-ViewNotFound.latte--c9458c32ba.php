<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../views/templates/errors/ViewNotFound.latte

use Latte\Runtime as LR;

class Templatec9458c32ba extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<h1> La vista no existe, verifica las rutas y controladores</h1>
<?php
		return get_defined_vars();
	}

}
