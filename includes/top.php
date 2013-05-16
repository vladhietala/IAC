	<div id="page_header">

		<div id="page_heading">
		  <h1>Cell<span>NET</span></h1>
		  <h2>Tudo em telefonia celular</h2>
		</div>
	
		<div id="login">
			<?php 
			    if (empty($senha_usu))
			      include ("includes/logar.inc"); 
			    else
			      include ("includes/welcome.inc");
			 ?>
		</div>


	</div><br clear="all" />