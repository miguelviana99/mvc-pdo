<?php
/**
 * Players Controller
 */
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'classes' . DS . 'Controller.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'classes' . DS . 'Model.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Site.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Str.php';

class PlayersController extends Controller
{

	/**
	 * Index
	 *
	 * http://localhost/players
	 */
	public function index() : void
	{
		$this->model('PlayersModel');

		$pagination = $this->PlayersModel->pagination( 'players', ( int )$_GET['page'], 5 );
		$sort       = $this->PlayersModel->sort( '', '', []);

		$players = $this->PlayersModel->getAllPlayers( $pagination, $sort );

		$data = array(
			'title'      => 'Players',
			'players'      => $players,
			'pagination' => $pagination,
		);

		$this->view( 'players/players', $data );
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
	 * http://localhost/players/add
	 */
	public function add() : void
	{
		$this->model( 'PlayersModel' );

		if ( isset( $_POST['player-add'] ) ) {
			try {
				$this->PlayersModel->addPlayer( array(
					'name'   => $_POST['name'],
					'number'  => ( int )$_POST['number'],
					'team_id'  => ( int )$_POST['team_id'],
				) );
			} catch ( ValidationException $e ) {
				$errors = $e->getError();
			}
		}

		$data = array(
			'title'  => 'Add Players',
			'errors' => $errors,
		);

		$this->view( 'players/add', $data );
	}

	/**
	 * Edit
	 *
	 * http://localhost/players/edit/[$player_id]
	 */
	public function edit($id = 0) : void
	{

		$this->model('PlayersModel');

		$player = $this->PlayersModel->getPlayer(( int )$id);

		if (isset($_POST['player-edit'])) {
			try {
				$this->PlayersModel->editPlayer(array(
					'name'    => $_POST['name'],
					'number'  => $_POST['number'],
					'team_id' => $_POST['team_id'],
				) );
			} catch ( ValidationException $e ) {
				$errors = $e->getError();
			}
		}

		$data = array(
			'player'   => $player,
			'errors' => $errors,
		);

		$this->view( 'players/edit', $data );
	}

	/**
	 * Delete
	 *
	 * http://localhost/players/delete/[$id]
	 */
	public function delete( $id = 0 ) : void
	{
		$this->model( 'PlayersModel' );

		$this->PlayersModel->deletePlayer( ( int )$id );
	}

	/**
	 * View
	 *
	 * http://localhost/teams/viewItem/[$post_id]
	 */
	public function viewItem($id = 0) : void
	{
		$this->model( 'TeamsModel' );
        $team = $this->TeamsModel->getTeam(( int )$id);

        $this->model( 'PlayersModel' );
        $players = $this->PlayersModel->getPlayers(( int )$team['id']);

        $data = array(
			'team'   => $team,
            'players' => $players
		);

		$this->view('teams/item', $data);
	}
}

class_alias( 'PlayersController', 'Players' );
