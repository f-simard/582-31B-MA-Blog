<?php

require_once("classes/CRUD.php");

$data = [];

$data['username'] = $_POST['username'];
$data['content'] = $_POST['content'];
$data['title'] = $_POST['title'];

$crud = new CRUD();
$insert = $crud->insert('article', $data);
$selectTags = $crud->select('Tag');
$tags = [];

foreach ($selectTags as $selectTag){
	$tags[$selectTag['idTag']] = $selectTag['label'];
}

$submittedTags = explode(";", $_POST['tag']);
//https://www.geeksforgeeks.org/how-to-trim-all-strings-in-an-array-in-php/
$submittedTagsClean = array_map('trim', $submittedTags);
print_r($submittedTagsClean);

if($insert){
	foreach($_POST as $key=>$value){
		if (str_starts_with($key, 'cat')){
			$idCategory = substr($key, 3);
			$relationCategory['idCategory'] = $idCategory;
			$relationCategory['idArticle'] = $insert;
			$insertCategoryRelation = $crud->insert('Article_has_Category', $relationCategory);
		};
	}

		$insertTag = [];

		foreach($submittedTagsClean as $submittedTagClean){

			if (in_array($submittedTagClean, $tags)) {
				$relationTag['idTag'] = array_search($submittedTagClean, $tags);

			} else {
				$insertTag['label'] = $submittedTagClean;
				$newTag = $crud->insert('Tag', $insertTag);
				$relationTag['idTag'] = $newTag;
			}
			$relationTag['idArticle'] = $insert;
			$insertTagRelation = $crud->insert('Article_has_Tag', $relationTag);
		}

} else {
	header('location:article.php?idArticle='.$insert);
	exit;
}





//TODO: inserer tags s'il n'existe pas deja
//TODO: inserer relation tags

header('location:article.php?idArticle='.$insert);


