<?php
/**
 * App
 */

class App
{
	private $config = [];
	public $db;

	function __construct ()
	{
		ini_set('display_errors', 0);
		error_reporting(E_ERROR | E_WARNING | E_PARSE);

		define('URI', $_SERVER['REQUEST_URI']);
		define('ROOT', $_SERVER['DOCUMENT_ROOT']);
		define('PROJECT_FOLDER', '/mvc');
		define('DS', DIRECTORY_SEPARATOR);
	}

	/**
	 * Autoload
	 */
	public function autoload() : void
	{
		spl_autoload_register(function ($class) {
			$class = strtolower($class);

			if (file_exists(ROOT . '/core/classes/' . $class . '.php')) {
				require_once(ROOT . '/core/classes/' . $class . '.php');
			} else if (file_exists(ROOT . '/core/helpers/' . $class . '.php')) {
				require_once(ROOT . '/core/helpers/' . $class . '.php');
			}
		} );
	}

	/**
	 * Config
	 */
	public function config() : void
	{
		$this->config['db'] = array(
			'driver'   => 'mysql',
			'host'     => 'localhost',
			'username' => 'root',
			'password' => '',
			'name'     => 'crud-mvc-oop-pdo'
		);

		try {
			$this->db = new PDO(
				$this->config['db']['driver'] . ':host=' . $this->config['db']['host'] . ';dbname=' . $this->config['db']['name'],
				$this->config['db']['username'],
				$this->config['db']['password']
			);

			$this->db->query('SET NAMES utf8');

			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			error_log(
				'[' . date('Y-m-d H:i:s') . '] [ERROR] [' . $_SERVER['REMOTE_ADDR'] . '] ' . $e->getMessage() . "\n",
				3,
				'error.log'
			);
			die($e->getMessage());
		}
	}

	/**
	 * Start
	 */
	public function start() : void
	{
		session_name('session_1');
		session_start();

		$route    = explode('/', URI);
		$route[1] = strtolower($route[1]);

		if (file_exists(__DIR__ . DS . '..' . DS . 'app' . DS . 'controllers' . DS . ucfirst($route[1]) . 'Controller.php')) {
			require(__DIR__ . DS . '..' . DS . 'app' . DS . 'controllers' . DS . ucfirst($route[1]) . 'Controller.php');
			$controller = new $route[1]();
		} else {
			require(ROOT . PROJECT_FOLDER . '/app/controllers/MainController.php');
			$main = new MainController();
		}
	}
}
