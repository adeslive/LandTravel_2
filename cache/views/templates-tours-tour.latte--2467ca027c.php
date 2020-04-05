<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../views/templates/tours/tour.latte

use Latte\Runtime as LR;

class Template2467ca027c extends Latte\Runtime\Template
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
?>    <video id="myVideo" autoplay="true" muted="true" loop="true">
            <source src="video/rain.mp4" type="video/mp4">
                <!--<source srcRA="rain.mp4" type="video/mp4">-->
    </video>
    <div class="overlay"></div>
    
    <div class="container content">
        <h1 class="display-1 text-center tour-title" >Tour por toda europa</h1>
        <div class="card border-2">
            <div class="card-header text-right buttons">
                <a class="btn btn-primary" type="button" href="#">Comprar ahora</a>
                <a class="btn btn-secondary" type="button" href="#">Reservar</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <img class="img-fluid rounded" src="img/test.jpg" alt="...">
                        <div class="mt-4">
                            <h3 class="my-3">Descripción del viaje</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.</p>
                            <h3 class="my-3">Detalles</h3>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Cras justo odio</li>
                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                <li class="list-group-item">Morbi leo risus</li>
                                <li class="list-group-item">Porta ac consectetur ac</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul>
                        </div>
                    </div> 
                    <div class="col">
                        <div class="container">
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
