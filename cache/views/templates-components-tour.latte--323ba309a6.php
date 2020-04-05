<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\views\templates\components\tour.latte

use Latte\Runtime as LR;

class Template323ba309a6 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		if (isset($tours)) {
?>
  <div class="row">
<?php
			$iterations = 0;
			foreach ($iterator = $this->global->its[] = new LR\CachingIterator($tours) as $tour) {
?>
    <div class="col">
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?php echo LR\Filters::escapeHtmlText($tour['detalle']) /* line 9 */ ?></h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              <div class="mb-3">
                <a class="btn btn-primary" href="tours/">Comprar</a>
                <a class="btn btn-primary" href="tours/">Reservar</a>
              </div>
              <a style="cursor: pointer;" type="button" data-toggle="collapse" data-target="#info-<?php echo LR\Filters::escapeHtmlAttr($tour['id']) /* line 16 */ ?>" aria-expanded="false" aria-controls="collapseExample"> Detalles del tour
                <i class="fas fa-angle-double-down">
                </i> 
              </a>
            </div>
          </div>
          <div class="col-md-4">
            <img src="img/test.jpg"  class="card-img" alt="...">
          </div>
        </div>
        <div class="row no-gutters">
<?php
				/* line 27 */
				$this->createTemplate("tour-detail.latte", ['id' => $tour['id']] + $this->params, "include")->renderToContentType('html');
?>
        </div>
      </div>
    </div>
<?php
				$iterations++;
			}
			array_pop($this->global->its);
			$iterator = end($this->global->its);
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
			if (isset($this->params['tour'])) trigger_error('Variable $tour overwritten in foreach on line 3');
		}
		
	}

}
