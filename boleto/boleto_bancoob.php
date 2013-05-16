<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Versão Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo está disponível sob a Licença GPL disponível pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Você deve ter recebido uma cópia da GNU Public License junto com     |
// | esse pacote; se não, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colaborações de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de João Prado Maia e Pablo Martins F. Costa                |
// |                                                                      |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordenação Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto BANCOOB/SICOOB: Marcelo de Souza              |
// | Ajuste de algumas rotinas: Anderson Nuernberg                        |
// +----------------------------------------------------------------------+


// ------------------------- DADOS DINÂMICOS DO SEU CLIENTE PARA A GERAÇÃO DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formulário c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE ^ E_DEPRECATED);

      session_start();
      //Dados do Cliente
      if(IsSet($_SESSION["nome"])){$nome_usu = $_SESSION["nome"];}
      if(IsSet($_SESSION["cpf"])){$cpf_usu = $_SESSION["cpf"];}
      if(IsSet($_SESSION["cpf"])){$codigo_usu = $_SESSION["codigo"];}
      if(IsSet($_SESSION["senha"])){$senha_usu = $_SESSION["senha"];}
      if(IsSet($_SESSION["endereco"])){$endereco_usu = $_SESSION["endereco"];}
      if(IsSet($_SESSION["cidade"])){$cidade_usu = $_SESSION["cidade"];}
      if(IsSet($_SESSION["bairro"])){$bairro_usu = $_SESSION["bairro"];}
      if(IsSet($_SESSION["estado"])){$estado_usu = $_SESSION["estado"];}
      if(IsSet($_SESSION["fone"])){$fone_usu = $_SESSION["fone"];}
      if(IsSet($_SESSION["celular"])){$celular_usu = $_SESSION["celular"];}
      if(IsSet($_SESSION["email"])){$email_usu = $_SESSION["email"];}
      if(IsSet($_SESSION["sexo"])){$sexo_usu = $_SESSION["sexo"];}
      if(IsSet($_SESSION["lembrete"])){$lembrete_usu = $_SESSION["lembrete"];}
      if(IsSet($_SESSION["cep"])){$cep_usu = $_SESSION["cep"];}

      include ("../config/conecta.inc");

	  $num_pedido = $_REQUEST['pedido'];
	  $sql =    "SELECT Produto.ProdNome, Pedido.PedFrete, Pedido.PedData, Pedido.PedNum, Produto_ProdCodigo, ValorUnit, Quantidade,";
	 $sql .=   " (Quantidade * ValorUnit) AS Total FROM ItensPedido ";
	 $sql .=   " INNER JOIN Pedido ON ItensPedido.Pedido_PedNum = Pedido.PedNum ";
	 $sql .=   " INNER JOIN Produto ON ItensPedido.Produto_ProdCodigo = Produto.ProdCodigo ";
	 $sql .=   " WHERE Pedido.PedNum = '$num_pedido'";
	 $dados = mysql_query($sql);

	 $cont = mysql_num_rows($dados);
	 $frete = mysql_result($dados, 0, 'PedFrete');
	 $total = 0;
	 for($i=0; $i<$cont; $i++)
	 {

	    $produto   = mysql_result($dados, $i, 'ProdNome');
	    $valorUnit = mysql_result($dados, $i, 'ValorUnit');
	    $subTotal  = mysql_result($dados, $i, 'Total');
	    $qtd       = mysql_result($dados, $i, 'Quantidade');
	    
	    $total += $subTotal;

	  }

$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = 2.95;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = $total; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$vlr_formatado = number_format(($valor_cobrado + $frete), 2, ',' , '.');
$valor_boleto = $vlr_formatado;

$dadosboleto["nosso_numero"] = "08123456";  // Até 8 digitos, sendo os 2 primeiros o ano atual (Ex.: 08 se for 2008)
$dadosboleto["numero_documento"] = "27.030195.10";	// Num do pedido ou do documento
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $nome_usu;
$dadosboleto["endereco1"] = $endereco_usu;
$dadosboleto["endereco2"] = ($cidade_usu . " - " . $bairro_usu . " - CEP: " . $cep_usu);

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "Pagamento de Compra na Loja virtual CELLNET";
$dadosboleto["demonstrativo2"] = "Mensalidade referente ao pedido $num_pedido<br>Taxa bancária - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo3"] = "BoletoPhp - http://www.boletophp.com.br";

// INSTRUÇÕES PARA O CAIXA
$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% após o vencimento";
$dadosboleto["instrucoes2"] = "- Receber até 10 dias após o vencimento";
$dadosboleto["instrucoes3"] = "- Em caso de dúvidas entre em contato conosco: cellnet@cellnet.com.br";
$dadosboleto["instrucoes4"] = "&nbsp; Emitido pelo sistema Projeto BoletoPhp - www.boletophp.com.br";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "N";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "DM";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //
// DADOS ESPECIFICOS DO SICOOB
$dadosboleto["modalidade_cobranca"] = "01";
$dadosboleto["numero_parcela"] = "001";


// DADOS DA SUA CONTA - BANCO SICOOB
$dadosboleto["agencia"] = "9999"; // Num da agencia, sem digito
$dadosboleto["conta"] = "99999"; 	// Num da conta, sem digito

// DADOS PERSONALIZADOS - SICOOB
$dadosboleto["convenio"] = "7777777";  // Num do convênio - REGRA: No máximo 7 dígitos
$dadosboleto["carteira"] = "1";

// SEUS DADOS
$dadosboleto["identificacao"] = "BoletoPhp - Código Aberto de Sistema de Boletos";
$dadosboleto["cpf_cnpj"] = $cpf_usu;
$dadosboleto["endereco"] = "Rua Wesley Wingston, 1904";
$dadosboleto["cidade_uf"] = "Curitiba / PR";
$dadosboleto["cedente"] = "CellNet Com. de Telefonia Celular LTDA.";

// NÃO ALTERAR!
include("include/funcoes_bancoob.php");
include("include/layout_bancoob.php");
?>
