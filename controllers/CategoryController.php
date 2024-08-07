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
				$select = $category->select();

				return View::render('admin/category', ['success'=>'Ajout réussi', 'categories' => $select]);

			} else {
				$errors = $validator->getErrors();

				//print_r($errors);
				return View::render('admin/category', ['errors'=>$errors, 'categories'=>$select]);
			}
		} else {
			$adminController = new AdminController();
			$adminController->showCategory();
		}

	}

	public function update($data){

		$category = new Category();
		$select = $category->select();

		if(isset($data['idCategory']) && $data['idCategory']) {

			$idCategory = $data['idCategory'];

			$validator = new Validator();
			$validator->field('category', $data['label'], 'Catégorie')->trim()->min(1)->max(45);

			if($validator->isSuccess()){
				$update = $category->update($data, $idCategory);
				$select = $category->select();

				return View::render('admin/category', ['success'=>'Mise à jour réussie', 'categories'=>$select]);

			} else {
				$errors = $validator->getErrors();

				//print_r($errors);
				return View::render('admin/category', ['errors'=>$errors, 'categories'=>$select]);
			}
		} else {
			$adminController = new AdminController();
			$adminController->showCategory();
		}
	}

	public function delete($data=[]) {

		$category = new Category();

		if(isset($data['idCategory']) && $data['idCategory']!=null) {

			$idCategory = $data['idCategory'];

			$article_has_category = new Article_has_Category();
			$deleteArticleCategoryRelation = $article_has_category->delete($idCategory, 'idCategory');

			if($deleteArticleCategoryRelation) {

				$deletecategory = $category->delete($idCategory);
				$select = $category->select();

				return View::render('admin/category', ['success'=>'Suppression réussie', 'categories'=>$select]);

			} else {
				$errors['msg'] = 'Erreur lors de la suppression';

				$select = $category->select();
				return View::render('admin/category', ['errors'=>$errors, 'categories'=>$select]);
			}
		} else {
			return View::render('error', ['msg'=>'Record does not exist']);
		}

	}


}