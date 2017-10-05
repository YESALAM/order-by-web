<div class="page-row footer" style="background-color:<?php echo $info["cor_navbar"]; ?>;">
    <div class="parceiros hidden-xs">
    	<?php 
			//Laço de repetição que imprime cada parceiro contido no json
			foreach($info["parceiros"] as $parceiro) : ?>
        	<a href="<?php echo $parceiro["site_parceiro"]; ?>" target="_blank" title="<?php echo $parceiro["nome_parceiro"]; ?>"><img src="<?php echo (isset($_SESSION["tipo"]) || $informacoes ? "../" : ""); ?>../fotos/site/<?php echo $parceiro["logo_parceiro"]; ?>" /></a>
        <?php endforeach; ?>
    </div>
    <p>
    	<i class="fa fa-map-marker"></i> <?php echo $info["endereco_escola"]; ?><br/>
    	<i class="fa fa-phone"></i> <?php echo $info["telefone_escola"]; ?>&nbsp;&nbsp;<i class="fa fa-envelope"></i> <?php echo $info["email_escola"]; ?>
	</p>
</div>