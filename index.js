function validaCad(nomeform)
{
    if (nomeform.cpf.value=="")
    {
      alert ("Por favor digite seu CPF."); return false;
      
    }
    else if (nomeform.cpf.value.length<11)
    {
      alert ("CPF deve conter 11 digitos. ");return false;
      
    }
    else if (nomeform.nome.value=="") 
    {
      alert ("Por Favor digite seu nome."); return false; 
      
    }
    else if (nomeform.nome.value.length<3) 
    {
      alert ("Por Favor digite um nome valido."); return false; 
      
    }
    else if (nomeform.endereco.value=="") 
    {
      alert ("Por Favor digite um endereco valido."); return false; 
      
    }
    else if (nomeform.cidade.value=="") 
    {
      alert ("Por Favor digite sua cidade."); return false; 
      
    }
    else if (nomeform.bairro.value=="") 
    {
      alert ("Por Favor digite seu bairro."); return false; 
      
    }
    else if (nomeform.fone.value=="") 
    {
      alert ("Por Favor digite seu telefone residencial."); return false; 
      
    }
      
    else if (nomeform.fone.value.length<10)
    {
      alert ("Telefone residencial deve ter 10 digitos, incluindo DDD. Exemplo: 4112345678");return false;
      
    }
    else if (nomeform.celular.value!="") 
    {
	if  (nomeform.celular.value.length<10)
	{
	  alert ("Telefone celular deve ter 10 digitos, incluindo DDD. Exemplo: 4198765431");return false;
	  
	}   
      
    }
    else if (nomeform.email.value=="")
    {
      alert ("Por Favor digite seu email."); return false; 
      
    }
    else if (nomeform.email.value.indexOf('#', 0) != -1 || nomeform.email.value.indexOf(',', 0) != -1 || nomeform.email.value.indexOf(';', 0) != -1 || nomeform.email.value.indexOf(' ', 0) != -1 || nomeform.email.value.indexOf('@.', 0) != -1 || nomeform.email.value.indexOf('.@', 0) != -1 || nomeform.email.value.indexOf('%', 0) != -1)
    {
      alert ("Email invalido! Alguns caracteres nao sao validos para endereco de email. Verifique se digitou corretamente.");return false;
      
    }
    else if (nomeform.senha.value=="")
    {
      alert ("Por favor digite uma senha."); return false;
      
    }
    else if (nomeform.senha.value.length<4)
    {
      alert ("Senha deve conter no maximo 8 digitos e no minimo 4. ");return false;
      
    }
   
}


function validaCon(nomeform)
{
    if (nomeform.nome.value==""){alert ("Por favor digite seu Nome."); return false; }
    if (nomeform.cidade.value==""){alert ("Por favor digite o nome da cidade onde mora."); return false; }
    if (nomeform.fone.value==""){alert ("Por favor digite seu telefone."); return false; }
    if (nomeform.email.value==""){alert ("Por favor digite seu email."); return false; }
    if (nomeform.msg.value==""){alert ("Por favor digite sua mensagem."); return false; }
    
}

function validaPass(nomeform)
{
   if (nomeform.senha.value==""){alert ("Por favor digite uma senha."); return false;}
   if (nomeform.senha.value.length<4){alert ("Senha deve conter no minimo 4 digitos. ");return false;}
   if (nomeform.senha.value.length>8){alert ("Senha deve conter no maximo 8 digitos. ");return false;}
   if (nomeform.senha.value != nomeform.senha2.value){alert ("Senhas nao conferem.");return false;}
   if (nomeform.lembrete.value==""){alert ("Por favor digite o lembrete.");	return false; }
}


