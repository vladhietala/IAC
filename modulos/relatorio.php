<div id="miolo" class="listprod">
    <div id="titulo">:: RELATÓRIOS</div>
    <div id="resultado">
        <form method="post" action="" class="cad" >
            <?php
            if($_POST['tipo'] == 1) {
                $checked1 = "checked='checked'";
            } elseif($_POST['tipo'] == 2) {
                $checked2 = "checked='checked'";
            } elseif($_POST['tipo'] == 3) {
                $checked3 = "checked='checked'";
            } else {
                $checked1 = "checked='checked'";
            }
            ?>
            <input type="radio" value="1" name="tipo" <?php echo $checked1 ?>/><label>Relatório de vendas</label><br /><br />
            <input type="radio" value="2" name="tipo" <?php echo $checked2 ?>/><label>Relatório por Fabricante</label><br /><br />
            <input type="radio" value="3" name="tipo" <?php echo $checked3 ?>/><label>Relatório Fidelidade Clientes</label><br /><br />
            <label>Fabricante: </label><select name="fabricante"><option value=""></option>
            <?php
	      $sql = mysql_query ("SELECT * FROM Categoria ORDER BY CatNome");
	      $cont = mysql_num_rows ($sql);
              
	      for($i=0; $i<$cont; $i++)
	      {
		$categoria = mysql_result($sql, $i, 'CatNome');    
		$codigo = mysql_result($sql, $i, 'CatCodigo');
                $selected = '';
                if($codigo == $_POST['fabricante']) {
                    $selected = 'selected="selected"';
                }
                echo "<option value='$codigo' $selected>$categoria</option>"; 
	      }
	    ?>
            </select><br /><br />
            <label>Data Início: </label><input type="text" name="data_ini" value="<?php echo $_POST['data_ini'] ?>" onKeyPress="return Mascara(this,event,'##/##/####');"><br /><br />
            <label>Data Fim: </label><input type="text" name="data_fim" value="<?php echo $_POST['data_fim'] ?>" onKeyPress="return Mascara(this,event,'##/##/####');"><br /><br />
            <br /><input name="next" type="submit" class="botao" value="Enviar">
         </form>
     </div>
    <div>
    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $where = array();
            if($_POST['fabricante']) {
                $where[] = "Categoria_CatCodigo = '{$_POST['fabricante']}'";
            }
            if($_POST['data_ini']) {
                $data_ini = implode("-",array_reverse(explode("/",$_POST['data_ini'])));
                $where[] = "DATE(PedData) >= '{$data_ini}'";
            }
            if($_POST['data_fim']) {
                $data_fim = implode("-",array_reverse(explode("/",$_POST['data_fim'])));
                $where[] = "DATE(PedData) <= '{$data_fim}'";
            }
            if($_POST['tipo'] == 1) {
                $sql = "SELECT
                            PedNum,
                            CliNome,
                            DATE_FORMAT(PedData,'%d/%m/%Y') AS data,
                            SUM(itenspedido.Quantidade * itenspedido.ValorUnit) AS valor
                        FROM pedido
                            INNER JOIN itenspedido ON Pedido_PedNum = PedNum
                            INNER JOIN cliente ON Cliente_CliCodigo = CliCodigo
                            INNER JOIN produto ON Produto_ProdCodigo = ProdCodigo
                        ".(sizeof($where) > 0?" WHERE ".implode(" AND ",$where):'')."GROUP BY PedNum HAVING PedNum > 0 ORDER BY 1";
                $rs = mysql_query($sql);
                if(mysql_num_rows($rs) > 0) {
                    ?>
            <table style="width: 100%; margin-top: 30px;">
                <tr>
                    <td style="width: 30%">Pedido</td>
                    <td style="width: 30%">Cliente</td>
                    <td style="width: 30%">Data</td>
                    <td style="width: 30%">Valor</td>
                </tr>
                <?php
                    $class='linha_escura';
                    while($item = mysql_fetch_assoc($rs)) {
                        $class = $class=='linha_escura'?'':'linha_escura';
                        echo "<tr class='$class'>
                                <td>{$item['PedNum']}</td>
                                <td>{$item['CliNome']}</td>
                                <td>{$item['data']}</td>
                                <td>R$ ".number_format($item['valor'],2,',','.')."</td>
                            </tr>";
                    }
                ?>
            </table>
                <?php
                } else {
                    echo "<p>Nenhum registro encontrado.</p>";
                }
            } elseif($_POST['tipo'] == 3) {
                $sql = "SELECT
                            CliNome,
                            SUM(itenspedido.Quantidade * itenspedido.ValorUnit) AS valor
                        FROM pedido
                            INNER JOIN itenspedido ON Pedido_PedNum = PedNum
                            INNER JOIN cliente ON Cliente_CliCodigo = CliCodigo
                            INNER JOIN produto ON Produto_ProdCodigo = ProdCodigo
                            ".(sizeof($where) > 0?" WHERE ".implode(" AND ",$where):'')."
                       GROUP BY CliNome
                       ORDER BY valor DESC";
                $rs = mysql_query($sql);
                if(mysql_num_rows($rs) > 0) {
                    ?>
            <table style="width: 100%; margin-top: 30px;">
                <tr>
                    <td style="width: 70%">Cliente</td>
                    <td style="width: 30%">Valor</td>
                </tr>
                <?php
                    $total = 0.00;
                    $class='linha_escura';
                    while($item = mysql_fetch_assoc($rs)) {
                        $class = $class=='linha_escura'?'':'linha_escura';
                        echo "<tr class='$class'>
                                <td>{$item['CliNome']}</td>
                                <td>R$ ".number_format($item['valor'],2,',','.')."</td>
                            </tr>";
                        $total += $item['valor'];
                    }
                    if($total > 0.00) {
                        echo "<tr style='background-color: #DDDDDD; font-weight: bold;'>
                                <td>Total</td>
                                <td>R$ ".number_format($total,2,',','.')."</td>
                            </tr>";
                    }
                ?>
            </table>
                <?php
                } else {
                    echo "<p>Nenhum registro encontrado.</p>";
                }
            } else {
                $sql = "SELECT
                            CatNome,
                            SUM(itenspedido.Quantidade * itenspedido.ValorUnit) AS valor
                        FROM pedido
                            INNER JOIN itenspedido ON Pedido_PedNum = PedNum
                            INNER JOIN produto ON Produto_ProdCodigo = ProdCodigo
                            INNER JOIN categoria ON Categoria_CatCodigo = CatCodigo
                            
                        ".(sizeof($where) > 0?" WHERE ".implode(" AND ",$where):'')."
                       GROUP BY CatNome
                       ORDER BY valor DESC";
                $rs = mysql_query($sql);
                if(mysql_num_rows($rs) > 0) {
                    ?>
            <table style="width: 100%; margin-top: 30px;">
                <tr>
                    <td style="width: 30%">Fabricante</td>
                    <td style="width: 30%">Valor</td>
                </tr>
                <?php
                    $class='linha_escura';
                    while($item = mysql_fetch_assoc($rs)) {
                        $class = $class=='linha_escura'?'':'linha_escura';
                        echo "<tr class='$class'>
                                <td>{$item['CatNome']}</td>
                                <td>R$ ".number_format($item['valor'],2,',','.')."</td>
                            </tr>";
                    }
                ?>
            </table>
                <?php
                } else {
                    echo "<p>Nenhum registro encontrado.</p>";
                }
            }
        }
      ?>
    </div>
</div>