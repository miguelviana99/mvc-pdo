<?php
/**
 * view page
 */
include_once(__DIR__ . DS . '..' . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Time.php');

?>

<section class="card mt-3 mb-3">
	<div class="card-body">
        <a href="/teams" class="btn btn-link btn-sm">< Go back to list</a>
		<?php if ( ! empty( $team ) ) : ?>
            <h1 class="card-title">Team <?= $team['name']; ?></h1>

            <h3>City :  <?= $team['city']; ?></h3>
            <h3>Sport :  <?= $team['sport']; ?></h3>
            <h3>Foundation Date :  <?= Time::get( $team['foundation_date'], $team['foundation_date'], 'm/d/Y' ); ?></h3>

            <section class="card mt-3 mb-3">
                <div class="card-body">
                    <h1 class="card-title">Players</h1>
                    <div class="mb-3">
                        <a href="/players" class="btn btn-link btn-sm">< View All players List</a>
                    </div>
                    <?php if ( ! empty( $players ) ) : ?>
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Number</a></th>
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
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <div class="alert alert-warning mb-0">Empty.</div>
                    <?php endif; ?>
                </div>
            </section>
		<?php else : ?>
		<div class="alert alert-warning mb-0">Empty</div>
		<?php endif; ?>
	</div>
</section>
