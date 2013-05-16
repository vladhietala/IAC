<?php

  if(empty($senha_usu))
  {
      $cpf = $_REQUEST ["cpf"];
      $nome =   $_REQUEST ["nome"];
      $email =   $_REQUEST ["email"];
      $endereco =  $_REQUEST ["endereco"];
      $cep = $_REQUEST ["cep"];
      $sexo = $_REQUEST ["sexo"];
      $cidade = $_REQUEST ["cidade"];
      $estado = $_REQUEST ["estado"];
      $bairro = $_REQUEST ["bairro"];
      $fone =  $_REQUEST ["fone"];
      $celular = $_REQUEST ["celular"];
      $senha = md5 ( $_REQUEST ["senha"]);
      $lembrete =  $_REQUEST ["lembrete"];


      $sql = "INSERT INTO Cliente (CliNome, CliEmail, CliEndereco,CliCidade, Estado_EstCodigo, CliBairro, CliFoneRes, CliFoneCel, Sexo_Sexo, CliCPF, CliSenha, CliLembrete, CliCEP)";
      $sql .= "VALUES ('$nome', '$email', '$endereco', '$cidade', '$estado', '$bairro', '$fone', '$celular', '$sexo', '$cpf', '$senha', '$lembrete', '$cep')";
      mysql_query ($sql);

      if (!mysql_affected_rows())
	  echo "<br /><br /><br /><h3 align=\"center\">Ocorreu um erro ao tentar inserir seus dados no Banco de Dados. Por favor tente novamente mais tarde.</h3>";
      else
	header ("Location:index.php?sistema=cad&etapa=3"); 
  }
  else if ($_REQUEST["tipo"]=="altercad")
  {
      $nome =   $_REQUEST ["nome"];
      $email =   $_REQUEST ["email"];
      $endereco =  $_REQUEST ["endereco"];
      $cep =  $_REQUEST ["cep"];
      $sexo = $_REQUEST ["sexo"];
      $cidade = $_REQUEST ["cidade"];
      $estado = $_REQUEST ["estado"];
      $bairro = $_REQUEST ["bairro"];
      $fone =  $_REQUEST ["fone"];
      $celular = $_REQUEST ["celular"];


      $sql = "UPDATE Cliente SET CliNome='$nome', CliEmail='$email', CliEndereco='$endereco', CliCidade='$cidade', Estado_EstCodigo='$estado',";
      $sql .= "CliBairro='$bairro', CliFoneRes='$fone', CliFoneCel='$celular', Sexo_Sexo='$sexo', CliCEP='$cep' WHERE CliCPF='$cpf_usu'";
      mysql_query ($sql);

      if (!mysql_affected_rows())
	  echo "<br /><br /><br /><h3 align=\"center\">Ocorreu um erro ao tentar alterar seus dados no Banco de Dados. Por favor tente novamente mais tarde.</h3>";
      else
	header ("Location:index.php?sistema=cad&etapa=3"); 
   }
   else
  {
      $lembrete =   $_REQUEST ["lembrete"];
      $senha = md5( $_REQUEST ["senha"]);
      
      $sql = mysql_query ("UPDATE Cliente SET CliSenha='$senha', CliLembrete='$lembrete' WHERE CliCPF='$cpf_usu'");
      
      if (!mysql_affected_rows())
	  echo "<br /><br /><br /><h3 align=\"center\">Ocorreu um erro ao tentar alterar seus dados no Banco de Dados. Por favor tente novamente mais tarde.</h3>";
      else
	header ("Location:index.php?sistema=cad&etapa=3"); 
  }


?>