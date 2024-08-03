{{ include('layouts/header.php' , {title: 'Accueile'}) }}

<section>
	<h1>Titre</h1>
	<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae quidem alias cumque dolor earum quo voluptatum ut nostrum eius veniam. Sint voluptatem fugiat exercitationem sed? Qui ipsam natus omnis illum?</p>
</section>
<section class="article-liste">s
{% for article in articles %}
	<article class="article">
	<h2>{{article.title}} <a href="{{base}}/article/show?idArticle={{article.idArticle}}" class="lire">&#10097;</a></h2>
			<div data-category>
			{# //source:https://twig.symfony.com/doc/3.x/tags/if.html #}
			{% if article.categories %}
				{% for category in article.categories %}
					<span>{{ category }}</span>
				{% endfor %}
			{% else %}
				<span><i>Sans catégorie</i></span>
			{% endif %}
		</div>
		<div data-tags>
		{% if article.tags %}
			{% for tag in article.tags %}
				<span>{{tag}}</span>
			{% endfor %}
		{% else %}
			<span><i>Sans Tag</i></span>
		{% endif %}
		</div>

	</article>
{% endfor %}
</section>

{{ include('layouts/footer.php')}}