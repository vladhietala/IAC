<div id="miolo">

    <div id="titulo">:: LOGIN</div>
      <?php 

	$login = $_REQUEST['login'];
	$senha = md5 ($_REQUEST['senha']);
        
	$sql = mysql_query ($s = "SELECT * FROM Cliente WHERE CliNome='$login' AND CliSenha='$senha'");
        $retorno = mysql_num_rows ($sql);

	if ($retorno==0)
	{
	  echo "<p><img src=\"images/atencao.jpg\" /></p>";  
	  echo "<p><b>Nome ou Senha n&atilde;o  confere! Tente novamente.</b></p>";
	}
	else 
	{
            $dados = mysql_fetch_assoc($sql);
	  session_start();
	  $_SESSION['nome'] = $dados['CliNome'];
	  $_SESSION['codigo'] = $dados['CliCodigo'];
	  $_SESSION['senha'] = $senha;
	  $_SESSION['cpf'] = $dados['CliCPF'];
	  $_SESSION['endereco'] = $dados['CliEndereco'];
	  $_SESSION['bairro'] = $dados['CliBairro'];
	  $_SESSION['sexo'] = $dados['Sexo_Sexo'];
	  $_SESSION['estado'] = $dados['Estado_EstCodigo'];
	  $_SESSION['cidade'] = $dados['CliCidade'];
	  $_SESSION['lembrete'] = $dados['CliLembrete'];
	  $_SESSION['email'] = $dados['CliEmail'];
	  $_SESSION['fone'] = $dados['CliFoneRes'];
	  $_SESSION['celular'] = $dados['CliFoneCel'];
	  $_SESSION['cep'] = $dados['CliCEP'];
          $_SESSION['admin'] = $dados['CliAdmin'];
          while(ob_get_level()) ob_end_clean();
	  header ("Location: index.php");
	 }
      ?>
</div>