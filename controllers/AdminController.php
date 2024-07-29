<?php 

namespace App\Controllers;

use App\Providers\View;

class AdminController {

	public function index(){

		return View::render('admin/index');

	}

}