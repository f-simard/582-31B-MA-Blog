{{ include('layouts/header.php' , {title: 'Se connecter', navActive:'login'}) }}

		<section>
		<h1>Se Connecter</h1>
		</section>
		<form class="soumettre"" method="post" novalidate>

			{% if errors.message is defined %}
			<span class="error">{{errors.message}}</span>
			{% endif %}
			{% if msg is defined %}
			<span class="success">{{msg}}</span>
			{% endif %}


			<label for="username">Nom d'utilisateur</label>
			<input required type="text" name="username" id ="username" value="{{user.username}}">
			{% if errors.username is defined %}
            	<span class="error">{{errors.username}}</span>
            {% endif %}

			<label for="password">Mot de passe</label>
			<input required type="password" name="password" id ="password" value="{{user.password}}">
			{% if errors.password is defined %}
            	<span class="error">{{errors.password}}</span>
            {% endif %}

			<input type="submit" value="Connecter" class="bouton">

		</form>

{{ include('layouts/footer.php') }}