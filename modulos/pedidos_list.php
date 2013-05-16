<?php
if(!$_SESSION['admin'])
    die("Você não deveria estar aqui.");

if(is_numeric($_GET['aprovar']) && $_GET['aprovar'] > 0) {
    mysql_query("UPDATE pedido SET PedStatus = 'P' WHERE pedNum = {$_GET['aprovar']}");
}
if(is_numeric($_GET['entregar']) && $_GET['entregar'] > 0) {
    mysql_query("UPDATE pedido SET PedStatus = 'E' WHERE pedNum = {$_GET['entregar']}");
}
?>
<div id="miolo" class="listprod">
    <div id="titulo">:: Pedidos Cadastrados</div>
    <table>
        <tr>
            <td>Cod Pedido</td>
            <td>Status</td>
            <td>Cliente</td>
            <td>Valor</td>
        </tr>
        <?php
        $rs = mysql_query("SELECT PedNum, PedStatus, CliNome, SUM(Quantidade * ValorUnit) AS total
                FROM pedido
                    INNER JOIN itenspedido ON PedNum = Pedido_PedNum
                    INNER JOIN cliente on CliCodigo = Cliente_CliCodigo
                GROUP BY PedNum, PedStatus, CliNome
                ORDER BY PedNum");
        $count = 0;
        while($produto = mysql_fetch_assoc($rs)) {
            $class = $count&1?"linha_escura":'';
            if($produto['PedStatus'] == 'A') {
                $status = "Aberto [ <a href='?sistema=pedlist&aprovar={$produto['PedNum']}'>Registrar Pgto</a> ]";
            } elseif($produto['PedStatus'] == 'P') {
                $status = "Pago [ <a href='?sistema=pedlist&entregar={$produto['PedNum']}'>Registrar Entrega</a> ]";
            } elseif($produto['PedStatus'] == 'E') {
                $status = "Entregue";
            }
            echo "<tr class='$class'>
                    <td>{$produto['PedNum']}</td>
                    <td>$status</td>
                    <td>{$produto['CliNome']}</td>
                    <td>R$ ".number_format($produto['total'], 2, ',', '.')."</td>
                </tr>";
            $count++;
        }
        ?>
    </table>
</div>

