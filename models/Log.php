<?php

namespace App\Models;
use App\Models\CRUD;

class Log extends CRUD {

    protected $table = "Log";
    protected $primaryKey = 'idLog';
	protected $fillable = ['ipAddress','username', 'page']; 

    final public function getLogInfo(){
        $data = [];

        if(isset($_SESSION['fingerPrint']) and md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'])) {
            $data['username'] = $_SESSION['username'];
        } else {
            $data['username'] = 'Guest';
        }

        $data['ipAddress'] = $_SERVER['SERVER_ADDR'];
        $data['page'] = $_SERVER['REQUEST_URI'];

        return $data;
    }
}