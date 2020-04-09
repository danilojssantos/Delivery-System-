<!DOCTYPE html>
<html>
<head>
	<title>Delivery System </title>
	<link rel="stylesheet" href="<?=INCLUDE_PATH ?>views/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body>

	<section class="descricao-home">
		<div class="container">
			<h2><i class="fas fa-bullhorn"></i> Faça seu pedido conosco!</h2>
			<a href="<?= INCLUDE_PATH ?>fechar-pedido">Fechar Pedido!</a>
			<div class="clear"></div>
		</div><!--container-->
	</section>

	<section class="lista-produtos">
		<div class="container">
			<?php
				$sushis = deliveryModel::listarItems();
				foreach($sushis as $key=>$value){
			?>
			<div class="box-single-food">
				<img src="<?php echo INCLUDE_PATH ?>images/<?= $value['0'] ?>" />
				<p>R$<?= $value['1'] ?></p>
				<a href="<?= INCLUDE_PATH ?>?addCart=<?= $key ?>">Adicionar ao carrinho</a>
			</div>
			<?php } ?>

		
			<div class="clear"></div>
		</div>
	</section>

</body>
</html>