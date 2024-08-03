{{ include('layouts/header.php' , {title: 'Article'}) }}

<section class="article">
	<h1>{{article.title}}</h1>
	<h3>By {{auteur}}</h3>
	<p><small>Catégorie: {{categoriesString}}</small></p>
	<p><small>Tags: {{tagsString}}</small></p>
	<p>{{article.content}}</p>
</section>
<form action="{{base}}/article/edit" method="get">
	<input type="hidden" name="idArticle" value="{{article.idArticle}}">
	<button class="bouton">Modifier</button>
</form>

{{ include('layouts/footer.php')}}