<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\views\templates\components\rutas.latte

use Latte\Runtime as LR;

class Template63e1d26810 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<div class="list-group rutas">
<?php
		$iterations = 0;
		foreach ($rutas as $ruta) {
?>
    <div class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm w-100">
                    <small class="mb-1"><i class="fas fa-plane-departure"></i> Inicio: <?php echo LR\Filters::escapeHtmlText($ruta['inicio']) /* line 7 */ ?></small><br>
                    <small class="mb-1"><i class="fas fa-hourglass-start"></i> Fecha Salida: <?php echo LR\Filters::escapeHtmlText(($this->filters->date)($ruta['fecha_salida'], '%d/%m/%Y')) /* line 8 */ ?></small>
                </div>
                <div class="col-sm w-100">
                    <small class="mb-1"><i class="fas fa-plane-arrival"></i> Destino: <?php echo LR\Filters::escapeHtmlText($ruta['destino']) /* line 11 */ ?></small><br>
                    <small class="mb-1"><i class="fas fa-hourglass-end"></i> Fecha Llegada: <?php echo LR\Filters::escapeHtmlText(($this->filters->date)($ruta['fecha_llegada'], '%d/%m/%Y')) /* line 12 */ ?></small>
                </div>   
            </div>

            <div class="mt-4">
                <div class="row">
                    <div class="col-sm w-100">
                        <small class="mb-1"><i class="fas fa-bus"></i> Transporte: <?php echo LR\Filters::escapeHtmlText($ruta['transporte']) /* line 19 */ ?></small><br>
                    </div>  
                    <div class="col-sm w-100">
                        <small class="mb-1"><i class="fas fa-directions"></i> Tour: <?php echo LR\Filters::escapeHtmlText($ruta['tour'] ? $ruta['tour'] : 'Sin Tour') /* line 22 */ ?></small><br>
                    </div>  
                </div>
                
                <small class="mb-1"><i class="fas fa-hotel"></i> Hotel: <?php echo LR\Filters::escapeHtmlText($ruta['hotel'] ? $ruta['hotel'] : 'Sin Hotel') /* line 26 */ ?></small><br>
<?php
			if ($ruta['hotel']) {
				?>                <small class="mb-1"><i class="fas fa-moon"></i> Noches: <?php echo LR\Filters::escapeHtmlText($ruta['noches']) /* line 28 */ ?></small>
<?php
			}
?>
            </div>
        </div>
    </div>
<?php
			$iterations++;
		}
		?></div><?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			if (isset($this->params['ruta'])) trigger_error('Variable $ruta overwritten in foreach on line 2');
		}
		
	}

}
