<?php

namespace App\Models;

abstract class CRUD extends \PDO {

	final public function __construct() {
		parent::__construct('mysql:host=localhost;dbname=blog;port=3306;charset=utf8', 'root', '');
	}


	final public function select($field = null, $order = 'ASC') {

		if($field == null){
			$field = $this->primaryKey;
		}

		$sql = "SELECT * FROM $this->table ORDER BY $field $order";
		$stmt = $this->query($sql);
		return $stmt->fetchAll();

	}


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

		if ($count > 0){
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}


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


	final public function selectByField($value, $field = null){

		if($field == null){
			$field = $this->primaryKey;
		}


		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT * FROM $this->table WHERE $field = :$field";
		$stmt = $this->prepare($sql);
		/*$stmt->execute(array($value));*/
		$stmt->bindValue(":$field", $value);
		$stmt->execute();
	
		$count = $stmt->rowCount();
	
		if ($count == 1){
			return $stmt->fetch();
		} else {
			return false;
		}
	}

	final public function insert($data){

		$data_keys = array_fill_keys($this->fillable, '');
		$data = array_intersect_key($data, $data_keys);

		$fieldName = implode(', ', array_keys($data));
		$fieldValues = ':' . implode(', :', array_keys($data));

		$sql = "INSERT INTO $this->table ($fieldName) values ($fieldValues)";

		$stmt = $this->prepare($sql);
		forEach($data as $key=>$value){
			$stmt->bindValue(":$key", $value);
		}

		if($stmt->execute()){
			return $this->lastInsertId();
		} else {
			return false;
		}

	}

	final public function update($data, $id){

		if($this->selectByField($id)){
			$data_keys = array_fill_keys($this->fillable, '');
			$data = array_intersect_key($data, $data_keys);
			$data[$this->primaryKey] = $id;
	
			$fieldName = null;

			forEach($data as $key=>$value){
				$fieldName .= "$key = :$key, ";

			};

			$fieldName = rtrim($fieldName, ', ');

			$sql = "UPDATE $this->table SET $fieldName WHERE $this->primaryKey = :$this->primaryKey";

			$stmt = $this->prepare($sql);
			forEach($data as $key=>$value){
				$stmt->bindValue(":$key", $value);
			}
			$stmt->execute();

			if($stmt->execute()){
				return true;
			} else {
				return false;
			}

		}
	}

	final public function delete($value, $field = null){

		if($field == null){
			$field = $this->primaryKey;
		}


		$sql = "DELETE FROM $this->table WHERE $field = :$field";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(":$field", $value);
		$stmt->execute();


		if($stmt->execute()){
			return true;
		} else {
			return false;
		}

	}

	final public function unique($field, $value, $fieldException = null, $valueException = null){
		echo 'field Exception ' . $fieldException;
		echo 'value exception ' . $valueException;

		if($fieldException && $valueException){
			$sql = "SELECT * FROM $this->table WHERE $field = :$field AND $fieldException <> :$fieldException";
		} else {
			$sql = "SELECT * FROM $this->table WHERE $field = :$field";
		}

		$stmt = $this->prepare($sql);
		$stmt->bindValue(":$field", $value);

		if($fieldException && $valueException){
			$stmt->bindValue(":$fieldException", $valueException);
		}

		$stmt->execute();

		$count = $stmt->rowCount();

		if($count == 1){
			return $stmt->fetch();
		} else {
			return false;
		}
	} // fermeture fonction




}