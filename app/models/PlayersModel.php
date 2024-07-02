<?php
/**
 * Players Model
 */
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'classes' . DS . 'Model.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'classes' . DS . 'Sql.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Site.php';
require_once __DIR__ . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Str.php';

class PlayersModel extends Model
{

	/**
	 * Get Players
	 */
	public function getPlayers(int $teamId) : array
	{
		$sql = Sql::query()
			->select('*')
			->from('players')
            ->innerJoin('teams')
            ->on( 'players.team_id = teams.id' )
            ->where('teams.id = :id')
			->get();

        $data = array(
            'id' => $teamId,
        );

		$stmt = $this->db->prepare($sql);
        $this->bind( $stmt, $data );
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Get All Players
	 */
    public function getAllPlayers( array $pagination, array $sort ) : array
	{
		$sql = Sql::query()
			->select( '*' )
			->from( 'players' )
			->orderBy( $sort['by'] . ' ' . $sort['order'] )
			->limit( $pagination['start'] . ', ' . $pagination['perpage'] )
			->get();

		$stmt = $this->db->prepare( $sql );
		$stmt->execute();

		return $stmt->fetchAll( PDO::FETCH_ASSOC );
	}

    /**
	 * Get Player
	 */
    public function getPlayer( int $playerId ) : array
	{
		$sql = Sql::query()
			->select( '*' )
			->from( 'players' )
            ->where('id = :id')
			->get();

        $data = array(
            'id' => ( int )$playerId,
        );

        $stmt = $this->db->prepare($sql);
        $this->bind( $stmt, $data );
        $stmt->execute();

		return $stmt->fetchAll( PDO::FETCH_ASSOC );
	}

	/**
	 * Add Player
	 */
	public function addPlayer(array $player) : void
	{
		Str::validate($player['name']);
		Str::validate($player['number']);


		$sql = Sql::query()
			->insertInto( 'players ( name, number, team_id )' )
			->values( '( :name, :number, :team_id )' )
			->get();

		$data = array(
			'name'       => Str::clean($player['name']),
			'number'     => Str::clean($player['number']),
			'team_id' => $player['team_id'] ?? NULL,
		);

		$stmt = $this->db->prepare( $sql );
		$this->bind( $stmt, $data );
		$stmt->execute();

		Site::redirect('/players');
	}

	/**
	 * Edit players
	 */
	public function editPlayer(array $player) : void
	{
		Str::validate($player['name']);
		Str::validate($player['number']);


		$sql = Sql::query()
			->update( 'players' )
			->set( 'name = :name, number = :number, team_id = :team_id' )
			->where( 'id = :id' )
			->get();

		$data = array(
			'id'    => $player['id'],
			'name'  => Str::clean($player['name']),
			'city'  => Str::clean($player['number']),
			'team_id' => $player['team_id'],
		);

		$stmt = $this->db->prepare( $sql );
		$this->bind( $stmt, $data );
		$stmt->execute();

		Site::redirect( '/players' );
	}

	/**
	 * Delete Player
	 */
	public function deletePlayer( int $id ) : void
	{
		$sql = Sql::query()
			->delete()
			->from( 'players' )
			->where( 'id = :id' )
			->get();

		$data = array(
			'id' => $id,
		);

		$stmt = $this->db->prepare( $sql );
		$this->bind( $stmt, $data );
		$stmt->execute();

		Site::redirect( '/players' );
	}

}
