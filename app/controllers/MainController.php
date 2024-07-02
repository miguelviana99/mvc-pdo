<?php
/**
 * Main Controller
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
