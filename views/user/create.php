{{ include('layouts/header.php' , {title: 'Créer compte'}) }}

		<section>
		<h1>Créer un compte</h1>
		</section>
		<form class="soumettre" action="" method="post">
			<label for="firstName">Prénom</label>
			<input type="text" name="firstName" id ="firstName">
			<label for="lastName">Nom de famille</label>
			<input type="text" name="lastName" id ="lastName">
			<label required for="username">Nom d'utilisateur	</label>
			<input type="text" name="username" id ="username">
			<label for="email">Courriel</label> <input type="email" name="email" id ="email">
			<label for="password">Mot de passe</label>
			<input type="text" name="password" id ="password">
			<div>
				<input type="checkbox" name="isAdmin" id ="isAdmin">
				<label for="isAdmin">Admin</label>
			</div>
			<input type="submit" value="Sauvegarder" class="bouton">
		</form>

{{ include('layouts/footer.php') }}