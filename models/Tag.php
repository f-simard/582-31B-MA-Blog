<?php

namespace App\Models;
use App\Models\CRUD;

class Tag extends CRUD {

    protected $table = "Tag";
    protected $primaryKey = 'idTag';
	protected $fillable = ['label']; 

	/**
	 * vérifie si tag existe, sinon le tag est créé
	 */
	final public function checkTag($submittedTag){
		$select = $this->select();
		$existingTags = [];

		foreach ($select as $row){
			$existingTags[$row['idTag']] = $row['label'];
		}

		if (in_array($submittedTag, $existingTags)) {
			return array_search($submittedTag, $existingTags);
		} else {
			$newTag['label'] = $submittedTag;
			$insert = $this->insert($newTag);
			
		}

		return $insert;
	}

	
}