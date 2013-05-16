<?php
ob_start();
session_start();
if(!($conexao = mysql_connect("localhost","root", "admin")))  
{
   header ("Location:erro.html");
   exit;
} 
else
{
  mysql_select_db ("LojaVirtual");
}

$sql = "select ProdCodigo,ProdNome from Produto";
$query = mysql_query($sql);
?>
<form action="carrinho_adicionar_itens.php" method="post">
    <ul>
        <?php while($linha = mysql_fetch_array($query)){ ?>
            <li>
                <?php if (empty($_SESSION['carrinho'])) { ?>
                 <input name="id_produto[]" type="checkbox" value="<?php echo $linha['ProdCodigo'] ?>"> <?php echo $linha['ProdNome'] ?>
                <?php } else { ?>
                 <?php if (in_array($linha['ProdCodigo'],$_SESSION['carrinho'])) { ?>
                     <input name="id_produto[]" type="checkbox" value="<?php echo $linha['ProdCodigo'] ?>" checked> <?php echo $linha['ProdNome'] ?> (<a href="carrinho_excluir_itens.php?id=<?php echo $linha['ProdCodigo'] ?>">retirar</a>)
                     <?php } else { ?>
                      <input name="id_produto[]" type="checkbox" value="<?php echo $linha['ProdCodigo'] ?>"> <?php echo $linha['ProdNome'] ?>
                     <?php } ?>

                <?php } ?>
            </li>
        <?php } ?>
    </ul>

    <br />

    <input type="submit" value="Adicionar item(s)" />
</form>
<!--  Diálogos com o usuário -->
<?php
if (isset($_GET['mensagem'])) {
 echo "<script>alert('".$_GET['mensagem']."');</script>";
}

?>