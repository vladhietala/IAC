<div id="miolo">

    <div id="titulo">:: CADASTRO</div>

    <div class="meio">
	<?php 
	    if(empty($senha_usu))
	      include "includes/cadastro_insert.inc";
	    else
	      include "includes/cadastro_update.inc";
	?>
    </div>


</div>