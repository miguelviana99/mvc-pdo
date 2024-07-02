<?php
/**
 * view page
 */
?>

<section class="card mt-3 mb-3">
	<div class="card-body">
        <a href="/teams" class="btn btn-link btn-sm">< Go back to list</a>
		<?php if ( ! empty( $team ) ) : ?>
            <h1 class="card-title">TEAM <?= $team['name']; ?></h1>

            <h3>City :  <?= $team['city']; ?></h3>
            <h3>Sport :  <?= $team['sport']; ?></h3>
            <h3>Foundation Date :  <?= $team['foundation_date']; ?></h3>

		<?php else : ?>
		<div class="alert alert-warning mb-0">Empty</div>
		<?php endif; ?>
	</div>
</section>
