<?php

namespace App\Providers;

use App\Models;

class Validator {

	private $errors = array();
	private $key;
	private $value;
	private $name;

	//si le champ existe + creation du field dans le validator
	public function field($key, $value, $name = null){
		$this->key = $key;
		$this->value = $value;

		if($name == null){
			$this->name = ucfirst($key);
		} else {
			$this->name = ucfirst($name);
		}

		//pour permettre d'enchainer les references
		return $this;
	}

	//si le champ est requis
	public function required() {
		if (empty($this->value)) {
			$this->errors[$this->key]="$this->name est requis.";
		}
		return $this;
	}

	//si le champ est requis
	public function trim() {
		if (!empty($this->value)) {
			$this->value = trim($this->value);
		}
		return $this;
	}

	//max length
	public function max($length) {
		if(strlen($this->value) > $length) {
			$this->errors[$this->key]="$this->name doit contenir moins que $length caracters";
		}
		return $this;
	}

	//min
	public function min($length) {
		if(strlen($this->value) < $length) {
			$this->errors[$this->key]="$this->name doit contenir plus que $length characters";
		}
		return $this;
	}

	//email, valider que vide pour valider format, si vide, ignore
	public function email() {
		if (!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
			$this->errors[$this->key]="Format de $this->name invalide.";
		}
		return $this;
	}

	//unique, vérifier si la valeur pour le champ entrée existe déjà dans la base de donnée
	public function unique($model, $fieldException = null, $valueException = null){
		$model = 'App\\Models\\'.$model;
		$model = new $model;

		if($fieldException && $valueException){
			$unique = $model->unique($this->key, $this->value, $fieldException, $valueException);
			
		} else {
			$unique = $model->unique($this->key, $this->value);
		}

		if($unique){
			$this->errors[$this->key]="$this->name must be unique";
		}
		return $this;
	}

	public function exist($model, $field = 'id'){
		$model = 'App\\Models\\'.$model;
		$model = new $model;

		$exist = $model->unique($field, $this->value);
		if(!$exist){
			$this->errors[$this->key]="$this->name doit exister";
		}
		return $this;
	}

	public function image() {

		echo 'email validation';

		if($this->value["fileToUpload"]["error"] == 1) {
			$this->errors[$this->key]="Une erreur est survenue avec l'image.";
			return $this;
		};

		$target_file = $_SERVER["DOCUMENT_ROOT"] . UPLOAD . basename($this->value["fileToUpload"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		// Check if image file is a actual image or fake image
		$check = getimagesize($this->value["fileToUpload"]["tmp_name"]);
		if($check == false) {
			$this->errors[$this->key]="Format de $this->name invalide.";
		};

		// Check file size
		if ($this->value["fileToUpload"]["size"] > 200000) {
			$this->errors[$this->key]="L'image est trop grande.";
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$this->errors[$this->key]="Seul les JPG, JPEG, PNG & GIF sont acceptés";
		}

		return $this;
	}

	//if no errors, then success
	public function isSuccess(){
		if(empty($this->errors)) return true;
	}

	//if not success, then error
	public function getErrors(){
		if(!$this->isSuccess()) return $this->errors;
	}



}