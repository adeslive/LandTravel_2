<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../views/templates/usuarios/recuperar.latte

use Latte\Runtime as LR;

class Template7653ad6bfe extends Latte\Runtime\Template
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
            
            <section id="div-correo" class="recover card card-body">
                <h1>¿Olvidaste tu contraseña?</h1>
                <p style="font-size: 18px;">Se le enviará un mensaje a su correo electrónico con el código a ingresar</p
                    s>
                <form method="POST" id="form-recuperar">
                    <div class="row">
                        <div class="col-12">
                            <input name="correo" id="correo" type="email" placeholder="ejemplo@ejemplo.com" required><br>
                        </div>
                    </div>
                    <input id="button-1" type="submit" class="next" value="Enviar Correo"></input>
                </form>
            </section>
            
            <section id="div-recuperar" class="recover card card-body" style="display:none;">
                <h1>Recuperación de Contraseña</h1>
                <p style="font-size: 18px;">Revise su correo electronico, se le ha enviado un código de recuperación.</p s>
            </section>
            
        </div>
        <div class="col-6">
        </div>
    </div>
</div>

<?php
		/* line 38 */
		$this->createTemplate('../components/loading.latte', ['titulo' => 'loading'] + $this->params, "include")->renderToContentType('html');
		/* line 39 */
		$this->createTemplate('../components/error.latte', ['titulo' => 'error'] + $this->params, "include")->renderToContentType('html');
		
	}


	function blockScripts($_args)
	{
?><script src="js/recuperar.js"></script>
<?php
	}

}
