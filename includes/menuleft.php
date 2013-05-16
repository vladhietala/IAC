<div id="left_sidebar">


    <div id="newsletter">
	    <a href="index.php?sistema=ana"><img src="images/pecas.jpg" /></a>
    </div>

    <div id="categories">
        <div id="categories_header">
          <h2>Pesquisar</h2>
        </div>
        <form method="get" action="index.php">
            <ul>
                <li><input id="buscaq" type="text" name="q" value="<?php echo isset($_GET['q'])?$_GET['q']:'Buscar' ?>" /><input class="botao" type="submit" value="OK"/></li>
            </ul> 
        </form>
    </div>
    <div id="categories">
	    <div id="categories_header">
	      <h2>Fabricantes</h2>
	    </div>

	    <ul>
	    <?php
	      $sql = mysql_query ("SELECT * FROM Categoria ORDER BY CatNome");
	      $cont = mysql_num_rows ($sql);
	      for($i=0; $i<$cont; $i++)
	      {
		$categoria = mysql_result($sql, $i, 'CatNome');    
		$codigo = mysql_result($sql, $i, 'CatCodigo');
		echo "<li>";
		echo "<a href=\"index.php?cat=$codigo\">";
		echo "$categoria</a></li>"; 
	      }
	    ?>
	    
	    </ul>
    </div>
    <?php if($_SESSION['admin']) { ?>
    <div id="categories">
	    <div id="categories_header">
	      <h2>Administração</h2>
	    </div>

	    <ul>
                <li><a href="?sistema=fab">Fabricantes</a></li>
                <li><a href="?sistema=prod">Produtos</a></li>
                <li><a href="?sistema=pedlist">Pedidos</a></li>
                <li><a href="?sistema=rel">Relatórios</a></li>
                <li><a href="?sistema=cli">Clientes</a></li>
	    </ul>
    </div>
    <?php } ?>

    <div id="specialoffer">
	    <h1>CELLNET</h1>
	    <h4>Televendas<br />(041)1234-5678</h4>
	    <h4>www.cellnet.com.br</h4>

    </div>

</div>
