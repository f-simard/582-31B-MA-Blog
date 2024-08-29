{{ include('layouts/header.php' , {title: 'Accueil', navActive:'admin'}) }}

<section>
<h1>Articles</h1>
</section>
<section class="label-list">
{% if success is not null %}
	<span class="success">{{success}}</span>
{% endif %}
{% if msg is defined %}
	<p>{{ msg }}</p>
{% endif %}
{% for article in articles %}
	<div class="doubleForm">
		<form action="{{base}}/article/edit" method="get">
			<input type="hidden" name="idArticle" value="{{article.idArticle}}">
			<p>{{article.title}}</p>
			<button class="bouton end">Modifier</button>
		</form>
		<form action="{{base}}/article/delete" method="post">
			<div class="auto">
				<input type="hidden" name="idArticle" value="{{article.idArticle}}">
				<button class="bouton rouge">Supprimer</button>
			</div>
		</form>
	</div>
{% endfor %}
</section>

{{ include('layouts/footer.php')}}