<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\views\templates\base\nav.latte

use Latte\Runtime as LR;

class Template60a1431c93 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand" href="/">Land Travel</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/viajes/">Viajes</a>
      </li>
    </ul>
<?php
		if (isset($SESSION)) {
?>
    
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
			/* line 25 */
			$this->createTemplate('../usuarios/login.latte', $this->params, "include")->renderToContentType('html');
?>
        </div>
      </li>
    </ul>
<?php
		}
?>
  </div>
</nav><?php
		return get_defined_vars();
	}

}
