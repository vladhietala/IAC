<?php
if(!$_SESSION['admin'])
    die("Você não deveria estar aqui.");

$msg = null;
if(is_numeric($_GET['excluir']) && $_GET['excluir'] > 0) {
    $rs = mysql_query("SELECT 1 FROM produto WHERE Categoria_CatCodigo = {$_GET['excluir']}");
    if(mysql_num_rows($rs) == 0) {
        mysql_query("DELETE FROM categoria WHERE CatCodigo = {$_GET['excluir']}");
    } else {
        $msg = 'Impossível excluir fabricante. Remova os produtos primeiro.';
    }
}

$categoria = false;
if((is_numeric($_GET['alterar']) && $_GET['alterar'] > 0) || isset($_GET['novo'])) {
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if($_GET['alterar']) {
            $sql = "UPDATE categoria SET ";
        } else {
            $sql = "INSERT INTO categoria ";
        }
        $upd = $cmp = $val = array();
        foreach($_POST AS $campo => $valor) {
            $upd[] = "$campo = '$valor'";
            $cmp[] = $campo;
            $val[] = "'$valor'";
        }
        if($_GET['alterar']) {
            $sql .= implode(", ",$upd)." WHERE CatCodigo = {$_GET['alterar']}";
        } else {
            $sql .= "(".implode(", ",$cmp).") VALUES (".implode(", ",$val).")";
        }
        
        mysql_query($sql);
        //die($sql);
        while(ob_get_level()) ob_end_clean ();
        header("Location: ?sistema=fab");
        die();
    }
    $categoria = true;
    if($_GET['alterar']) {
        $categoria = mysql_fetch_assoc(mysql_query("SELECT * FROM categoria WHERE CatCodigo = {$_GET['alterar']}"));
    } else {
        $categoria = array('CatNome' => '');
    }
}

if($msg) {
?>
<script>
    alert('<?php echo $msg ?>');
</script>
<?php
}
?>

<div id="miolo" class="listprod">
    <div id="titulo">:: Fabricantes Cadastrados</div>
    <?php if($categoria) { ?>
    <form method="post">
        <?php
            unset($categoria['CatCodigo']);
            foreach($categoria as $nome => $valor) {
                $nomee = str_replace('Cat', '', $nome);
                echo "<p><span>$nomee: </span><input type='text' name='$nome' value='$valor'/></p>";
            }
        ?>
        <p><input type="submit" value="Salvar" class="botao"/></p>
    </form>
    <?php } else { ?>
    <p>[ <a href="?sistema=fab&novo">Novo</a> ]</p>
    <table>
        <?php
        $rs = mysql_query("SELECT * FROM categoria ORDER BY CatCodigo");
        $count = 0;
        while($categoria = mysql_fetch_assoc($rs)) {
            if($count == 0) {
                $titulo = array_keys($categoria);
                echo "<TR><TD>Alterar</TD><TD>Excluir</TD><TD>".implode("</TD><TD>",$titulo)."</TD></TR>";
            }
            $class = $count&1?"linha_escura":'';
            echo "<TR class='$class'><TD>[ <a href='?sistema=fab&alterar={$categoria['CatCodigo']}'>...</a> ]</TD><TD>[ <a href='?sistema=fab&excluir={$categoria['CatCodigo']}'>...</a> ]</TD><TD>".implode("</TD><TD>",$categoria)."</TD></TR>";
            $count++;
        }
        ?>
    </table>
    <?php } ?>
</div>

