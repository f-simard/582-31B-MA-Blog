{{ include('layouts/header.php' , {title: 'Gérer catégories', navActive:'admin'}) }}

<section>
	<h1>Catégorie</h1>
</section>
<section class="label-list">
	{% if success is defined %}
		<span class="success">{{success}}</span>
	{% endif %}
	{% if errors.category is defined %}
		<span class="error">{{errors.category}}</span>
	{% endif %}
	{% if errors.msg is defined %}
		<span class="error">{{errors.msg}}</span>
	{% endif %}
	{% for category in categories %}
	<div>
		<form action="{{base}}/admin/category/update" method="post">
			<input type="hidden" name="idCategory" value="{{category.idCategory}}">
			<input type="text" name="label" id="label" value="{{category.label}}">
			<button class="bouton">Sauvegarder</button>
		</form>
		<form action="{{base}}/admin/category/delete" method="post">
			<input type="hidden" name="idCategory" value="{{category.idCategory}}">
			<button class="bouton rouge">Supprimer</button>
		</form>
	</div>
	{% endfor %}
	<form action="{{base}}/admin/category/create" method="post">
		<input type="text" name="label" id="label">
		<button class="bouton">Créer</button>
	</form>
</section>
{{ include('layouts/footer.php')}}