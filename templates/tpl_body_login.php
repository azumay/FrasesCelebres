
<section class="infos">
	<div class="content">
		<div class="grid">
			<div class="float-md-50 wimg">
				<img src="img/user.png" />
			</div>
			<div class="winfo">
				<h1 class="title">Sign in</h1>
				<p class="description">Identifica't per accedir</p>
				<p class="form">				
				<form action="?url=UsuarioController/login" method="post" target=_blank">
					<input type="text" 
						name="nom"
						placeholder="Usuari"
						value="<?php echo (isset($frmNom))?$frmNom:""; ?>"> 
						<span class="error"><?php echo (isset($errorsDetectats["nom"]))?$errorsDetectats["nom"]:"";?></span>
					<input type="password" 
						name="contrasenya"
						placeholder="Contrasenya"
						value="<?php echo (isset($frmContrasenya))?$frmContrasenya:""; ?>"> 
						<span class="error"><?php echo (isset($errorsDetectats["contrasenya"]))?$errorsDetectats["contrasenya"]:"";?></span>
						<span class="error"><?php echo (isset($errorsDetectats["bbdd"]))?$errorsDetectats["bbdd"]:"";?></span>
					<input
						type="submit" 
						name="Login" 
						value="login"
						class="btn">
				</form>
				
				</p>
				<ul>
				<a href='?url=UsuarioController/login'>
					<li class="btn">No recordes la contrasenya?</li>
				</a>
				<a href='?url=UsuarioController/register'>
					<li class="btn">Ets usuari nou? Dona't d'alta</li>
				</a>
				</ul>


			</div>

		</div>
	</div>
</section>