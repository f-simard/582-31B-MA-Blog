{{ include('layouts/header.php' , {title: 'Administration'}) }}

	<section>
		<h1>Options</h1>
	</section>
	<section class="option-admin">
		<a href="{{base}}/admin/article" class="bouton">Articles</a>
		<a href="{{base}}/admin/user" class="bouton">Comptes</a>
		<a href="{{base}}/admin/category" class="bouton">Catégories</a>
		<a href="{{base}}/admin/tag" class="bouton">Tags</a>
	</section>

{{ include('layouts/footer.php')}}