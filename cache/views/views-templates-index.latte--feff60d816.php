<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../views/templates/index.latte

use Latte\Runtime as LR;

class Templatefeff60d816 extends Latte\Runtime\Template
{
	public $blocks = [
		'body' => 'blockBody',
	];

	public $blockTypes = [
		'body' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('body', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		$this->parentName = 'base/base.latte';
		
	}


	function blockBody($_args)
	{
?> <section>
      <div class="container"> 
        <h2>Services</h2>
        <p class="text-muted mb-5">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
        <div class="row">
          <div class="col-sm-6 col-lg-4 mb-3">
            <svg class="lnr text-primary services-icon">
              <use xlink:href="#lnr-magic-wand"></use>
            </svg>
            <h6>Ex cupidatat eu</h6>
            <p class="text-muted">Ex cupidatat eu officia consequat incididunt labore occaecat ut veniam labore et cillum id et.</p>
          </div>
          <div class="col-sm-6 col-lg-4 mb-3">
            <svg class="lnr text-primary services-icon">
              <use xlink:href="#lnr-heart"></use>
            </svg>
            <h6>Tempor aute occaecat</h6>
            <p class="text-muted">Tempor aute occaecat pariatur esse aute amet.</p>
          </div>
          <div class="col-sm-6 col-lg-4 mb-3">
            <svg class="lnr text-primary services-icon">
              <use xlink:href="#lnr-rocket"></use>
            </svg>
            <h6>Voluptate ex irure</h6>
            <p class="text-muted">Voluptate ex irure ipsum ipsum ullamco ipsum reprehenderit non ut mollit commodo.</p>
          </div>
          <div class="col-sm-6 col-lg-4 mb-3">
            <svg class="lnr text-primary services-icon">
              <use xlink:href="#lnr-paperclip"></use>
            </svg>
            <h6>Tempor commodo</h6>
            <p class="text-muted">Tempor commodo nostrud ex Lorem occaecat duis occaecat minim.</p>
          </div>
          <div class="col-sm-6 col-lg-4 mb-3">
            <svg class="lnr text-primary services-icon">
              <use xlink:href="#lnr-screen"></use>
            </svg>
            <h6>Et fugiat sint occaecat</h6>
            <p class="text-muted">Et fugiat sint occaecat voluptate incididunt anim nostrud ea cillum cillum consequat.</p>
          </div>
          <div class="col-sm-6 col-lg-4 mb-3">
            <svg class="lnr text-primary services-icon">
              <use xlink:href="#lnr-inbox"></use>
            </svg>
            <h6>Et labore tempor et</h6>
            <p class="text-muted">Et labore tempor et adipisicing dolor.</p>
          </div>
        </div>
      </div>
    </section>
<?php
	}

}
