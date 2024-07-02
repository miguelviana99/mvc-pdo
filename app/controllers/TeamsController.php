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
	 * http://localhost/posts/edit/[$post_id]
	 */
	// public function edit( $post_id = 0 ) : void
	// {
	// 	$this->model( 'PostsModel' );

	// 	$post = $this->PostsModel->readPost( ( int )$post_id );

	// 	if ( ! User::author( ( int )$post['post_author'] ) && ! User::role( array( 'admin', 'editor' ) ) ) {
	// 		Site::redirect( '/' );
	// 	}

	// 	if ( isset( $_POST['post-edit'] ) ) {
	// 		try {
	// 			$this->PostsModel->editPost( array(
	// 				'id'      => ( int )$post_id,
	// 				'title'   => $_POST['post-title'],
	// 				'content' => $_POST['post-content'],
	// 				'cover'   => $_FILES['post-cover'],
	// 			) );
	// 		} catch ( ValidationException $e ) {
	// 			$errors = $e->getError();
	// 		}
	// 	}

	// 	$data = array(
	// 		'title'  => 'Edit ' . $post['post_title'],
	// 		'post'   => $post,
	// 		'errors' => $errors,
	// 	);

	// 	$this->view( 'posts/edit', $data );
	// }

	/**
	 * Delete
	 *
	 * http://localhost/posts/delete/[$post_id]
	 */
	// public function delete( $post_id = 0 ) : void
	// {
	// 	$this->model( 'PostsModel' );

	// 	$post = $this->PostsModel->readPost( ( int )$post_id );

	// 	if ( ! User::author( $post['post_author'] ) && ! User::role( array( 'admin' ) ) ) {
	// 		Site::redirect( '/' );
	// 	}

	// 	if ( ! empty( $post['post_cover'] ) ) {
	// 		File::delete( $post['post_cover'] );
	// 	}

	// 	$this->PostsModel->deletePost( ( int )$post_id );
	// }

}

class_alias( 'TeamsController', 'Teams' );
