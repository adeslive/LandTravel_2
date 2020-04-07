<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\views\templates\components\error.latte

use Latte\Runtime as LR;

class Templateac243259d5 extends Latte\Runtime\Template
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
        <i class="ml-4 mt-3 fas fa-exclamation-triangle fa-4x" style="color:red;width:80px;height:80px;"></i>
        <div class="col">
            <p id="error-message-<?php echo LR\Filters::escapeHtmlAttr($titulo) /* line 8 */ ?>" class="h4 mt-4">¡Ha ocurrido un error!</p>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<?php
	}

}
