{{ include('layouts/header.php' , {title: 'Comptes'}) }}

<section>
	<h1>Comptes</h1>
</section>
<section class="label-list">
{% for user in users %}
<div class="doubleForm">
	<form action="{{base}}/user/edit" method="get">
		<input type="hidden" name="idUser" value="{{user.idUser}}">
		<p>{{user.firstName}} {{user.lastName}} 
			(<a  class= "lien" href="{{base}}/user/show?idUser={{user.idUser}}">{{user.username}}</a> )
		</p>
		<button class="bouton end">Modifier</button>
	</form>
	<form action="{{base}}/admin/user/delete" method="post">
		<input type="hidden" name="idUser" value="{{user.idUser}}">
		<button class="bouton rouge">Supprimer</button>
	</form>
</div>
{% endfor %}
</section>

{{ include('layouts/footer.php')}}