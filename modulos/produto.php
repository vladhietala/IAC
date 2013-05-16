<?php
if(!$_SESSION['admin'])
    die("Você não deveria estar aqui.");

if(is_numeric($_GET['excluir']) && $_GET['excluir'] > 0) {
    mysql_query("DELETE FROM produto WHERE prodCodigo = {$_GET['excluir']}");
}

$produto = false;
if(isset($_GET['novo']) || (is_numeric($_GET['alterar']) && $_GET['alterar'] > 0)) {
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if($_GET['alterar']) {
            $sql = "UPDATE produto SET ";
        } else {
            $sql = "INSERT INTO produto ";
        }
        $upd = $cmp = $val = array();
        foreach($_POST AS $campo => $valor) {
            $upd[] = "$campo = '$valor'";
            $cmp[] = $campo;
            $val[] = "'$valor'";
        }
        if($_GET['alterar']) {
            $sql .= implode(", ",$upd)." WHERE ProdCodigo = {$_GET['alterar']}";
        } else {
            $sql .= "(".implode(", ",$cmp).") VALUES (".implode(", ",$val).")";
        }
        mysql_query($sql);
        $id = mysql_insert_id();
        if($_FILES['arquivo']['type'] == 'image/jpeg') {
                if($_GET['alterar']) {
                $id = $_GET['alterar'];
            }
            move_uploaded_file($_FILES['arquivo']['tmp_name'], "produtos/$id.jpg");
        }
        
        header("Location: ?sistema=prod");
    }
    $produto = true;
    if($_GET['alterar']) {
        $produto = mysql_fetch_assoc(mysql_query("SELECT * FROM produto WHERE prodCodigo = {$_GET['alterar']}"));
    }
}

?>
<div id="miolo" class="listprod">
    <div id="titulo">:: Produtos Cadastrados</div>
    <?php if($produto) { ?>
    <form method="post" enctype="multipart/form-data" >
        <p><span>Nome: </span><input type="text" name="ProdNome" value="<?php echo $produto['ProdNome'] ?>" /></p>
        <p><span>Descrição: </span><textarea name="ProdDesc"><?php echo $produto['ProdDesc'] ?></textarea></p>
        <p><span>Fabricante: </span><select name="Categoria_CatCodigo"><option value=""></option>
            <?php
	      $sql = mysql_query ("SELECT * FROM Categoria ORDER BY CatNome");
	      $cont = mysql_num_rows ($sql);
              
	      for($i=0; $i<$cont; $i++)
	      {
		$categoria = mysql_result($sql, $i, 'CatNome');    
		$codigo = mysql_result($sql, $i, 'CatCodigo');
                $selected = '';
                if($codigo == $produto['Categoria_CatCodigo']) {
                    $selected = 'selected="selected"';
                }
                echo "<option value='$codigo' $selected>$categoria</option>"; 
	      }
	    ?>
        </select></p>
        <p><span>Quantidade: </span><input type="text" name="ProdQuantidade" value="<?php echo $produto['ProdQuantidade'] ?>" /></p>
        <p><span>Valor: </span><input type="text" name="ProdValorVenda" value="<?php echo $produto['ProdValorVenda'] ?>" /></p>
        <p><span>Imagem: </span><input type="file" name="arquivo"/> Somente arquivos JPEG</p>
        <?php
        if($_GET['alterar'] && file_exists("produtos/".$_GET['alterar'].".jpg")) {
        ?>
            <p><span>Imagem Cadastrada: </span><img src="produtos/<?php echo $_GET['alterar'].".jpg?".rand() ?>"/></p>
        <?php } ?>
        <p><input type="submit" value="Salvar" class="botao"/></p>
    </form>
    <?php } else { ?>
    <p><a href="?sistema=prod&novo">Novo</a></p>
    <table>
        <tr>
            <td>Alterar</td>
            <td>Excluir</td>
            <td>Nome</td>
            <td>Fabricante</td>
            <td>Quantidade</td>
            <td>Valor</td>
        </tr>
        <?php
        $rs = mysql_query("SELECT * FROM produto INNER JOIN categoria ON Categoria_CatCodigo = CatCodigo ORDER BY ProdNome");
        $count = 0;
        while($produto = mysql_fetch_assoc($rs)) {
            $class = $count&1?"linha_escura":'';
            echo "<tr class='$class'>
                    <td>[ <a href='?sistema=prod&alterar={$produto['ProdCodigo']}'>...</a> ]</td>
                    <td>[ <a href='?sistema=prod&excluir={$produto['ProdCodigo']}'>...</a> ]</td>
                    <td>{$produto['ProdNome']}</td>
                    <td>{$produto['CatNome']}</td>
                    <td>{$produto['ProdQuantidade']}</td>
                    <td>R$ ".number_format($produto['ProdValorVenda'], 2, ',', '.')."</td>
                </tr>";
            $count++;
        }
        ?>
    </table>
    <?php } ?>
</div>

