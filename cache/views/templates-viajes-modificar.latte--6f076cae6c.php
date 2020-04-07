<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../views/templates/viajes/modificar.latte

use Latte\Runtime as LR;

class Template6f076cae6c extends Latte\Runtime\Template
{
	public $blocks = [
		'css' => 'blockCss',
		'body' => 'blockBody',
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'css' => 'html',
		'body' => 'html',
		'scripts' => 'html',
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
		$this->renderBlock('body', get_defined_vars());
?>

<?php
		$this->renderBlock('scripts', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		$this->parentName = '../base/base.latte';
		
	}


	function blockCss($_args)
	{
?><link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/modificar-viaje.css">
<?php
	}


	function blockBody($_args)
	{
		extract($_args);
?>
<div class="row">
    <div class="col">
        <div class="text-center">
            <img class="img-fluid rounded viaje-img" src="img/test.jpg" alt="...">
        </div>
        <div class="mt-4 ml-3">
            <h3 class="my-3">Descripción del viaje</h3>
            <form id="viaje-form" method="POST">
                <textarea class="text-justify" max-length=500 rows="4" cols="51"> <?php echo LR\Filters::escapeHtmlText($viaje['descripcion']) /* line 17 */ ?> </textarea>
                <h3 class="my-3">Detalles</h3>
                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="cupos">Paquetes disponibles</label>
                                <input type="numeric" name="cupos" class="form-control" id="cupos"
                                    value="<?php echo LR\Filters::escapeHtmlAttr($viaje['cupos']) /* line 25 */ ?>" placeholder="<?php
		echo LR\Filters::escapeHtmlAttr($viaje['cupos']) /* line 25 */ ?>" required>
                            </div>
                            <div class="form-group col">
                                <label for="costo">Costo</label>
                                <input type="numeric" name="costo" class="form-control" id="costo"
                                    placeholder="$<?php echo LR\Filters::escapeHtmlAttr($viaje['costo']) /* line 30 */ ?>" value="$<?php
		echo LR\Filters::escapeHtmlAttr($viaje['costo']) /* line 30 */ ?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="numero_adultos">Adultos</label>
                                <input type="numeric" name="numero_adultos" class="form-control" id="numero_adultos"
                                    placeholder="<?php echo LR\Filters::escapeHtmlAttr($viaje['numero_adultos']) /* line 38 */ ?>" value="<?php
		echo LR\Filters::escapeHtmlAttr($viaje['numero_adultos']) /* line 38 */ ?>"
                                    required>
                            </div>
                            <div class="form-group col">
                                <label for="numero_niños">Niños</label>
                                <input type="numeric" name="numero_niños" class="form-control" id="numero_niños"
                                    placeholder="<?php echo LR\Filters::escapeHtmlAttr($viaje['numero_niños']) /* line 44 */ ?>" value="<?php
		echo LR\Filters::escapeHtmlAttr($viaje['numero_niños']) /* line 44 */ ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="fecha_inicio">Fecha de inicio</label>
                                <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio"
                                    placeholder="<?php echo LR\Filters::escapeHtmlAttr(($this->filters->date)($viaje['fecha_inicio'], '%Y-%m-%d')) /* line 51 */ ?>"
                                    value="<?php echo LR\Filters::escapeHtmlAttr(($this->filters->date)($viaje['fecha_inicio'], '%Y-%m-%d')) /* line 52 */ ?>" required>
                            </div>

                            <div class="form-group col">
                                <label for="hora">Hora (GMT +0) </label>
                                <input type="time" name="hora" class="form-control" id="hora"
                                    placeholder="<?php echo LR\Filters::escapeHtmlAttr(($this->filters->date)($viaje['fecha_inicio'], '%H:%M')) /* line 58 */ ?>"
                                    value="<?php echo LR\Filters::escapeHtmlAttr(($this->filters->date)($viaje['fecha_inicio'], '%H:%M')) /* line 59 */ ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <input id="change-viaje" class="btn btn-primary my-3 py-2" type="button" value="Cambiar">
                        <input id="reset-viaje" class="btn btn-secondary my-3 py-2" type="button" value="Reiniciar">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col">
        <div class="container">
<?php
		/* line 73 */
		$this->createTemplate('../components/rutas.latte', $this->params, "include")->renderToContentType('html');
?>
            <div class="mt-3">
                <div class="form-row">
                    <div class="form-group col">
                        <label for="cupos">Paquetes disponibles</label>
                        <input type="numeric" name="cupos" class="form-control" id="cupos" value="<?php echo LR\Filters::escapeHtmlAttr($viaje['cupos']) /* line 78 */ ?>"
                            placeholder="<?php echo LR\Filters::escapeHtmlAttr($viaje['cupos']) /* line 79 */ ?>" required>
                    </div>
                    <div class="form-group col">
                        <label for="costo">Costo</label>
                        <input type="numeric" name="costo" class="form-control" id="costo"
                            placeholder="$<?php echo LR\Filters::escapeHtmlAttr($viaje['costo']) /* line 84 */ ?>" value="$<?php
		echo LR\Filters::escapeHtmlAttr($viaje['costo']) /* line 84 */ ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        <label for="numero_adultos">Adultos</label>
                        <input type="numeric" name="numero_adultos" class="form-control" id="numero_adultos"
                            placeholder="<?php echo LR\Filters::escapeHtmlAttr($viaje['numero_adultos']) /* line 92 */ ?>" value="<?php
		echo LR\Filters::escapeHtmlAttr($viaje['numero_adultos']) /* line 92 */ ?>" required>
                    </div>
                    <div class="form-group col">
                        <label for="numero_niños">Niños</label>
                        <input type="numeric" name="numero_niños" class="form-control" id="numero_niños"
                            placeholder="<?php echo LR\Filters::escapeHtmlAttr($viaje['numero_niños']) /* line 97 */ ?>" value="<?php
		echo LR\Filters::escapeHtmlAttr($viaje['numero_niños']) /* line 97 */ ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="fecha_inicio">Fecha de inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio"
                            placeholder="<?php echo LR\Filters::escapeHtmlAttr(($this->filters->date)($viaje['fecha_inicio'], '%Y-%m-%d')) /* line 104 */ ?>"
                            value="<?php echo LR\Filters::escapeHtmlAttr(($this->filters->date)($viaje['fecha_inicio'], '%Y-%m-%d')) /* line 105 */ ?>" required>
                    </div>

                    <div class="form-group col">
                        <label for="hora">Hora (GMT +0) </label>
                        <input type="time" name="hora" class="form-control" id="hora"
                            placeholder="<?php echo LR\Filters::escapeHtmlAttr(($this->filters->date)($viaje['fecha_inicio'], '%H:%M')) /* line 111 */ ?>"
                            value="<?php echo LR\Filters::escapeHtmlAttr(($this->filters->date)($viaje['fecha_inicio'], '%H:%M')) /* line 112 */ ?>" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	}


	function blockScripts($_args)
	{
?><script src="js/modificar-viaje.js"></script>
<?php
	}

}
