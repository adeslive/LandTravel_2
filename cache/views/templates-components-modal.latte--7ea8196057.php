<?php
// source: C:\Users\usuario\Documents\GitHub\LandTravel_2\views\templates\components\modal.latte

use Latte\Runtime as LR;

class Template7ea8196057 extends Latte\Runtime\Template
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
<!-- Modal -->
<div class="modal fade" id="modal-<?php echo LR\Filters::escapeHtmlAttr($titulo) /* line 2 */ ?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-<?php
		echo LR\Filters::escapeHtmlAttr($titulo) /* line 2 */ ?>-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('modalcontent', get_defined_vars());
?>
    </div>
  </div>
</div><?php
		return get_defined_vars();
	}


	function blockModalcontent($_args)
	{
		extract($_args);
?>
      <div class="modal-header">
        <h5 class="modal-title" id="modal-<?php echo LR\Filters::escapeHtmlAttr($titulo) /* line 7 */ ?>-label">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
<?php
	}

}
