<section class="infos">

		<!-- multistep form -->
	<form id="msform" action="?url=UsuarioController/register" method="post" autocomplete="off" enctype="multipart/form-data">
		<!-- progressbar -->
		<ul id="progressbar">
			<li class="active">Dades d'accés</li>
			<li>Dades Personals</li>
			<li>Altres dades</li>
		</ul>
		<!-- fieldsets -->
		<fieldset>
			<h2 class="fs-title">Crea el teu compte d'usuari</h2>
			<h3 class="fs-subtitle">Aquest és el primer pas</h3>
				<span class="error" > <?php echo (isset($errorsDetectats["error"]))?$errorsDetectats["error"]:"";?> </span>
				<?php 
				echo $input_email;
				echo $input_pass;
				echo $input_cpass;
				echo $input_bNext;
				?>
		</fieldset>
		<fieldset>
			<h2 class="fs-title">Dades personals</h2>
			<h3 class="fs-subtitle">Entra les teves dades personals</h3>
				<?php 
				echo $select_Tipus;
				echo $input_dni;
				echo $input_nom;
				echo $input_cognoms;
				echo "<div>$select_Sexe</div>";
				echo $input_naixement;
				echo $input_bPrev;
				echo $input_bNext;	
				?>
		</fieldset>
		<fieldset>
			<h2 class="fs-title">Altres dades</h2>
			<h3 class="fs-subtitle">Si vols, pots afegir una imatge teva</h3>
			<?php 
			echo $input_adreca;
			echo $input_cp;
			echo $input_poblacio;
			echo $input_provincia;
			echo $input_telefon;
			?>
			<label for="imatge">Selecciona una imatge teva</label>
			<?php 
			echo $input_maxFileSize;
			echo $input_imatge;
			?>
			<span class="error" style="color:red;"> <?php echo (isset($errorsDetectats["baseDades"]))?$errorsDetectats["baseDades"]:"";?> </span>
			<?php 
			echo $input_bPrev;
			echo $input_bSend;
			?>
		</fieldset>
	</form>
		<script
		src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script
		src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
	
	<script src="js/index.js"></script>

</section>