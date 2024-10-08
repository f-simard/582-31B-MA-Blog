{{ include('layouts/header.php' , {title: 'Compte'}) }}

<section>
	<h1>Compte</h1>
</section>
<section>
	{% if user.avatar %}
	<picture class="medaillon">
		<img src="{{upload}}{{user.avatar}}" alt="avatar">
	</picture>
	{% endif %}
	<p>Prénom : {{user.firstName}} </p>
	<p>Nom de famille : {{user.lastName}}</p>
	<p>Nom d'utilisateur : {{user.username}} </p>
	<p>Courriel : {{user.email}} </p>
	<p>Admin : {% if user.isAdmin is same as(1) %} Oui {% else %} Non {% endif %}</p>
	<form action="{{base}}/user/edit" method="get">
		<input type="hidden" name="idUser" value="{{ user.idUser }}">
		<button class="bouton">Modifier</button>
	</form>
</section>

{{ include('layouts/footer.php') }}