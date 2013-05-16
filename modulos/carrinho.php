<div id="miolo">
    <div id="titulo">:: CARRINHO</div>
    <div id="resultado">
    <form method="post" action="?sistema=car&acao=alt">

	<div class="prodnome">Produto</div>
	<div class="quant">Quatidade</div>
	<div class="valor">&nbsp;</div>
	<div class="valor">Valor Unit.</div>
	<div class="valor">Subtotal</div>
	<div class="imagem">&nbsp;</div><br clear="all"/>
	<hr><br />
    <?php
	if(empty($senha_usu))
	      include "includes/logar.inc";
	else if(!isset($_REQUEST['acao']) & (!isset($_SESSION['carrinho'])))
	{
	  echo "<h5><img src=\"images/carrinho_vazio.jpg\" /></h5>";
	}
	else 
	{
      
	      $pid = $_REQUEST['pid'];
	      $acao = $_REQUEST['acao'];
	      if(!isset($_SESSION['carrinho']))
		  $_SESSION['carrinho'] = array();
	      
	      
	      if($acao=="del")
	      {
		  if(isset($_SESSION['carrinho'][$pid]))
		      unset($_SESSION['carrinho'][$pid]);
	      }
	      else if ($acao=="alt")
	      {
		if (is_array($_REQUEST['quantidade']))
		    foreach ($_REQUEST['quantidade'] as $pid => $qtd)
		    {
			$qtd = intval($qtd);
			if(!empty($qtd) || $qtd != 0)
			    $_SESSION['carrinho'][$pid] = $qtd;
			else
			    unset($_SESSION['carrinho'][$pid]);
		    }
	      }
	      else if ($acao=="add")
	      {
		  if(!isset($_SESSION['carrinho'][$pid]))
		      $_SESSION['carrinho'][$pid] = 1;
		  else
		      $_SESSION['carrinho'][$pid] += 1;

	      }
	      
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
		    echo "<div class=\"quant\"><input name=\"quantidade[$pid]\" value=\"$qtd\"  size=2 maxlength=1/></div>";
		    echo "<div class=\"valor\"><input type=\"submit\" value=\"atualizar\"></div>";
		    echo "<div class=\"valor\">R$ $moeda</div>";
		    echo "<div class=\"valor\">R$ $subtotal</div>";
		    echo "<div class=\"imagem\"><a href=\"?sistema=car&pid=$pid&acao=del\" ><img src=\"images/remover.jpg\" /></a></div><br clear=\"all\" />";
		    echo "<hr><br />";
		    $calculo += $sub;		    
	      }
	    include "includes/rodape_carrinho.inc";
	}
    ?>

     </form>
    </div>
</div>