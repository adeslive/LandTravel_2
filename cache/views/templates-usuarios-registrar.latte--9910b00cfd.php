<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../views/templates/usuarios/registrar.latte

use Latte\Runtime as LR;

class Template9910b00cfd extends Latte\Runtime\Template
{
	public $blocks = [
		'css' => 'blockCss',
		'header' => 'blockHeader',
		'container' => 'blockContainer',
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'css' => 'html',
		'header' => 'html',
		'container' => 'html',
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
		$this->renderBlock('header', get_defined_vars());
?>

<?php
		$this->renderBlock('container', get_defined_vars());
?>

<?php
		$this->renderBlock('scripts', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			if (isset($this->params['pais'])) trigger_error('Variable $pais overwritten in foreach on line 73');
		}
		$this->parentName = '../base/base.latte';
		
	}


	function blockCss($_args)
	{
?><link rel="stylesheet" href="css/registrar.css">
<?php
	}


	function blockHeader($_args)
	{
		
	}


	function blockContainer($_args)
	{
		extract($_args);
?>
<div class="bg"></div>
<div class="container-fluid registrar">
    <div>
        <div class="row">
            <div class="col-sm-4 page-title text-left">
                <div class="display-2 text-white">Land Travel</div>
                <div class="dropdown-divider"></div>
                <p class="h2 mt-5 mb-0 text-white">Tu primera opción en viajes.</p>
            </div>
            <div class="col-sm-4">
                <div id="card" class="card">
                    <div class="card-body">
                        <div id="section0">
                            <div class="card-title text-center">
                                <h2>Para empezar hablanos sobre ti</h2>
                            </div>
                            <div class="form-check">
                                <div class="form-group">
                                    <label for="tipo_usuario">Tipo de usuario</label>
                                    <select class="form-control" name="tipo_usuario" id="tipo_usuario" style="margin-left:-10px !important;">
                                        <option value="Cliente" selected>Cliente</option>
                                        <option value="Guia">Guía</option>
                                    </select>
                                    <div class="form-group mt-3">
                                        <label for="papellido">Genero</label>
                                        <select class="form-control" name="genero" id="genero" style="margin-left:-10px !important;">
                                            <option value="0" selected>Hombre</option>
                                            <option value="1">Mujer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="section1" style="display:none;">
                            <form id="form-datos" method="POST">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pnombre">Primer Nombre</label>
                                        <input type="text" name="pnombre" class="form-control" id="pnombre" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="papellido">Primer Apellido</label>
                                        <input type="text" class="form-control" name="papellido" id="papellido"
                                            required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="correo" id="correo" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="contraseña">Contraseña</label>
                                        <input type="password" class="form-control" name="contraseña" id="contraseña"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row">
                                 <div class="form-group col-md-4">
                                        <label for="pais">Pais</label>
                                        <select id="pais" name="pais" class="form-control" required>
                                            <?php
		$iterations = 0;
		foreach ($paises as $pais) {
			if ($pais['id'] != 0) {
				?><option value="<?php echo LR\Filters::escapeHtmlAttr($pais['id']) /* line 73 */ ?>"><?php echo LR\Filters::escapeHtmlText($pais['nombre']) /* line 73 */ ?></option><?php
			}
			$iterations++;
		}
?>

                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="dir">Direccion de residencia</label>
                                        <input type="text" class="form-control" name="dir" id="dir" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="telefono">Telefono</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono"
                                            required>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="fecha_nacimiento">Fecha Nacimiento</label>
                                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="pasaporte">Pasaporte</label>
                                        <input type="text" class="form-control" name="pasaporte" id="pasaporte"
                                            required>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="fecha_expiracion">Expiración</label>
                                        <input type="date" id="fecha_expiracion" name="fecha_expiracion"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <input id="data" type="submit" value="Siguiente" class="btn btn-primary"></input>
                                </div>
                            </form>
                        </div>
                        <div id="section2" style="display:none;">
                            <div class="card-title mb-2 text-center">
                                <h2 class="">Último paso</h2>
                            </div>
                            <p class="card-text mb-2">Te hemos enviado un correo de verificación, ¡revisalo!</p>
                        </div>

                        <div class="text-center">
                            <a id="next" href="#" type="button" class="btn btn-primary">Siguiente</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
		/* line 124 */
		$this->createTemplate('../components/loading.latte', ['titulo' => 'loading'] + $this->params, "include")->renderToContentType('html');
		/* line 125 */
		$this->createTemplate('../components/error.latte', ['titulo' => 'error'] + $this->params, "include")->renderToContentType('html');
?>
    </div>
</div>
<?php
	}


	function blockScripts($_args)
	{
?><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="js/signup.js"></script>
<?php
	}

}
