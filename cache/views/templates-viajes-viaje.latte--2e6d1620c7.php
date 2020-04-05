<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../views/templates/viajes/viaje.latte

use Latte\Runtime as LR;

class Template2e6d1620c7 extends Latte\Runtime\Template
{
	public $blocks = [
		'css' => 'blockCss',
		'container' => 'blockContainer',
		'body' => 'blockBody',
	];

	public $blockTypes = [
		'css' => 'html',
		'container' => 'html',
		'body' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('css', get_defined_vars());
?>

<?php
		$this->renderBlock('container', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		$this->parentName = '../base/base.latte';
		
	}


	function blockCss($_args)
	{
?>    <link rel="stylesheet" href="css/video-header.css">
<?php
	}


	function blockContainer($_args)
	{
		extract($_args);
		$this->renderBlock('body', get_defined_vars());
		
	}


	function blockBody($_args)
	{
		extract($_args);
?>
    <video id="myVideo" autoplay="true" muted="true" loop="true">
            <source src="video/<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['pais_principal'])) /* line 10 */ ?>.mp4" type="video/mp4">
                <!--<source srcRA="rain.mp4" type="video/mp4">-->
    </video>
    <div class="overlay"></div>
    
    <div class="container content">
        <h1 class="display-1 text-center viaje-title" ><?php echo LR\Filters::escapeHtmlText(($this->filters->capitalize)($viaje['titulo'])) /* line 16 */ ?></h1>
        <div class="card border-2">
            <div class="container mt-3 buttons text-right">
                <a class="mr-5">$<?php echo LR\Filters::escapeHtmlText($viaje['costo']) /* line 19 */ ?></a>
                <a class="btn btn-primary" type="button" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 20 */ ?>/comprar">Comprar ahora</a>
                <a class="btn btn-secondary" type="button" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($viaje['id'])) /* line 21 */ ?>/reservar"">Reservar</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            <img class="img-fluid rounded viaje-img" src="img/test.jpg" alt="...">
                        </div>
                        <div class="mt-4 ml-3">
                            <h3 class="my-3">Descripción del viaje</h3>
                            <p class="text-justify"><?php echo LR\Filters::escapeHtmlText($viaje['descripcion']) /* line 31 */ ?></p>
                            <h3 class="my-3">Detalles</h3>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Paquetes disponibles: <?php echo LR\Filters::escapeHtmlText($viaje['cupos']) /* line 34 */ ?></li>
                                <li class="list-group-item">Adultos: <?php echo LR\Filters::escapeHtmlText($viaje['numero_adultos']) /* line 35 */ ?></li>
                                <li class="list-group-item">Niños: <?php echo LR\Filters::escapeHtmlText($viaje['numero_niños']) /* line 36 */ ?></li>
                                <li class="list-group-item">Costo: $<?php echo LR\Filters::escapeHtmlText($viaje['costo']) /* line 37 */ ?></li>
                                <li class="list-group-item">Fecha Inicio: <?php echo LR\Filters::escapeHtmlText(($this->filters->date)($viaje['fecha_inicio'], '%d/%m/%Y')) /* line 38 */ ?></li>
                                <li class="list-group-item">Hora: <?php echo LR\Filters::escapeHtmlText(($this->filters->date)($viaje['fecha_inicio'], 'GMT+0 %H:%M')) /* line 39 */ ?></li>
                            </ul>
                        </div>
                    </div> 
                    <div class="col">
                        <div class="container">
<?php
		/* line 45 */
		$this->createTemplate('../components/rutas.latte', $this->params, "include")->renderToContentType('html');
?>
                        </div> 
                    </div> 
                </div>
                <div class="row mt-3">
                    <div class="container">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
	}

}
