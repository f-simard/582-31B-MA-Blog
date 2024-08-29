<?php

namespace App\Models;
use App\Models\CRUD;

class Article extends CRUD {

    protected $table = "Article";
    protected $primaryKey = 'idArticle';
	protected $fillable = ['idUser', 'title', 'content', 'createTimestamp', 'updateTimestamp']; 


	/**
	 * retourn l'id et le libelé des tages liés à l'article
	 */
	final public function getArticleTag($value){
		
		$sql = "SELECT T.idTag as idTag ,T.label AS label
				FROM Article A
				INNER JOIN Article_has_Tag AT ON A.idArticle = AT.idArticle
				INNER JOIN Tag T ON AT.idTag = T.idTag
				WHERE A.idArticle = :idArticle;
				";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(":idArticle", $value);
		$stmt->execute();

		$count = $stmt->rowCount();

		if ($count > 0){
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}

	/**
	 * retourne l'auteur d'un article; ou faux si l'auteur a été supprimé
	 */ 
	final public function getArticleAuthor($value){

		$sql = "SELECT U.lastName as lastName, U.firstName as firstName, U.username as username
				FROM Article A
				INNER JOIN User U ON A.idUser = U.idUser
				WHERE A.idArticle = :idArticle;
				";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(":idArticle", $value);
		$stmt->execute();

		$count = $stmt->rowCount();

		$auteurString = '';

		if ($count > 0){
			$auteur = $stmt->fetchAll();
			$auteurString = $auteur[0]['firstName'] . ' ' . $auteur[0]['lastName'];
		} else {
			$auteurString = "auteur supprimé";
		}

		return $auteurString;

	}

	/*
	 * retourn l'id et le libelé des catégories liés à l'article
	 */

	final public function getArticleCategory($value) {

		$sql = "SELECT C.idCategory as idCategory, C.label AS label
				FROM Article A
				INNER JOIN Article_has_Category AC ON A.idArticle = AC.idArticle
				INNER JOIN Category C ON AC.idCategory = C.idCategory
				WHERE A.idArticle = :idArticle;
				";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(":idArticle", $value);
		$stmt->execute();

		$count = $stmt->rowCount();

		if ($count > 0){
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}
	
}