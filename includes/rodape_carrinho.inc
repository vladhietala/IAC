 <div id="rodape_carrinho">
	  <div class="valor_frete">Frete: 
		  <?php 
		      if($calculo > 1000.00)
		      {
			echo "Gratis!";   
			$total = number_format($calculo, 2, ',' , '.');
		      }
		      else
		      {
			echo "R$ 20,00";
			$tot = $calculo + 20;
			$total = number_format($tot, 2, ',' , '.');
		      }
		      
		  ?>
	  </div><br clear="all" />
	  <div class="total">Total: R$ <?php echo $total; ?></div><br clear="all" />
	  <div class="pagto">Forma de pagto &uacute;nica:<br /><img src="images/boleto.jpg" /></div><br clear="all" />
	  <div><a href="?sistema=com" ><img src="images/comprar.jpg" /></a></div>
      </div>