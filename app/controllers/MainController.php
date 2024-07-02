<?php
/**
 * Main Controller
 *
 * @package CRUD MVC OOP PDO
 * @link    https://github.com/utoyvo/crud-mvc-oop-pdo/blob/master/app/controllers/MainController.php
 */
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'classes' . DS . 'Controller.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Site.php';
class MainController extends Controller
{
	/**
	 * Index
	 *
	 * http://localhost/
	 */
	public function index()
	{
		Site::redirect( '/teams' );
	}

}
