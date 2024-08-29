{{ include('layouts/header.php' , {title: 'Modifier compte'}) }}

<section>
		<h1>Modifier informations</h1>
		</section>
		<form class="soumettre"" method="post" novalidate>
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
			<label for="email">Courriel</label>
			<input required type="email" name="email" id ="email" value="{{user.email}}">
			{% if errors.email is defined %}
            	<span class="error">{{errors.email}}</span>
            {% endif %}
			<label for="password">Mot de passe <small><i>(si laissé vide, le mot de passe restera inchangé)</i></small></label>
			<input required type="password" name="password" id ="password">
			{% if errors.password is defined %}
            	<span class="error">{{errors.password}}</span>
            {% endif %}

			{% if session.isAdmin %}
			<div>
				<input type="checkbox" name="isAdmin" id ="isAdmin" {% if user.isAdmin == 1 %} checked {% endif %} >
				<label for="isAdmin">Admin</label>
			</div>
			{% endif %}

			<input type="submit" value="Sauvegarder" class="bouton">
		</form>

{{ include('layouts/footer.php') }}