<?php
/**
 * Edit
 */
include_once(__DIR__ . DS . '..' . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Errors.php')

?>

<section class="card mt-3 mb-3">
	<div class="card-body">
        <a href="/players" class="btn btn-link btn-sm">< Go back to list</a>
		<?php if ( ! empty( $player ) ) : ?>
            <h1 class="card-title">Edit Player</h1>

            <?php Errors::get( $errors ); ?>

            <form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="name">Name <span style="color:#f00">*</span></label>
				<input type="text" name="name" id="name" class="form-control" max="255" value="<?= $player['name']; ?>" required>
			</div>

			<div class="form-group">
				<label for="number">Number</label>
				<input type="number" name="number" id="number" class="form-control" value="<?= $player['numer']; ?>"></input>
			</div>

            <div class="form-group">
				<label for="team_id">Team ID</label>
				<input type="team_id" name="team_id" id="team_id" class="form-control" value="<?= $player['team_id']; ?>"></input>
			</div>
                <button type="submit" name="player-edit" class="btn btn-primary">Edit</button>
                <a href="/players" class="btn btn-light">Cancel</a>
            </form>
		<?php else : ?>
		<div class="alert alert-warning mb-0">Empty</div>
		<?php endif; ?>
	</div>
</section>
