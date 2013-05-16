<div id="miolo">
    <div id="titulo">:: MEUS PEDIDOS</div>
    <div id="resultado" />
    
    <form method="post" action="?sistema=ped" class="cad" >
    <?php
      $sql = mysql_query ("SELECT PedNum FROM Pedido WHERE Cliente_CliCodigo='$codigo_usu'");
      $cont = mysql_num_rows($sql);


      if($cont==0)
	 echo "<h2>Voc&ecirc; ainda n&atilde;o tem pedidos realizados. </h2>";
      else
      {
	    echo "<h3>Meus pedidos:</h3><br />";
	    echo "<select name=\"pedido\">";
	    for($i=0; $i<$cont;$i++)
	    {
	      $pedido = mysql_result($sql, $i, 'PedNum' );
	      echo "<option value=\"$pedido\">$pedido</option>";


	    }
	    echo "</select><br /><br />";
      }

    ?>

	  <input type="radio" name="acao" value="detalhes" checked>Detalhes do Pedido.<br />
	  <input type="radio" name="acao" value="boleto">Imprimir 2&#170; via boleto.<br />
	  <input type="radio" name="acao" value="status">Acompanhar Pedido.<br /><br />
	  <input name="next" type="submit" class="botao" value="Enviar">
	  
     </form>

     </div>
</div>