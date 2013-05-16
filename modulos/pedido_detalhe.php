


<div id="miolo">
    <div id="titulo">:: DETALHES DO PEDIDO</div>
    <div id="resultado" />
    

    <?php
	  $num_pedido = $_REQUEST['pedido'];
	  $sql = mysql_query ("SELECT PedData FROM Pedido WHERE PedNum='$num_pedido'");
	  $data = date('d/m/Y', strtotime(mysql_result ($sql, 0, 'PedData')));

	  echo "<h1>PEDIDO: $num_pedido</h1>";
	  echo "<h4>Data do pedido: $data</h4>";
	  echo "<h4>Cliente: $nome_usu</h4>";
	  echo "<h4>Endere&ccedil;o de entrega: $endereco_usu - $cep_usu - $bairro_usu - $cidade_usu - $estado_usu</h4><br /><hr />";
    ?>

    
    
	<div class="prodnome">Produto</div>
	<div class="quant">Quat.</div>
	<div class="valor">Valor Unit.</div>
	<div class="valor">Subtotal</div>
	<div class="imagem">&nbsp;</div><br clear="all"/>
	<hr><br />
    <?php
	 $sql =    "SELECT Produto.ProdNome, Pedido.PedFrete, Pedido.PedData, Pedido.PedNum, Produto_ProdCodigo, ValorUnit, Quantidade,";
	 $sql .=   " (Quantidade * ValorUnit) AS Total FROM ItensPedido ";
	 $sql .=   " INNER JOIN Pedido ON ItensPedido.Pedido_PedNum = Pedido.PedNum ";
	 $sql .=   " INNER JOIN Produto ON ItensPedido.Produto_ProdCodigo = Produto.ProdCodigo ";
	 $sql .=   " WHERE Pedido.PedNum = '$num_pedido'";
	 $dados = mysql_query($sql);

	 $cont = mysql_num_rows($dados);
	 $frete = mysql_result($dados, 0, 'PedFrete');
	 $total = 0;
	 for($i=0; $i<$cont; $i++)
	 {

	    $produto   = mysql_result($dados, $i, 'ProdNome');
	    $valorUnit = mysql_result($dados, $i, 'ValorUnit');
	    $subTotal  = mysql_result($dados, $i, 'Total');
	    $qtd       = mysql_result($dados, $i, 'Quantidade');
	    
	    $total += $subTotal;

	    $valorUnit = number_format($valorUnit, 2, ',' , '.');
	    $subTotal  = number_format($subTotal, 2, ',' , '.');

	    echo "<div class=\"prodnome\">:: $produto</div>";
	    echo "<div class=\"quant\">$qtd</div>";
	    echo "<div class=\"valor\">R$ $valorUnit</div>";
	    echo "<div class=\"valor\">R$ $subTotal</div>";
	    echo "<br />";
	  }
    ?>

      <div id="rodape_carrinho">
	  <div class="valor_frete">Frete: <?php  echo number_format($frete, 2, ',' , '.'); ?></div><br clear="all" />
	  <div class="total">Total: R$ <?php echo number_format(($total + $frete), 2, ',' , '.'); ?></div><br clear="all" />
	 

</div>
     </div>
</div>