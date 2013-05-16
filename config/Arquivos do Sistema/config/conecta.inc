<?php

if(!($conexao = mysql_connect("localhost","root", "admin")))  
{
   header ("Location:erro.html");
   exit;
} 
else
{
  mysql_select_db ("LojaVirtual");
}

?>
