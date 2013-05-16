<div id="miolo">

    <div id="titulo">:: CADASTRO</div>
  
	<form  class="cad" method="post" name="forcad" action="?sistema=cad&etapa=2" onsubmit="return validaCad (this)">
	  <span>CPF:</span><br />
	  <input name="cpf" type="text" size="20" maxlength=14  onKeyPress="return Mascara(this,event,'###.###.###-##');"/>
	  <br /><br />

	  <div id="campos">
	      <span>Nome Completo: (este ser&aacute; seu login)</span><br />
	      <input name="nome" type="text" size="60"/>
	      <br /><br />
	  </div>


	  <div id="campos">
	  <span>Sexo:</span><br />
	      <select name="sexo" >
		<option value="M">M</option>
		<option value="F">F</option>
	      </select><br /><br />
	  </div><br clear="all" />

	  <div id="campos">
	      <span>Endereco:</span><br />
	      <input name="endereco" type="text" size="56"/>
	      <br /><br />
	  </div>

	  <div id="campos">
	      <span>CEP:</span><br />
	      <input name="cep" type="text" size="10" maxlength=9  onKeyPress="return Mascara(this,event,'#####-###');"/>
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
		    if($uf=="PR")
		      echo "selected";
		    echo ">$estado</option>";
		  }
		?>
	      </select><br /><br />
	  </div>

	  <div id="campos">
	      <span>Cidade:</span><br />
	      <input name="cidade" type="text" size="19"/>
	  </div>

	  <div id="campos">
	      <span>Bairro:</span><br />
	      <input name="bairro" type="text" size="19"/>
	  </div><br clear="all" />

	  <div id="campos">
	      <span>Telefone Residencial:</span><br />
	      <input name="fone" type="text" size="33" maxlength=12 onKeyPress="return Mascara(this,event,'(##)####-####');"/>
	      <br /><br />
	  </div>

	  <div id="campos">
	      <span>Telefone Celular:</span><br />
	      <input name="celular" type="text" size="33" maxlength=12 onKeyPress="return Mascara(this,event,'(##)####-####');"/>
	  </div><br clear="all" />

	  <span>E-mail:</span><br />
	  <input name="email" type="text" size="71"/>
	  <br/><br/>

	  <div id="campos">
	    <span>Senha:</span><br />
	    <input name="senha" type="password" size="20" maxlength=8 />
	    <br /><br />
	  </div>

	  <div id="campos">
	    <span>Confirmar Senha:</span><br />
	    <input name="senha2" type="password" size="20" maxlength=8 />
	    <br /><br />
	  </div><br clear="all" />

	<p><input name="next" type="submit" class="botao" value="Salvar"></p>
 
	</form>

</div>