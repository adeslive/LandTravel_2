<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\views\templates\components\viaje-detail.latte

use Latte\Runtime as LR;

class Templatef0602b1931 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		?><div class="collapse" id="info-<?php echo LR\Filters::escapeHtmlAttr($id) /* line 1 */ ?>">
  <div class="card card-body border-0">
    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
    <a class="btn btn-primary" href="viajes/<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($id)) /* line 4 */ ?>"> Mas detalles </a> 
  </div>
</div><?php
		return get_defined_vars();
	}

}
