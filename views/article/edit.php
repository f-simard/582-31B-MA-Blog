{{ include('layouts/header.php' , {title: 'Modifier article'}) }}

<form class="soumettre" id="modifier-article" action="" method="post">
	<label for="title">Titre de l'article</label>
	<input required type="text" name="title" id="title" value="{{article.title}}">
	{% if errors.title is defined %}
		<span class="error">{{errors.title}}</span>
	{% endif %}
	<label for="content">Votre pensée</label>
	<textarea required type="content" name="content" id="content" rows="6" col="75">{{article.content}}</textarea>
	{% if errors.content is defined %}
		<span class="error">{{errors.content}}</span>
	{% endif %}
	<input type="hidden" name="idUser" value="{{article.idUser}}">
	<p>By {{auteur}}</p>
	<fieldset>
		<legend>Catégories</legend>
		{% if categories %}
			{% for category in categories %}
			<div class="paire">
				<!-- source: https://dev.to/yanyy/string-concatenation-and-interpolation-in-twig-3h2f AND chatGTP-->
				{% set catId = "cat" ~ category.idCategory %}
				<input type="checkbox" name="cat{{category.idCategory}}" id="{{category.label}}" {% if category.checked == 1 %} checked {% endif %} {% if attribute(article, catId) == 'on' %} checked {% endif %}>
				<label id="{{category.label}}">{{category.label}}</label>
			</div> 
			{% endfor %}
		{% else %}
			<p>Aucune catégorie disponible</p>
		{% endif %}
	</fieldset>
	<label for="tag">Libelés (séparés par des point-virgules)</label>
	<input type="text" name="tag" id="tag" placeholder="Séparer les libelés par des point-virgules" value="{{tagsString}}">
	<button class="bouton">Sauvegarder</button>
</form>
{{ include('layouts/footer.php')}}