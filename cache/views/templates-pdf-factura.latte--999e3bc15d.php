<?php
// source: C:\Users\usuario\Documents\GitHub\LandTravel_2\src\core/../../views/templates/pdf/factura.latte

use Latte\Runtime as LR;

class Template999e3bc15d extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<h1>Prueba prueba</h1>
<img src='resources/img/test.jpg' alt='test.jpg'><?php
		return get_defined_vars();
	}

}
