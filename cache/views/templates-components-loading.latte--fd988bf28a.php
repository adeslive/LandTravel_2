<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\views\templates\components\loading.latte

use Latte\Runtime as LR;

class Templatefd988bf28a extends Latte\Runtime\Template
{
	public $blocks = [
		'modalcontent' => 'blockModalcontent',
	];

	public $blockTypes = [
		'modalcontent' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('modalcontent', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		$this->parentName = 'modal.latte';
		
	}


	function blockModalcontent($_args)
	{
		extract($_args);
		?><div id="modal-body-<?php echo LR\Filters::escapeHtmlAttr($titulo) /* line 4 */ ?>" class="modal-body">
    <div class="row">
        <div class="col-sm-4">
            <div class="lds-ripple"><div></div><div></div></div>
        </div>
        <div class="col">
            <p class="h4 mt-4">Espere un momento</p>
        </div>
    </div>
</div>
<?php
	}

}
