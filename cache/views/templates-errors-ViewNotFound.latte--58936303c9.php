<?php
// source: C:\Users\usuario\Documents\GitHub\LandTravel_2\src\core/../../views/templates/errors/ViewNotFound.latte

use Latte\Runtime as LR;

class Template58936303c9 extends Latte\Runtime\Template
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
