<div id="miolo">

    <div id="titulo">:: CADASTRO</div>

	<form  class="cad" method="post" name="forcad" action="index.php?sistema=cad&etapa=2" onsubmit="return validaCad (this)">
	  <span>CPF (n&atilde;o pode ser alterado):</span><br />
	  <input name="cpf" type="text" size="20" maxlength=11 disabled value="<?php echo $cpf_usu ?>"/>
	  <br /><br />

	  <div id="campos">
	      <span>Nome Completo:</span><br />
	      <input name="nome" type="text" size="60" value="<?php echo $nome_usu ?>"/>
	      <br /><br />
	  </div>


	  <div id="campos">
	  <span>Sexo:</span><br />
	      <select name="sexo" >
		<option value="M" <?php if ($sexo_usu=="M") echo " selected" ?> >M</option>
		<option value="F" <?php if ($sexo_usu=="F") echo " selected" ?> >F</option>
	      </select><br /><br />
	  </div><br clear="all" />

	  <div id="campos">
	      <span>Endereco:</span><br />
	      <input name="endereco" type="text" size="56" value="<?php echo $endereco_usu ?>"/>
	      <br /><br />
	  </div>

	  <div id="campos">
	      <span>CEP:</span><br />
	      <input name="cep" type="text" size="10" maxlength=9  onKeyPress="return Mascara(this,event,'#####-###');" value="<?php echo $cep_usu ?>"/>
	      <br /><br />
	  </div><br clear="all" />
	  
	  <div id="campos">
	  <span>Estado:</span><br />
	      <select name="estado" >
		<?php
		  
		  $sql = mysql_query ("SELECT * FROM Estado ORDER BY EstNome");
		  $cont = mysql_num_rows($sql);
		  for ($i=0; $i<$cont; $i++)
		  {
		    $estado = mysql_result ($sql, $i, 'EstNome');
		    $uf = mysql_result ($sql, $i, 'EstCodigo');
		    echo "<option value=\"$uf\" ";
		    if($uf==$estado_usu)
		      echo "selected";
		    echo ">$estado</option>";
		  }
		?>
	      </select><br /><br />
	  </div>

	  <div id="campos">
	      <span>Cidade:</span><br />
	      <input name="cidade" type="text" size="19" value="<?php echo $cidade_usu ?>"/>
	  </div>

	  <div id="campos">
	      <span>Bairro:</span><br />
	      <input name="bairro" type="text" size="19" value="<?php echo $bairro_usu ?>"/>
	  </div><br clear="all" />

	  <div id="campos">
	      <span>Telefone Residencial:</span><br />
	      <input name="fone" type="text" size="33" maxlength=13 onKeyPress="return Mascara(this,event,'(##)####-####');" value="<?php echo $fone_usu ?>"/>
	      <br /><br />
	  </div>

	  <div id="campos">
	      <span>Telefone Celular:</span><br />
	      <input name="celular" type="text" size="33" maxlength=13 onKeyPress="return Mascara(this,event,'(##)####-####');" value="<?php echo $celular_usu ?>"/>
	  </div><br clear="all" />

	  <span>E-mail:</span><br />
	  <input name="email" type="text" size="71" value="<?php echo $email_usu ?>"/>
	  <br/><br/>

	  <input name="tipo" type="hidden" value="altercad"/>


	  <a href="index.php?sistema=cad&etapa=5">:: Alterar senha?</a>

	<p><input name="next" type="submit" class="botao" value="Salvar"></p>
 
	</form>

</div>