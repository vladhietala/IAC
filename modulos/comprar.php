<div id="miolo">
    <div id="titulo">:: COMPRAR</div>
    <div id="resultado">
    <?php

	  $sql = mysql_query ("INSERT INTO Pedido (Cliente_CliCodigo, PedStatus) VALUES ('$codigo_usu','A')");
	  if (!mysql_affected_rows())
	    echo "<br /><br /><br /><h3 align=\"center\">Ocorreu um erro ao tentar registrar seu pedido. Por favor tente novamente mais tarde.</h3>";

	  $sql = mysql_query ("SELECT PedNum FROM Pedido WHERE Cliente_CliCodigo='$codigo_usu' ORDER BY PedNum DESC LIMIT 1 ");
	  $num_pedido = mysql_result ($sql, 0, 'PedNum');

	  echo "<h1>PEDIDO: $num_pedido</h1>";
	  echo "<h4>" . date("d/m/y") . "</h4>";
	  echo "<h4>Cliente: $nome_usu</h4>";
	  echo "<h4>Endere&ccedil;o de entrega: $endereco_usu - $cep_usu - $bairro_usu - $cidade_usu - $estado_usu</h4><br /><hr />";

    ?>

    
    
    <form method="post" action="?sistema=car&acao=alt">

	<div class="prodnome">Produto</div>
	<div class="quant">Quat.</div>
	<div class="valor">Valor Unit.</div>
	<div class="valor">Subtotal</div>
	<div class="imagem">&nbsp;</div><br clear="all"/>
	<hr><br />
    <?php
	if(empty($senha_usu))
	      include "includes/logar.inc";
	else if(!isset($_SESSION['carrinho']))
	{
	  echo "<h3>Voc&ecirc; ainda n&atilde;o possui pedidos.</h3>";
	}
	else 
	{

	      $calculo = 0;
	      foreach ($_SESSION['carrinho'] as $pid => $qtd)
	      {
		    $sql = mysql_query ("SELECT ProdNome, ProdValorVenda FROM Produto WHERE ProdCodigo='$pid'");
		    $produto = mysql_result($sql, 0, 'ProdNome');
		    $valor = mysql_result($sql, 0, 'ProdValorVenda');
		    $moeda = number_format($valor, 2, ',' , '.');
		    $sub = ($valor * $qtd);
		    $subtotal = number_format(($sub), 2, ',' , '.');
		    echo "<div class=\"prodnome\">:: $produto</div>";
		    echo "<div class=\"quant\">$qtd</div>";
		    echo "<div class=\"valor\">R$ $moeda</div>";
		    echo "<div class=\"valor\">R$ $subtotal</div>";
		    echo "<br />";
		    $calculo += $sub;

		    $nSQL = "INSERT INTO ItensPedido (Produto_ProdCodigo, Pedido_PedNum, Quantidade, ValorUnit)";
		    $nSQL .= "VALUES ('$pid','$num_pedido','$qtd', '$valor')";
		    mysql_query($nSQL);
			
                    
	      }
	      unset($_SESSION['carrinho']);

	}
    ?>

      <div id="rodape_carrinho">
	  <div class="valor_frete">Frete: 
		  <?php 
		      if($calculo > 1000.00)
		      {
			echo "Gratis!"; 
			$vlrFrete = 0;
			$total = number_format($calculo, 2, ',' , '.');
		      }
		      else
		      {
			echo "R$ 20,00";
			$vlrFrete = 20;
			$tot = $calculo + $vlrFrete;
			$total = number_format($tot, 2, ',' , '.');
		      }
		      
		      $nSQL =mysql_query ("UPDATE Pedido SET PedFrete='$vlrFrete' WHERE PedNum='$num_pedido'");

		  ?>
	  </div><br clear="all" />
	  <div class="total">Total: R$ <?php echo $total; ?></div><br clear="all" />
	  <div><a target="_blank" href="index.php?sistema=ped&acao=boleto&pedido=<?php echo $num_pedido ?>local"><img src="images/geraboleto.jpg" /></a></div>
      </div>

    </form>
    </div>
</div>
