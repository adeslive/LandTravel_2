<?php
// source: C:\Users\adesl\Documents\GitHub\LandTravel\src\core/../../views/templates/viajes/comprar.latte

use Latte\Runtime as LR;

class Template4b459b8deb extends Latte\Runtime\Template
{
	public $blocks = [
		'body' => 'blockBody',
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'body' => 'html',
		'scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
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


	function blockBody($_args)
	{
		extract($_args);
?>
<div class="row">
    <div class="col">
        <div class="display-4 text-center "><?php echo LR\Filters::escapeHtmlText($viaje['titulo']) /* line 6 */ ?></div>
        <div class="mt-4 ml-3">
            <h3 class="my-3">Descripción del viaje</h3>
            <p class="text-justify"><?php echo LR\Filters::escapeHtmlText($viaje['descripcion']) /* line 9 */ ?></p>
            <div class="row">
                <div class="col">
                    <img class="img-fluid rounded viaje-img" src="img/test.jpg" alt="...">
                </div>
                <div class="col-sm-4">
                    <table class="table table-borderless text-right">
                        <tbody>
                            <tr>
                                <th scope="row">Costo</th>
                                <td>$<?php echo LR\Filters::escapeHtmlText($viaje['costo']) /* line 19 */ ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Descuentos</th>
                                <td>- $<?php echo LR\Filters::escapeHtmlText(isset($viaje['descuentos']) ? $viaje['descuentos'] : 0) /* line 23 */ ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Subtotal</th>
                                <td>$<?php echo LR\Filters::escapeHtmlText($viaje['costo']) /* line 27 */ ?></td>
                            </tr>
                            </tr>
                                <th scope="row">Total</th>
                                <td colspan="2">$<?php echo LR\Filters::escapeHtmlText($viaje['costo']) /* line 31 */ ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5 mt-4">
        <form id="form">
            <h4 class="mb-3">Payment</h4>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cc-name">Name on card</label>
                    <input type="text" class="form-control" id="cc-name" placeholder="" required>
                    <small class="text-muted">Full name as displayed on card</small>
                    <div class="invalid-feedback">
                        Name on card is required
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cc-number">Credit card number</label>
                    <input type="text" class="form-control" id="cc-number" placeholder="" required>
                    <div class="invalid-feedback">
                        Credit card number is required
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="cc-expiration">Expiration</label>
                    <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                    <div class="invalid-feedback">
                        Expiration date required
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="cc-expiration">CVV</label>
                    <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                    <div class="invalid-feedback">
                        Security code required
                    </div>
                </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Solicitar pago</button>
        </form>
    </div>
</div>
<?php
	}


	function blockScripts($_args)
	{
?><script src="js/cc.js"></script>
<?php
	}

}
