
<section class="infos">
	<div class="content">
		<h1 class="titulo-reset">Base de Datos "FrasesAutor" acaba de ser reseteada ✅</h1>
		<h3 class="atencion">⚠️Para que funcione la web correctamente ejecuta los siguientes comandos:⚠️</h3>
		<div class="comandos-sql">

			<pre>
				<code>CREATE USER 'yamuza'@'localhost' IDENTIFIED BY 'yamuza';</code>
			</pre>
		</div>
		<div class="comandos-sql">
			<pre>
				<code>GRANT ALL PRIVILEGES ON FrasesAutor.* TO 'yamuza'@'localhost';</code>
			</pre>
		</div>
		<div class="comandos-sql">	
			<pre>
				<code>FLUSH PRIVILEGES;</code>
			</pre>
		</div>
		

		<div class="grid allcenter">

			<div class="float-md-50 wimg">
				<img
					src="https://www.malagana.net/wp-content/uploads/2015/11/generador-numeros-aleatorios.jpg" />
			</div>
			<div class="float-md-50 winfo">    				
    				<?php echo "<h1 class='title'>$resultat</h1>"; ?>
    						
					<p class="description"><?php echo $mainInfo1Desc;?></p>
				<a href='index.php'> <input type="button" class="btn"
					value="<?php echo $mainInfo1Btn;?>"></a>
			</div>
		</div>

		<div class="grid allcenter" href="cotis.php">
			<div class="float-md-50 wimg">
				<a href="?pg=cotis"> <img
					src="https://www.farobursatil.com/wp-content/uploads/2017/09/tiempo-real.jpg" />
				</a>
			</div>
			<div class="float-md-50 winfo">
				<a href="?pg=cotis">
					<h1 class="title"><?php  echo $resultat;?></h1>
					<p class="description"><?php echo $mainInfo2Desc;?></p>
				</a>
			</div>

		</div>
		<div class="grid allcenter" href="cotis.php">
			<div class="float-md-50 wimg">
				<img
					src="https://www.capgros.com/uploads/s1/18/85/5/20131212101227.jpg" />
			</div>
			<div class="float-md-50 winfo">
				<h1 class="title"><?php  echo $mainInfo3Title;?></h1>
				<p class="description"><?php echo $mainInfo3Desc;?></p>
			</div>
		</div>


		<div class="grid allcenter">
			<div class="float-md-50 wimg">
				<img
					src="http://www.totmataro.cat/index.php?option=com_joomgallery&view=image&format=raw&id=3403&type=img" />
			</div>
			<div class="float-md-50 winfo">
				<h1 class="title"><?php  echo $mainInfo4Title;?></h1>
				<p class="description"><?php echo $mainInfo4Desc;?></p>
			</div>
		</div>
	</div>
</section>