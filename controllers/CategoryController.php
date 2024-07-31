<?php 

namespace App\Controllers;

use App\Models\Category;
use App\Models\Article_has_Category;

use App\Providers\View;
use App\Providers\Validator;

use App\Controllers\AdminController;

class CategoryController {

	public function store($data=[]){

		$category = new Category();
		$select = $category->select();

		if(isset($data['label']) && $data['label']) {

			$labelCategory = $data['label'];

			$validator = new Validator();
			$validator->field('category', $data['label'], 'Catégorie')->trim()->min(1)->max(45);

			if($validator->isSuccess()){
				$store = $category->insert($data);

				return View::redirect('admin/category');

			} else {
				$errors = $validator->getErrors();

				//print_r($errors);
				return View::render('admin/tag', ['errors'=>$errors, 'categories'=>$select]);
			}
		} else {
			$adminController = new AdminController();
			$adminController->showCategory();
		}

	}

	public function update($data){

		// $tag = new Tag();
		// $select = $tag->select();

		// if(isset($data['idTag']) && $data['idTag']) {

		// 	$idTag = $data['idTag'];

		// 	$validator = new Validator();
		// 	$validator->field('tag', $data['label'])->trim()->min(1)->max(45);

		// 	if($validator->isSuccess()){
		// 		$tag = new Tag();
		// 		$update = $tag->update($data, $idTag);

		// 		$select = $tag->select();

		// 		return View::render('admin/tag', ['tags'=>$select]);

		// 	} else {
		// 		$errors = $validator->getErrors();

		// 		//print_r($errors);
		// 		return View::render('admin/tag', ['errors'=>$errors, 'tags'=>$select]);
		// 	}
		// } else {
		// 	$adminController = new AdminController();
		// 	$adminController->showTag;
		// }
	}

	public function delete($data=[]) {

		if(isset($data['idCategory']) && $data['idCategory']!=null) {

			$idCategory = $data['idCategory'];

			$article_has_category = new Article_has_Category();
			$deleteArticleCategoryRelation = $article_has_category->delete($idCategory, 'idCategory');

			$category = new Category();
			$deletecategory = $category->delete($idCategory);


			if($deleteArticleCategoryRelation) {
				return View::redirect('admin/category');
			} else {
				return View::render('error');
			}
		} else {
			return View::render('error', ['msg'=>'Record does not exist']);
		}

	}


}