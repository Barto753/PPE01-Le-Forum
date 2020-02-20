<?php

    include("header.php");
?>
	<body>
		<div class="barre_entete">
			
			<input type="submit" value="Connexion" class="button_connexion">
			<input type="submit" value="Créer un compte" class="button_creation">

		</div>
		<div class="header">
			<img class="Acueil_logo" src="image/imageAcueuil.png" alt="">
				
			<p class="accueil_titre"> Titre Forum </p>
		</div>
		<div class="barre_navigation">
			<input type="submit" value="Menu" class="button_Menu">
			<input type="submit" value="Page 1" class="button_firstPage">
			<input type="submit" value="Page 2" class="button_ThirdPage">
		</div>
		<div class="forum_general">
			<div class="favoris">
				<p class="titre_barre"> Favoris </p>
			</div>	
			<div class="discussion">
				<div class="entete_discussion">
					<p class="discussion_titre"> Titre Forum </p>
					<input type="submit" value="+" class="button_creaDiscution">
				</div>
			</div>

		</div>
		
<?php
	include("footer.php");
?>