{{ include('layouts/header.php' , {title: 'Tags', navActive:'admin'}) }}

<section>
	<h1>Tags</h1>
</section>
<section class="label-list">
	{% if success is not null %}
		<span class="success">{{success}}</span>
	{% endif %}
	{% if errors.tag is defined %}
		<span class="error">{{errors.tag}}</span>
	{% endif %}
	{% if errors.msg is defined %}
		<span class="error">{{errors.msg}}</span>
	{% endif %}
	{% for tag in tags %}
	<div>
		<form action="{{base}}/admin/tag/update" method="post">
			<input type="hidden" name="idTag" value="{{tag.idTag}}">
			<input type="text" name="label" id="label" value="{{tag.label}}">
			<button class="bouton">Sauvegarder</button>
		</form>
		<form action="{{base}}/admin/tag/delete" method="post">
			<input type="hidden" name="idTag" value="{{tag.idTag}}">
			<button class="bouton rouge">Supprimer</button>
		</form>
	</div>
	{% endfor %}
</section>

{{ include('layouts/footer.php')}}