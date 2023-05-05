<div class="container">

	<div class="row">
		<div class="col-12">
			<div class="d-flex align-items-center justify-content-between mb-4">
				<h1>List of Users</h1>
				<a href="<?= base_url('users/create') ?>" class="btn btn-primary">Add New User</a>
			</div>
		</div>
		<div class="col-md-12">
			
			<div class="card">
				<div class="card-body table-responsive">
					<table class="table table-striped">
				<thead>
					<tr>
						<th><input type="checkbox" id="checkAll"></th>
						<th>#</th>
						<th>User Name</th>
						<th>User Type</th>
						<th>Date Added</th>
						<th>Date Modified</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($users)): ?>
						<?php foreach ($users as $user): ?>
							<tr>
								<td class="checkbox">
									<?php if ($user['id'] != $this->session->userdata('user')->id): ?>
										<input type="checkbox" class="checkItem" value="<?php echo $user['id']; ?>">
									<?php endif; ?>
								</td>
								<td>
									<?php echo $user['id']; ?>
								</td>
								<td>
									<?php echo $user['user_name']; ?>
								</td>
								<td>
									<?php echo ($user['user_type'] == 1) ? 'Super Admin' : 'Admin'; ?>
								</td>
								<td>
									<?php echo date('F j, Y g:i a', strtotime($user['datetime_added'])); ?>
								</td>
								<td>
									<?php echo $user['datetime_modified'] ? date('F j, Y g:i a', strtotime($user['datetime_modified'])) : ''; ?>
								</td>
								<td>
									<a href="<?php echo base_url('users/update/' . $user['id']); ?>"
										class="btn btn-primary btn-sm">Edit</a>
									<?php if ($user['id'] != $this->session->userdata('user')->id): ?>
										<a href="<?php echo base_url('users/delete/' . $user['id']); ?>"
											class="btn btn-danger btn-sm"
											onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="6">No users found.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
				</div>
			</div>


			<div class="text-start mt-3">
				<a href="#" class="btn btn-danger" id="deleteSelected">Delete Selected</a>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		var table = $('table').DataTable({
			columnDefs: [{
				targets: 0,
				orderable: false,
			}
			],
			responsive: true
		});
		// Check or uncheck all checkboxes
		$('#checkAll').change(function () {
			$('input:checkbox').not(this).prop('checked', this.checked);
		});

		table.on('draw', () => {
			$('#checkAll').parent('th:before').remove()
			$('#checkAll').parent('th:after').remove()
		})

		// Delete selected users
		$('#deleteSelected').click(function () {
			var selected = [];
			$('.checkItem:checked').each(function () {
				if ($(this).val() != '<?= $this->session->userdata('user')->id ?>') {
					selected.push($(this).val());
				}
			});

			if (selected.length > 0) {
				var confirmDelete = confirm('Are you sure you want to delete the selected users?');

				if (confirmDelete) {
					var url = '<?php echo base_url("users/delete_multiple"); ?>';
					var data = { ids: selected };

					$.post(url, data, function (response) {
                        if (response.success == true) {
							location.reload();
						} else {
							alert('Unable to delete selected users');
						}
					});
				}
			} else {
				alert('Please select at least one user to delete');
			}
		});
	});
</script>