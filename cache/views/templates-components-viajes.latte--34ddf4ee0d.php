<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\views\templates\components\viajes.latte

use Latte\Runtime as LR;

class Template34ddf4ee0d extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		if (isset($viajes)) {
?>
  <div class="row">
<?php
			$iterations = 0;
			foreach ($viajes as $viaje) {
?>
    <div class="col">
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="img/test.jpg"  class="card-img" alt="..." style="min-width:100%;min-height:100%;">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?php echo LR\Filters::escapeHtmlText($viaje['titulo']) /* line 12 */ ?> <small class="text-muted">$<?php
				echo LR\Filters::escapeHtmlText($viaje['costo']) /* line 12 */ ?></small> </h5>
              <p class="card-text"><?php echo LR\Filters::escapeHtmlText($viaje['descripcion']) /* line 13 */ ?></p>
              <div class="mb-3 btn-group" role="group">
                <a class="btn btn-primary" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 15 */ ?>"> Mas detalles </a> 
                <a class="btn btn-primary" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 16 */ ?>/comprar">Comprar ahora</a>
                <a class="btn btn-secondary" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 17 */ ?>/reservar">Reservar</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
				$iterations++;
			}
?>
  </div>
<?php
		}
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			if (isset($this->params['viaje'])) trigger_error('Variable $viaje overwritten in foreach on line 3');
		}
		
	}

}
