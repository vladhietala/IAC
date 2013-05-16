<div id="miolo">
    
   <div id="titulo">:: CADASTRO</div>

	<form  method="post" name="forcad" action="index.php?sistema=cad&etapa=2" onsubmit="return validaPass (this)">


	    <span>Nova senha:</span><br />
	    <input name="senha" type="password" size="20" maxlength=8 />
	    <br /><br />

	    <span>Repita a senha:</span><br />
	    <input name="senha2" type="password" size="20" maxlength=8 />
	    <br /><br />

	  


	  <input name="tipo" type="hidden" value="alterpass"/>

	<input name="next" type="submit" class="botao" value="Salvar">
      </form>


</div>