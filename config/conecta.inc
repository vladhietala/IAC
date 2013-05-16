<?php

if(!($conexao = mysql_connect("localhost","root", "")))  
{
   header ("Location:erro.html");
   exit;
} 
else
{
  mysql_select_db ("lojavirtual");
}

?>
