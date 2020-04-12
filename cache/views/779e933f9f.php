<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../views/templates/usuarios/cambiar-contraseña.latte

use Latte\Runtime as LR;

class Template779e933f9f extends Latte\Runtime\Template
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
?>    <link rel="stylesheet" href="css/recuperar.css">
    <link rel="stylesheet" href="css/main.css">
<?php
	}


	function blockBody($_args)
	{
		extract($_args);
?>
<div class="container">
    <div class="row">
        <div class="col-12" style="align-content: left;">
            
<?php
		if (isset($codigo)) {
?>
            <section id="div-contraseña" class="recover card card-body">
                <h1>Recuperación de contraseña</h1>
                <p style="font-size: 18px;">Escriba la contraseña nueva.</p s>
                <form id="form-contraseña">
                    <div class="row">
                        <div class="col-12">
                            <input id="r-contraseña" name="contraseña" class="form-control" type="password"
                                placeholder="Contraseña" required><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input id="r-ccontraseña" name="ccontraseña" class="form-control" type="password"
                                placeholder="Confirmar Contraseña" required><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input id="button-1" type="submit" class="next" value="Cambiar Contraseña">
                        </div>
                    </div>
                </form>
            </section>
            
            <section id="div-correcto" class="recover card card-body" style="display:none;">
                <h1>Recuperación de contraseña</h1>
                <p style="font-size: 20px;">Hecho!.</p s>
                <form>
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="/" id="button-confirmacion" class="btn btn-primary" type="button">Iniciar Sesión</a>
                        </div>
                    </div>
                </form>
            </section>
<?php
		}
		else {
?>
            <section id="div-invalido" class="recover card card-body">
                <h1>Recuperación de contraseña</h1>
                <p style="font-size: 20px;">El código es inválido, por favor intentalo de nuevo más tarde.</p s>
                <form>
                    <div class="row">
                        <div class="col-12">
                            <a href="/" class="btn btn-primary" type="button">Inicio</a>
                        </div>
                    </div>
                </form>
            </section>
<?php
		}
?>
        </div>
        <div class="col-6">
        </div>
    </div>
</div>
<?php
		/* line 67 */
		$this->createTemplate('../components/loading.latte', ['titulo' => 'loading'] + $this->params, "include")->renderToContentType('html');
		/* line 68 */
		$this->createTemplate('../components/error.latte', ['titulo' => 'error'] + $this->params, "include")->renderToContentType('html');
		
	}


	function blockScripts($_args)
	{
?><script src="js/cambiar-contraseña.js"></script>
<?php
	}

}
