<style>
	main {
		padding: 0 !important;
		margin: 0 !important;
	}
</style>

<div class="container">
	<div class="row justify-content-center vh-100 align-items-center">
		<div class="col-md-4">
			<div class="text-center">
				<h1 class="display-1 fw-bold m-0">DTR</h1>
				<p class="mt-0">Daily Time Record</p>
			</div>
			<div class="card">
				<div class="card-body">
					<?php if (isset($error)): ?>
						<div class="alert alert-danger">
							<?= $error ?>
						</div>
					<?php endif; ?>
					<form method="post" action="<?= base_url() ?>">
						<div class="form-group">
							<label for="username" class="form-label">Username</label>
							<input type="text" class="form-control" id="username" name="username" required>
						</div>
						<div class="form-group mt-4">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password" required>
						</div>
						<div class="d-grid mt-4">
							<button type="submit" class="btn btn-primary btn-block">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>