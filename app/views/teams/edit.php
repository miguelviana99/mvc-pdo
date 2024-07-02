<?php
/**
 * Edit
 *
 * @package CRUD MVC OOP PDO
 * @link    https://github.com/utoyvo/crud-mvc-oop-pdo/blob/master/app/views/posts/edit.php
 */
include_once(__DIR__ . DS . '..' . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Errors.php')

?>

<section class="card mt-3 mb-3">
	<div class="card-body">
        <a href="/teams" class="btn btn-link btn-sm">< Go back to list</a>
		<?php if ( ! empty( $team ) ) : ?>
            <h1 class="card-title">Edit Team</h1>

            <?php Errors::get( $errors ); ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name <span style="color:#f00">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" max="255" value="<?= $team['name']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="form-control" value="<?= $team['city']; ?>"></input>
                </div>

                <div class="form-group">
                    <label for="sport">Sport</label>
                    <select name="sport" id="sport">
                        <option value="Football" <?php if ($team['sport'] === 'Football') : ?> selected <?php endif; ?> >Footbal</option>
                        <option value="Basketball" <?php if ($team['sport'] === 'Basketball') : ?> selected <?php endif; ?> >Basketball</option>
                        <option value="Badminton" <?php if ($team['sport'] === 'Badminton') : ?> selected <?php endif; ?> >Badminton</option>
                        <option value="Other" <?php if ($team['sport'] === 'Other') : ?> selected <?php endif; ?> >Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="foundation_date">Foundation day</label>
                    <input type="date" name="foundation_date" id="foundation_date" value="<?= $team['foundation_date']; ?>" class="form-control"></input>
                </div>
                <button type="submit" name="team-edit" class="btn btn-primary">Edit</button>
                <a href="/" class="btn btn-light">Cancel</a>
            </form>
		<?php else : ?>
		<div class="alert alert-warning mb-0">Empty</div>
		<?php endif; ?>
	</div>
</section>
