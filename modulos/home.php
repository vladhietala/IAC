<div id="miolo">
    <?php
    $where = null;
    if(is_numeric($_GET['cat']) && $_GET['cat'] > 0) {
        $where = "WHERE Categoria_CatCodigo = {$_GET['cat']}";
    }
    if(isset($_GET['q']) && @$_GET['q']) {
        $where = "WHERE ProdNome LIKE '%{$_GET['q']}%' OR ProdDesc LIKE '%{$_GET['q']}%' OR CatNome LIKE '%{$_GET['q']}%'";
    }
    $rs = mysql_query ("SELECT * FROM Produto LEFT JOIN categoria ON CatCodigo = Categoria_CatCodigo $where ORDER BY RAND()");
    $count = 0;
    while($produto = mysql_fetch_assoc($rs)) {
        if($count & 1) {
            $class = "_r";
        } else {
            $class = "_l";
        }
        echo "<div id='item_nv1$class'>";
        echo "<div id='item_nv2'>";
        echo "<h2>{$produto['ProdNome']}</h2>";
        echo "<p>{$produto['ProdDesc']}</p>";
        if($produto['ProdQuantidade']==0)
            echo "<span class=\"disp\">Esgotado</span>";
        else
        {
            echo "<span class=\"moeda\">R$ ".number_format($produto['ProdValorVenda'], 2, ',' , '.')."</span>";
            echo "<a href=\"index.php?sistema=car&pid={$produto['ProdCodigo']}&acao=add\" ><img src=\"images/carrinho.gif\" /></a>";
            echo "<br /><span class=\"frete\">";
            frete ($produto['ProdNome']);
            echo "</span>"; 
        }
        echo "</div>";
        echo '<div id="item_nv3">
		<img src="produtos/'.$produto['ProdCodigo'].'.jpg"/>
	    </div>';
        echo "</div>";
        $count++;
    }
    ?>
</div>

