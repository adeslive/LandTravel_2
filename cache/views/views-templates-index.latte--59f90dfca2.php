<?php
// source: C:\Users\usuario\Documents\GitHub\LandTravel_2\src\core/../../views/templates/index.latte

use Latte\Runtime as LR;

class Template59f90dfca2 extends Latte\Runtime\Template
{
	public $blocks = [
		'header' => 'blockHeader',
		'css' => 'blockCss',
		'body' => 'blockBody',
	];

	public $blockTypes = [
		'header' => 'html',
		'css' => 'html',
		'body' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('header', get_defined_vars());
?>

<?php
		$this->renderBlock('css', get_defined_vars());
?>

<?php
		$this->renderBlock('body', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		$this->parentName = 'base/base.latte';
		
	}


	function blockHeader($_args)
	{
		extract($_args);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top">
  <a class="navbar-brand" href="/">Land Travel</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/viajes/">Viajes</a>
      </li>
<?php
		if (isset($user)) {
			if ($user['tipo_usuario'] == 'Admin') {
?>
        <li class="nav-item">
          <a class="nav-link" href="/guias/">Guías</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/tours/">Tours</a>
        </li>
<?php
			}
			elseif ($user['tipo_usuario'] == 'Guia') {
?>
        <li class="nav-item">
          <a class="nav-link" href="/guias/">Tours</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/tours/">Calendario</a>
        </li>
<?php
			}
			else {
?>
        <li class="nav-item">
          <a class="nav-link" href="/guias/">Historial</a>
        </li>
<?php
			}
		}
?>
    </ul>
<?php
		if (isset($user)) {
?>
    <ul class="navbar-nav navbar-right">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i> <?php echo LR\Filters::escapeHtmlText($user['pnombre']) /* line 44 */ ?> <?php
			echo LR\Filters::escapeHtmlText($user['papellido']) /* line 44 */ ?>

        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="/perfil">Perfil</a>
          <a class="dropdown-item" href="/configuracion">Configuración</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/logout">Cerrar sesión</a>
        </div>
      </li>
    </ul>
<?php
		}
		else {
?>
    <ul class="navbar-nav navbar-right">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i> Usuario
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
<?php
			/* line 61 */
			$this->createTemplate('usuarios/login.latte', $this->params, "include")->renderToContentType('html');
?>
        </div>
      </li>
    </ul>
<?php
		}
?>
  </div>
</nav>
<?php
	}


	function blockCss($_args)
	{
?><link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/main.css">
<?php
	}


	function blockBody($_args)
	{
?>  
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-4">Fluid jumbotron</h1>
      <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
    </div>
  </div>
 
<?php
	}

}
