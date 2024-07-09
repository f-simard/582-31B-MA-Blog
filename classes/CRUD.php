<?php

class CRUD extends PDO{
	public function __construct(){
		parent::__construct('mysql:host=localhost;dbname=blog;port=3306;charset=utf8', 'root', '');
	}

	public function select($table, $field = 'id', $order = 'ASC'){
		$sql = "SELECT * FROM $table ORDER BY $field $order";
		$stmt = $this->query($sql);
		return $stmt->fetchAll();
	}

	public function selectArticleById($value, $field='idArticle'){
		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT * FROM article WHERE $field = :$field";
		$stmt = $this->prepare($sql);
		/*$stmt->execute(array($value));*/
		$stmt->bindValue(":$field", $value);
		$stmt->execute();
	
		$count = $stmt->rowCount();
	
		if ($count == 1){
			return $stmt->fetch();
		} else
		return false;
	}

	public function selectById($table, $value, $field= null){
		if ($field == null){
			$field = 'id'.$table;
		}

		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT * FROM $table WHERE $field = :$field";
		$stmt = $this->prepare($sql);
		/*$stmt->execute(array($value));*/
		$stmt->bindValue(":$field", $value);
		$stmt->execute();
	
		$count = $stmt->rowCount();
	
		if ($count == 1){
			return $stmt->fetch();
		} else
		return false;
	}

	public function insert($table, $data){

		$fieldName = implode(', ', array_keys($data));
		$fieldValues = ':' . implode(', :', array_keys($data));

		$sql = "INSERT INTO $table ($fieldName) values ($fieldValues)";

		$stmt = $this->prepare($sql);
		forEach($data as $key=>$value){
			$stmt->bindValue(":$key", $value);
		}
		$stmt->execute();

		return $this->lastInsertId();
	}

	public function update($table, $data, $field = 'id'){

		$fieldName = null;

		forEach($data as $key=>$value){
			$fieldName .= "$key = :$key, ";

		};

		$fieldName = rtrim($fieldName, ', ');

		$sql = "UPDATE $table SET $fieldName WHERE $field = :$field";

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

	public function delete($table, $value, $field = null){

		if ($field == null){
			$field = 'id'.$table;
		}

		$sql = "DELETE FROM $table WHERE $field = :$field";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(":$field", $value);
		$stmt->execute();


		if($stmt->execute()){
			return true;
		} else {
			return false;
		}

	}



}