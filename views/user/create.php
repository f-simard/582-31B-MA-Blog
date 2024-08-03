{{ include('layouts/header.php' , {title: 'Créer compte', navActive:'newUser'}) }}

		<section>
		<h1>Créer un compte</h1>
		</section>
		<form class="soumettre"" method="post">
			<label for="firstName">Prénom</label>
			<input type="text" name="firstName" id ="firstName" value="{{user.firstName}}">
			{% if errors.firstName is defined %}
            	<span class="error">{{errors.firstName}}</span>
            {% endif %}
			<label for="lastName">Nom de famille</label>
			<input type="text" name="lastName" id ="lastName" value="{{user.lastName}}">
			{% if errors.lastName is defined %}
            	<span class="error">{{errors.lastName}}</span>
            {% endif %}
			<label for="username">Nom d'utilisateur</label>
			<input required type="text" name="username" id ="username" value="{{user.username}}">
			{% if errors.username is defined %}
            	<span class="error">{{errors.username}}</span>
            {% endif %}
			<label for="email">Courriel</label>
			<input required type="email" name="email" id ="email" value="{{user.email}}">
			{% if errors.courriel is defined %}
            	<span class="error">{{errors.courriel}}</span>
            {% endif %}
			<label for="password">Mot de passe</label>
			<input required type="text" name="password" id ="password" value="{{user.password}}">
			{% if errors.password is defined %}
            	<span class="error">{{errors.password}}</span>
            {% endif %}
			<div>
				<input type="checkbox" name="isAdmin" id ="isAdmin" {% if user.isAdmin == 1 %} checked {% endif %} >
				<label for="isAdmin">Admin</label>
			</div>
			<input type="submit" value="Sauvegarder" class="bouton">
		</form>

{{ include('layouts/footer.php') }}