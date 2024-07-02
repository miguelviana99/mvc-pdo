<?php
/**
 * Teams View
 */
include_once(__DIR__ . DS . '..' . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Site.php');
include_once(__DIR__ . DS . '..' . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Time.php');

?>

<section class="card mt-3 mb-3">
	<div class="card-body">
		<h1 class="card-title">Teams</h1>

		<div class="mb-3">
			<a href="/teams/add" class="btn btn-primary">Add Team</a>
		</div>

		<?php if ( ! empty( $teams ) ) : ?>
		<table class="table table-striped mb-0">
			<thead>
				<tr>
					<th>Name</th>
					<th>City</a></th>
					<th>Sport</a></th>
					<th>Foundation</a></th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ( $teams as $team ) : ?>
				<tr>
					<td>
					    <?php if ($team['name']) : ?>
                            <div class="mb-2">
                                <?= $team['name']; ?>
                            </div>    
                            <a href="/teams/edit/<?= $team['id']; ?>" class="btn btn-light btn-sm">Edit</a>
                            <a href="/teams/delete/<?= $team['id']; ?>" class="btn btn-light btn-sm" onclick="return confirm( 'Are you want to DELETE <?= $team['name']; ?>?' );">Delete</a>
                            <a href="/teams/viewItem/<?= $team['id']; ?>" class="btn btn-light btn-sm">View</a>
                        <?php endif; ?>
                    </td>
                    <td>
					    <?php if ($team['city']) : ?>
                            <?= $team['city']; ?>
                        <?php endif; ?>
                    </td>
					<td>
					    <?php if ($team['sport']) : ?>
                            <?= $team['sport']; ?>
                        <?php endif; ?>
                    </td>
                    <td>
					    <?php if ($team['foundation_date']) : ?>
                            <time datetime="<?= Time::get( $team['foundation_date'], $team['foundation_date'], 'c' ); ?>">
							    <?= Time::get( $team['foundation_date'], $team['foundation_date'], 'Y-m-d H:i' ); ?>
						    </time>
                        <?php endif; ?>
                    </td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?php Site::pagination( $pagination ); ?>

		<?php else : ?>
		<div class="alert alert-warning mb-0">Empty.</div>
		<?php endif; ?>
	</div>
</section>
