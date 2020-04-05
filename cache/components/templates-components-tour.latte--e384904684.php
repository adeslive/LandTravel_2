<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../views/templates/components/tour.latte

use Latte\Runtime as LR;

class Templatee384904684 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		if (isset($tours)) {
?>
  <div class="row">
<?php
			$iterations = 0;
			foreach ($tours as $tour) {
?>
    <div class="col">
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="img/test.jpg"  class="card-img" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
				$iterations++;
			}
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
