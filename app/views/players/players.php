<?php
/**
 * Players View
 */
include_once(__DIR__ . DS . '..' . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Site.php');
include_once(__DIR__ . DS . '..' . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Time.php');

?>

<section class="card mt-3 mb-3">
	<div class="card-body">
		<h1 class="card-title">Players</h1>

		<div class="mb-3">
			<a href="/players/add" class="btn btn-primary">Add Player</a>
		</div>

        <?php if ( ! empty( $players ) ) : ?>
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Team ID</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ( $players as $player ) : ?>
                    <tr>
                        <td>
                            <?php if ($player['name']) : ?>
                                <div class="mb-2">
                                    <?= $player['name']; ?>
                                </div>    
                                <a href="/players/edit/<?= $player['id']; ?>" class="btn btn-light btn-sm">Edit</a>
                                <a href="/players/delete/<?= $player['id']; ?>" class="btn btn-light btn-sm" onclick="return confirm( 'Are you want to DELETE <?= $player['name']; ?>?' );">Delete</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($player['number']) : ?>
                                <?= $player['number']; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($player['team_id']) : ?>
                                <?= $player['team_id']; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="alert alert-warning mb-0">Empty.</div>
        <?php endif; ?>
	</div>
</section>
