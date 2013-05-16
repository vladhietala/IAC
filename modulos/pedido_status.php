<div id="miolo">
    <div id="titulo">:: DETALHES DO PEDIDO</div>
    <div id="resultado" />
    

    <?php
	  $num_pedido = $_REQUEST['pedido'];
	  $sql = mysql_query ("SELECT PedData,PedStatus FROM Pedido WHERE PedNum='$num_pedido'");
	  $data = date('d/m/Y', strtotime(mysql_result ($sql, 0, 'PedData')));
	  $status = mysql_result ($sql, 0, 'PedStatus');

	  echo "<h1>PEDIDO: $num_pedido</h1>";
	  echo "<h4>Data do pedido: $data</h4>";
	  echo "<h4>Cliente: $nome_usu</h4>";
	  echo "<h4>Endere&ccedil;o de entrega: $endereco_usu - $cep_usu - $bairro_usu - $cidade_usu - $estado_usu</h4><br /><hr />";	  
	  echo "<h3 class=\"status\">Status: ";
	  switch($status)
	  {
	    case "A": 
		echo "Aguardando Pagamento."; 
	    break;
	    case "T": 
		echo "Em tr&acirc;nsito (Pedido pago, mercadoria em processo de entrega).";
	    break;
	    case "E": 
		echo "Entregue.";
	    break;
            case "P": 
		echo "Pago.";
	    break;
          default: 
		echo "Indefinido, contactar administracao.";
	    break;
	  }
	  echo  "</h3><hr />";
    ?>
     </div>
</div>