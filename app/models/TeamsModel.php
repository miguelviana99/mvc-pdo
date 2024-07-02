<?php
/**
 * Teams Model
 */
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'classes' . DS . 'Model.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'classes' . DS . 'Sql.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Site.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'File.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Str.php';

class TeamsModel extends Model
{

	/**
	 * Get Teams
	 */
	public function getTeams(array $pagination, array $sort) : array
	{
		$sql = Sql::query()
			->select('*')
			->from('teams')
			->orderBy($sort['by'] . ' ' . $sort['order'])
			->limit($pagination['start'] . ', ' . $pagination['perpage'])
			->get();

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Read Post
	 */
	public function getTeam(int $post_id) : ?array
	{
		$sql = Sql::query()
			->select('*')
			->from('teams')
			->where('id = :id')
			->get();

		$data = array(
			'id' => $post_id,
		);

		$stmt = $this->db->prepare($sql);
		$this->bind($stmt, $data);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Add Team
	 */
	public function addTeam(array $team) : void
	{
		Str::validate($team['name']);
		Str::validate($team['city']);
		Str::validate($team['sport']);

		$name  = Str::clean($team['name']);
		$city  = Str::clean($team['city']);
		$sport = Str::clean($team['sport']);


		$sql = Sql::query()
			->insertInto( 'teams ( name, city, sport, foundation_date )' )
			->values( '( :name, :city, :sport, :foundation )' )
			->get();

		$data = array(
			'name'       => $name,
			'city'       => $city,
			'sport'      => $sport,
			'foundation' => $team['foundation_date'] ?? NULL,
		);

		$stmt = $this->db->prepare( $sql );
		$this->bind( $stmt, $data );
		$stmt->execute();

		Site::redirect('/');
	}

	/**
	 * Edit Team
	 */
	public function editTeam(array $team) : void
	{
		Str::validate($team['name']);
		Str::validate($team['city']);
		Str::validate($team['sport']);

		$sql = Sql::query()
			->update( 'teams' )
			->set( 'name = :name, city = :city, sport = :sport , foundation_date = :foundation_date' )
			->where( 'id = :id' )
			->get();

		$data = array(
			'id'    => $team['id'],
			'name'  => Str::clean($team['name']),
			'city'  => Str::clean($team['city']),
			'sport' => Str::clean($team['sport']),
			'foundation_date' => $team['foundation_date'],
		);

		$stmt = $this->db->prepare( $sql );
		$this->bind( $stmt, $data );
		$stmt->execute();

		Site::redirect( '/teams/edit/' . $team['id'] );
	}

	/**
	 * Delete Team
	 */
	public function deleteTeam( int $id ) : void
	{
		$sql = Sql::query()
			->delete()
			->from( 'teams' )
			->where( 'id = :id' )
			->get();

		$data = array(
			'id' => $id,
		);

		$stmt = $this->db->prepare( $sql );
		$this->bind( $stmt, $data );
		$stmt->execute();

		Site::redirect( '/' );
	}

}
