<?php

    include("header.php");
?>

	<body>
		<div class="container_page">
        <form method="post" action="ESSAI PPE\Panneau creation, connexioncss/Q-CreaCompte.css" name="login_form" class="div_connexion">
			<div class="container_center">
				<div>
					<label for="idLogin">Prenom:</label>
					<input type="text" id="idLogin" name="Prenom" class="input_login" required>
				</div>
				<div>
					<label for="mail">E-mail:</label>
					<input type="text" id="mail" name="mail" class="input_login" required>
				</div>
				<div>
					<label for="idIdentifiant">Identifiant:</label>
					<input type="text" id="idIdentifiant" name="Identifiant" class="input_login" required>
				</div>
				<div>
					<label for="idPassword">Password:</label>
					<input type="password" id="idPassword" name="Password" class="input_password" required>
				</div>
				<input type="submit" value="Connexion" class="button_connexion">
			</div>
		</form>
		</div>

<?php

    include("footer.php");
?>