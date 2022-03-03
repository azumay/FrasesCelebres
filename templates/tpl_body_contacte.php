
<section class="infos">
	<div class="content">
		<div class="grid">
			<div class="float-md-50 wimg">
				<img src="img/contacte.jpg" />
			</div>
			<div class="winfo">
				<h1 class="title"><?php echo (isset($contacteForm))?$contacteForm:"";?></h1>
				<p class="description"><?php echo (isset($missatgeOK))?$missatgeOK:"";?></p>
				<p class="form">				
				<form action="" method="post" target=_blank">
					<input type="text" 
						name="nom"
						placeholder="<?php echo (isset($contacteNom))?$contacteNom:"";?>"
						value="<?php echo (isset($frmNom))?$frmNom:""; ?>"> 
						<span class="error"><?php echo (isset($errors["nom"]))?$errors["nom"]:"";?></span>
					<input type="text" 
						name="email"
						placeholder="<?php echo (isset($contacteMail))?$contacteMail:"";?>"
						value="<?php echo (isset($frmMail))?$frmMail:""; ?>"> 
						<span class="error"><?php echo (isset($errors["mail"]))?$errors["mail"]:"";?></span>
					<textarea name="missatge" 
						placeholder="<?php echo (isset($contacteMsg))?$contacteMsg:"";?>"><?php echo (isset($frmMsg))?$frmMsg:""; ?></textarea>
						<span class="error"><?php echo (isset($errors["missatge"]))?$errors["missatge"]:"";?></span> 
					<input
						type="submit" 
						name="boto" 
						value="<?php echo $contacteEnviar;?>"
						class="btn">
				</form>
				</p>


			</div>

		</div>
	</div>
</section>