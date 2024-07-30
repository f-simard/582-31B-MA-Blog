<?php 

namespace App\Controllers;

use App\Models\Tag;
use App\Models\Article_has_Tag;

use App\Providers\View;
use App\Providers\Validator;

use App\Controllers\AdminController;

class TagController {

	public function update($data){

		$tag = new Tag();
		$select = $tag->select();

		if(isset($data['idTag']) && $data['idTag']) {

			$idTag = $data['idTag'];

			$validator = new Validator();
			$validator->field('tag', $data['label'])->trim()->min(1)->max(45);

			if($validator->isSuccess()){
				$tag = new Tag();
				$update = $tag->update($data, $idTag);

				$select = $tag->select();

				return View::render('admin/tag', ['tags'=>$select]);

			} else {
				$errors = $validator->getErrors();

				//print_r($errors);
				return View::render('admin/tag', ['errors'=>$errors, 'tags'=>$select]);
			}
		} else {
			$adminController = new AdminController();
			$adminController->showTag;
		}
	}

	public function delete($data=[]) {

		if(isset($data['idTag']) && $data['idTag']!=null) {

			$idTag = $data['idTag'];

			$article_has_tag = new Article_has_Tag();
			$deleteArticleTagRelation = $article_has_tag->delete($idTag, 'idTag');

			$tag = new Tag();
			$deleteTag = $tag->delete($idTag);


			if($deleteArticleTagRelation) {
				return View::redirect('admin/tag');
			} else {
				return View::render('error');
			}
		} else {
			return View::render('error', ['msg'=>'Record does not exist']);
		}

	}


}