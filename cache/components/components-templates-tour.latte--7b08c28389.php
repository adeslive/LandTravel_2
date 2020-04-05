<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../components/templates/tour.latte

use Latte\Runtime as LR;

class Template7b08c28389 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="..." alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div><?php
		return get_defined_vars();
	}

}
