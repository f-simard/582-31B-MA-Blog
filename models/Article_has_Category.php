<?php

namespace App\Models;
use App\Models\CRUD;

class Article_has_Category extends CRUD {

    protected $table = "Article_has_Category";
	protected $fillable = ['idArticle', 'idCategory']; 
	

	/**
	 * create categorie relation
	 */
	final public function insertMultiple($data, $idArticle){
		foreach($data as $key=>$value){
			if (substr($key, 0, 3) === 'cat'){
				$idCategory = substr($key, 3);
				$relationCategory['idCategory'] = $idCategory;
				$relationCategory['idArticle'] = $idArticle;

				$insert = $this->insert($relationCategory);
			};
		};
	}
}