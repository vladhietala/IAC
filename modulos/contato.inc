<div id="miolo">

    <div id="titulo">:: CONTATO</div>

	<form  method="post" name="forcad" action="index.php?sistema=con&etapa=2" onsubmit="return validaCon (this)">

	  <img src="images/fone.jpg" />
	  <h2>Televendas (041)1234-5678</h2><br /><br />


	  <img src="images/email.jpg" /><br /><br />


	<span>Nome Completo:</span><br />
	<input name="nome" type="text" size="65"/>
	<br /><br />

  
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
	      <input name="cidade" type="text" size="37"/>
	  </div><br clear="all" />

	  <div id="campos">
	      <span>Telefone para contato:</span><br />
	      <input name="fone" type="text" size="20"/>
	      <br /><br />
	  </div>

	  <div id="campos">
	    <span>E-mail:</span><br />
	    <input name="email" type="text" size="40"/>
	    <br/><br/>
	  </div><br clear="all" />

	  <span>Assunto:</span><br />
	      <select name="assunto" >
		<option>D&uacute;vida</option>
		<option>Sugest&atilde;o</option>
		<option>Reclama&ccedil;&atilde;o </option>
	      </select><br /><br />

	    <span>Mensagem:</span><br />
	    <textarea name="msg" rows="6" cols="55"></textarea>
	    <br /><br />

	<p><input name="next" type="submit" class="botao" value="ENVIAR"><br /><br /><br />
 
	</form>

</div>