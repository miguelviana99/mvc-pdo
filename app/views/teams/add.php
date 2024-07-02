<?php
/**
 * Add
 */
include_once(__DIR__ . DS . '..' . DS . '..' . DS . '..' . DS . 'core' . DS . 'helpers' . DS . 'Errors.php')
?>

<section class="card mt-3 mb-3">
	<div class="card-body">
		<h1 class="card-title">Add Team</h1>

		<?php Errors::get( $errors ); ?>

		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="name">Name <span style="color:#f00">*</span></label>
				<input type="text" name="name" id="name" class="form-control" max="255" required>
			</div>

			<div class="form-group">
				<label for="city">City</label>
				<input type="text" name="city" id="city" class="form-control"></input>
			</div>

            <div class="form-group">
				<label for="sport">Sport</label>
				<select name="sport" id="sport">
                    <option value="Football" selected>Footbal</option>
                    <option value="Basketball">Basketball</option>
                    <option value="Badminton">Badminton</option>
                    <option value="Other">Other</option>
                </select>
			</div>

            <div class="form-group">
				<label for="foundation_date">Foundation day</label>
				<input type="date" name="foundation_date" id="foundation_date" value="<?php date('Y-m-d') ?>" class="form-control"></input>
			</div>
			<button type="submit" name="post-add" class="btn btn-primary">Add</button>
			<a href="/" class="btn btn-light">Cancel</a>
		</form>
	</div>
</section>
