<div class="container">
    <div class="col-12">
         <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="m-0">Employee List</h1>
        <a href="<?= site_url('employees/create') ?>" class="btn btn-primary">Add Employee</a>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
             <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="checkAll"></th>
                        <th></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td class="checkbox">
                                <input type="checkbox" class="checkItem" value="<?php echo $employee->id; ?>">
                            </td>
                            <td>
                                <a target="_blank"
                                    href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= $employee->id ?>"><img
                                        src="https://api.qrserver.com/v1/create-qr-code/?size=50x50&data=<?= $employee->id ?>"
                                        alt=""></a>
                            </td>
                            <td>
                                <?= $employee->id ?>
                            </td>
                            <td>
                                <?= $employee->first_name . ' ' . $employee->last_name ?>
                            </td>
                            <td>
                                <?= $employee->created_by_name ?>
                            </td>
                            <td>
                                <!-- Edit button -->
                                <a href="<?= site_url('employees/edit/' . $employee->id) ?>" class="btn btn-sm btn-warning">Edit</a>

                                <!-- Delete button -->
                                <form action="<?= site_url('employees/delete/' . $employee->id) ?>" method="POST" class="d-inline">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
   
    <div class="text-start mt-3">
        <a href="#" class="btn btn-danger" id="deleteSelected">Delete Selected</a>
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
                selected.push($(this).val());
            });

            if (selected.length > 0) {
                var confirmDelete = confirm('Are you sure you want to delete the selected users?');

                if (confirmDelete) {
                    var url = '<?php echo base_url("employees/delete_multiple"); ?>';
                    var data = { ids: selected };

                    $.post(url, data, function (response) {
                        console.log(response)
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



<script>
    $(document).ready(function () {
        $('table').DataTable();
    })
</script>