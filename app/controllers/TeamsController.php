<?php
/**
 * Teams Controller
 */
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'classes' . DS . 'Controller.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'classes' . DS . 'Model.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'User.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Site.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'File.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Str.php';

class TeamsController extends Controller
{

	/**
	 * Index
	 *
	 * http://localhost/teams
	 */
	public function index() : void
	{
		$this->model('TeamsModel');

		$pagination = $this->TeamsModel->pagination( 'teams', ( int )$_GET['page'], 5 );
		$sort       = $this->TeamsModel->sort( '', '', []);

		$teams = $this->TeamsModel->getTeams( $pagination, $sort );

		$data = array(
			'title'      => 'Teams',
			'teams'      => $teams,
			'pagination' => $pagination,
		);

		$this->view( 'teams/teams', $data );
	}

	/**
	 * Post
	 *
	 * http://localhost/posts/post/[$post_id]
	 */
	// public function post( $post_id = 0 ) : void
	// {
	// 	$this->model( 'PostsModel' );

	// 	$post = $this->PostsModel->readPost( ( int )$post_id );

	// 	$data = array(
	// 		'title' => $post['post_title'] ?? '',
	// 		'post'  => $post,
	// 	);

	// 	$this->view( 'posts/post', $data );
	// }

	/**
	 * Add
	 *
	 * http://localhost/teams/add
	 */
	public function add() : void
	{
		$this->model( 'TeamsModel' );

		if ( isset( $_POST['post-add'] ) ) {
			try {
				$this->TeamsModel->addTeam( array(
					'name'   => $_POST['name'],
					'city'  => $_POST['city'],
					'sport'  => $_POST['sport'],
					'foundation_date'  => $_POST['foundation_date'] ?? new DateTime('now'),
				) );
			} catch ( ValidationException $e ) {
				$errors = $e->getError();
			}
		}

		$data = array(
			'title'  => 'Add Post',
			'errors' => $errors,
		);

		$this->view( 'teams/add', $data );
	}

	/**
	 * Edit
	 *
	 * http://localhost/teams/edit/[$team_id]
	 */
	public function edit($id = 0) : void
	{
		$this->model('TeamsModel');

		$team = $this->TeamsModel->getTeam(( int )$id);

		if (isset($_POST['team-edit'])) {
			try {
				$this->TeamsModel->editTeam(array(
					'id'              => ( int )$id,
					'name'            => $_POST['name'],
					'city'            => $_POST['city'],
					'sport'           => $_POST['sport'],
					'foundation_date' => $_POST['foundation_date'],
				) );
			} catch ( ValidationException $e ) {
				$errors = $e->getError();
			}
		}

		$data = array(
			'title'  => 'Edit ' . $team['post_title'],
			'team'   => $team,
			'errors' => $errors,
		);

		$this->view( 'teams/edit', $data );
	}

	/**
	 * Delete
	 *
	 * http://localhost/teams/delete/[$post_id]
	 */
	public function delete( $id = 0 ) : void
	{
		$this->model( 'TeamsModel' );

		$this->TeamsModel->deleteTeam( ( int )$id );
	}

}

class_alias( 'TeamsController', 'Teams' );
