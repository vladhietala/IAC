<?php
if(!$_SESSION['admin'])
    die("Você não deveria estar aqui.");

if(is_numeric($_GET['excluir']) && $_GET['excluir'] > 0) {
    $rs = mysql_query("SELECT PedNum FROM pedido WHERE Cliente_CliCodigo = {$_GET['excluir']}");
    while($ped = mysql_fetch_assoc($rs)) {
        mysql_query("DELETE FROM itenspedido WHERE Pedido_PedNum = {$ped['PedNum']}");
        mysql_query("DELETE FROM pedido WHERE PedNum = {$ped['PedNum']}");
    }
    mysql_query("DELETE FROM cliente WHERE CliCodigo = {$_GET['excluir']}");
}

$cliente = false;
if(is_numeric($_GET['alterar']) && $_GET['alterar'] > 0) {
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if($_GET['alterar']) {
            $sql = "UPDATE cliente SET ";
        } else {
            $sql = "INSERT INTO cliente ";
        }
        $upd = $cmp = $val = array();
        foreach($_POST AS $campo => $valor) {
            $upd[] = "$campo = '$valor'";
            $cmp[] = $campo;
            $val[] = "'$valor'";
        }
        if($_GET['alterar']) {
            $sql .= implode(", ",$upd)." WHERE CliCodigo = {$_GET['alterar']}";
        } else {
            $sql .= "(".implode(", ",$cmp).") VALUES (".implode(", ",$val).")";
        }
        
        mysql_query($sql);
        //die($sql);
        while(ob_get_level()) ob_end_clean ();
        header("Location: ?sistema=cli");
        die();
    }
    $cliente = true;
    if($_GET['alterar']) {
        $cliente = mysql_fetch_assoc(mysql_query("SELECT * FROM cliente WHERE CliCodigo = {$_GET['alterar']}"));
    }
}

?>
<div id="miolo" class="listprod">
    <div id="titulo">:: Clientes Cadastrados</div>
    <?php if($cliente) { ?>
    <form method="post">
        <?php
            unset($cliente['CliSenha'],$cliente['CliLembrete'],$cliente['CliAdmin']);
            foreach($cliente as $nome => $valor) {
                $nomee = str_replace('Cli', '', $nome);
                echo "<p><span>$nomee: </span><input type='text' name='$nome' value='$valor'/></p>";
            }
        ?>
        <p><input type="submit" value="Salvar" class="botao"/></p>
    </form>
    <?php } else { ?>
    <table>
        <?php
        $rs = mysql_query("SELECT * FROM cliente ORDER BY CliCodigo");
        $count = 0;
        while($cliente = mysql_fetch_assoc($rs)) {
            unset($cliente['CliSenha'],$cliente['CliLembrete'],$cliente['CliAdmin']);
            if($count == 0) {
                $titulo = array_keys($cliente);
                echo "<TR><TD>Alterar</TD><TD>Excluir</TD><TD>".implode("</TD><TD>",$titulo)."</TD></TR>";
            }
            $class = $count&1?"linha_escura":'';
            echo "<TR class='$class'><TD>[ <a href='?sistema=cli&alterar={$cliente['CliCodigo']}'>...</a> ]</TD><TD>[ <a href='?sistema=cli&excluir={$cliente['CliCodigo']}'>...</a> ]</TD><TD>".implode("</TD><TD>",$cliente)."</TD></TR>";
            $count++;
        }
        ?>
    </table>
    <?php } ?>
</div>

