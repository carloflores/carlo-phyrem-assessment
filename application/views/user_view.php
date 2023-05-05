<div class="container my-5">
	<h1>User View</h1>
	<div class="row mt-5">
		<div class="col-md-6">
			<table class="table">
				<tbody>
					<tr>
						<th>User Name</th>
						<td>
							<?= $user['user_name'] ?>
						</td>
					</tr>
					<tr>
						<th>User Type</th>
						<td>
							<?= $user['user_type'] ?>
						</td>
					</tr>
					<tr>
						<th>Date Added</th>
						<td>
							<?= $user['datetime_added'] ?>
						</td>
					</tr>
					<tr>
						<th>Date Modified</th>
						<td>
							<?= $user['datetime_modified'] ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>