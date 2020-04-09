<!DOCTYPE html>
<html>
<?php
	if(!isset($_SESSION['carrinho'])){
		die('Você não tem items no carrinho!');
	}
?>
<head>
	<title>Delivery System - Danki Code</title>
	<link rel="stylesheet" href="<?= INCLUDE_PATH ?>views/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body>

	<section class="descricao-home">
		<div class="container">
			<h2>Seu Carrinho</h2>
			<a href="<?= INCLUDE_PATH ?>home">Voltar Home</a>
			<div class="clear"></div>
		</div><!--container-->
	</section>

	<div class="container">
	<table width="100%">
		<tr>
			<td>#</td>
			<td>Preço</td>
		</tr>
		<?php
			$carrinhoItems = deliveryModel::getItemsCart();
			foreach ($carrinhoItems as $key => $value) {
			$item = deliveryModel::getItem($value);
		?>
			<tr>
				<td>
					<img src="<?php echo INCLUDE_PATH.'images/'.$item[0]; ?>" />
				</td>
				<td>
					<p>R$<?php echo $item[1]; ?></p>
				</td>
			</tr>

		<?php
			}
		?>

		
	</table>
	<br />

	<p>O total do seu pedido foi: R$<?php echo number_format(deliveryModel::getTotalPedido(), 2, ',', ' '); ?></p>
	<br />
	<br />

	<form method="post">
		<p>Escolha seu método de pagamento:</p>
		<select name="opcao_pagamento">
			<option value="cartao credito">Cartão de Crédito</option>
			<option value="cartao debito">Cartão de Debito</option>
			<option value="dinheiro">Dinheiro</option>
		</select>
		<div style="display: none;" class="troco">
		<p>Troco para quanto?</p>
		<input type="text" name="troco">
		</div>
		<input type="submit" name="acao" value="Fechar Pedido!">
	</form>
	</div>

	<br />

	<br />

	<?php
		if(isset($_POST['acao'])){
			if(!isset($_SESSION['carrinho'])){
				die('você não tem items no carrinho!');
			}

			$metodoPagamento = $_POST['opcao_pagamento'];
			$_SESSION['tipo_pagamento'] = $metodoPagamento;
			$_SESSION['total'] = deliveryModel::getTotalPedido();
			if($metodoPagamento == 'dinheiro'){
				if($_POST['troco'] != ''){
					$valorTroco = $_POST['troco'] - deliveryModel::getTotalPedido();
					if($valorTroco >= 0){
					$_SESSION['valor_troco'] = $valorTroco;
					}else{
						die('Você não especificou um valor correto para o troco!');
					}

				}else{
					die('você escolheu dinheiro como pagamento, portanto precisa especificar o troco!');
				}
			}
			echo '<script>alert("Seu pedido foi efetuado com sucesso!")</script>';
			echo '<script>location.href="'.INCLUDE_PATH.'historico"</script>';
		}
	?>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script>
		$('select').change(function(){
			if($(this).val() == 'dinheiro'){
				$('.troco').show();
			}else{
				$('.troco').hide();
			}
		})
	</script>

</body>
</html>