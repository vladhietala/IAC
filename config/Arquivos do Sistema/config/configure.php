<?php

      ob_start();

      //reporta erros
    //  ini_set('display_errors', true);
     // error_reporting(E_ALL);

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

      //Dados do Carrinho


    function frete ($vlr)
    {
      if($vlr > 1000.00)
	echo "Frete Gratis!";   
      else
	echo "&nbsp;";
    }



    $sistema = $_REQUEST ["sistema"];
    $etapa = $_REQUEST ["etapa"];
    
  
   switch ($sistema)
    {
      case "cad":
	if($etapa==1 OR empty($etapa)) 
	  $miolo = "modulos/cadastro.php";
	else if ($etapa==2)
	  $miolo = "modulos/cadastro_banco.php"; 
	else if ($etapa==4)
	  $miolo = "modulos/cadastro_alter.php";
	else if ($etapa==5)
	  $miolo = "modulos/senha_alter.php";
	else
	  $miolo = "modulos/cadastro_fim.php"; 
	break;
      case "con":
	if($etapa==1 OR empty($etapa)) 
	  $miolo = "modulos/contato.inc"; 
	else
	  $miolo = "modulos/contato_fim.inc"; 
	break;
      case "ana":
	$miolo = "modulos/anatomia.inc"; 
	break;
      case "cat":
	$miolo = "modulos/resultados.php"; 
	break;
      case "log":
	$miolo = "includes/log_valida.php"; 
	break;
      case "prod":
	$miolo = "modulos/produto.php"; 
	break;
      case "car":
	$miolo = "modulos/carrinho.php"; 
	break;
      case "com":
	$miolo = "modulos/comprar.php"; 
	break;
      case "ped":
	$acao = $_REQUEST['acao'];
	if($acao=="boleto")
	{
	    $pedido = $_REQUEST['pedido'];
	    header ("Location: boleto/boleto_bancoob.php?pedido=$pedido"); 
	}
	else if($acao=="detalhes")
	    $miolo = "modulos/pedido_detalhe.php"; 
	else if($acao=="status")
	    $miolo = "modulos/pedido_status.php"; 
	else
	    $miolo = "modulos/pedidos.php";
	break;
      default:
	$miolo = "modulos/home.php";
	break;
    }

  


?>