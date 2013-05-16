<div id="miolo">

    <div id="titulo">:: PRODUTOS</div>
    <div id="resultado">
	<?php
	  $codprod = $_REQUEST ["catcod"];

	  $sql = mysql_query ("SELECT * FROM Produto WHERE Categoria_CatCodigo='$codprod'");
	  $cont = mysql_num_rows ($sql);

	  for($i=0; $i<$cont; $i++)
	  {
	    $produto = mysql_result($sql, $i, 'ProdNome');
	    $codigo = mysql_result($sql, $i, 'ProdCodigo');
	    $valor = mysql_result($sql, $i, 'ProdValorVenda');
	    $quantidade = mysql_result($sql, $i, 'ProdQuantidade');
	    $moeda = number_format($valor, 2, ',' , '.');
	    echo "<div class=\"produto\"><a href=\"index.php?sistema=prod&pid=$codigo\" >:: $produto</a></div>";
	    if($quantidade==0)
	    {
	      echo "<div class=\"disp\">Esgotado</div>";
	      echo "<div class=\"imagem\"><img src=\"images/branco.gif\" /></div>";
	      echo "<br clear=\"all\"\><hr>";
	    }
	    else
	    {
		echo "<div class=\"frete\">";
		frete ($valor);
		echo "</div>";
		echo "<div class=\"valor\">R$ $moeda</div>";
		echo "<div class=\"imagem\"><a href=\"index.php?sistema=car&pid=$codigo&acao=add\" ><img src=\"images/carrinho.gif\" /></a></div>";
		echo "<br clear=\"all\"\><hr>";
	    }
	  }
    

	?>
      </div>

</div>