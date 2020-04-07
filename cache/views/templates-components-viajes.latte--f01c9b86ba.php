<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\views\templates\components\viajes.latte

use Latte\Runtime as LR;

class Templatef01c9b86ba extends Latte\Runtime\Template
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
<?php
				if (isset($user)) {
					if ($user['tipo_usuario'] == 'Admin') {
?>
                <div class="mb-3 btn-group" role="group">
                  <a class="btn btn-primary" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 17 */ ?>"> Mas detalles </a> 
                  <a class="btn btn-danger" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 18 */ ?>/modificar">Modificar</a>
                  <a class="btn btn-warning" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 19 */ ?>/eliminar">Eliminar</a>
                </div>
<?php
					}
					elseif ($user['tipo_usuario'] == 'Guia') {
?>
                <div class="mb-3 btn-group" role="group">
                  <a class="btn btn-primary" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 23 */ ?>"> Mas detalles </a> 
                  <a class="btn btn-primary" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 24 */ ?>/tours">Ver tours</a>
                </div>
<?php
					}
					else {
?>
                <div class="mb-3 btn-group" role="group">
                  <a class="btn btn-primary" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 28 */ ?>"> Mas detalles </a> 
                  <a class="btn btn-primary" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 29 */ ?>/comprar">Comprar ahora</a>
                  <a class="btn btn-secondary" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 30 */ ?>/reservar">Reservar</a>
                </div>
<?php
					}
				}
				else {
?>
                <div class="mb-3 btn-group" role="group">
                  <a class="btn btn-primary" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 35 */ ?>"> Mas detalles </a> 
                  <a class="btn btn-primary" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 36 */ ?>/comprar">Comprar ahora</a>
                  <a class="btn btn-secondary" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 37 */ ?>/reservar">Reservar</a>
                </div>
<?php
				}
?>
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
