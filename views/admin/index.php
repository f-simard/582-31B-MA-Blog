{{ include('layouts/header.php' , {title: 'Administration', navActive:'admin'}) }}

	<section>
		<h1>Options</h1>
	</section>
	<section class="option-admin">
		<a href="{{base}}/admin/article" class="bouton">Articles</a>
		{% if session.isAdmin == 1 %}
			<a href="{{base}}/admin/user" class="bouton">Comptes</a>
			<a href="{{base}}/admin/category" class="bouton">Catégories</a>
			<a href="{{base}}/admin/tag" class="bouton">Tags</a>
		{% endif %}
		{% if not session.isAdmin %}
			<a href="{{base}}/user/show?idUser={{session.idUser}}" class="bouton">Profil</a>
		{% endif %}
	</section>

{{ include('layouts/footer.php')}}