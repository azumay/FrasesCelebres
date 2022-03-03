<div class="logo">
	<logomenu>
	<ul>
		<li class="logo">Thos i Codina</li>
		<li>M07</li>
		<li>UF1</li>
		<li>2021-2022</li>
	</ul>
	</logomenu>
	<infosmenu>
	<ul>
		<a href='?url=ContactController/show'>
			<li><?php echo $mainContacta;?></li>
		</a>
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE ) {
?>
		<a href='?url=UsuarioController/logout'>
			<img src="<?php echo $_SESSION['img'];?>" alt="imatge de l'usuari" width="50" height="50" >
		</a>
<?php 
} else {
?>
		<a href='?url=UsuarioController/login'>
			<li class="btn"><?php echo $mainLog_in;?></li>
		</a>
<?php 
}
?>

	</ul>
	</infosmenu>
</div>