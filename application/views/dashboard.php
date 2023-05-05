<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="fw-bold mb-4">Employees' DTR</h1>
            <div class="card card-body table-responsive">
                <table id="time_records" class="display">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Entered By</th>
                            <th>Date Added</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#time_records').DataTable({
            "ajax": {
                "url": "<?php echo base_url('dashboard/get_time_records'); ?>",
                "type": "POST"
            },
            "columns": [
                { "data": "id" },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return row.first_name + ' ' + row.last_name;
                    }
                },
                { "data": "user_name" },
                { "data": "date_added" },
                { "data": "time_in" },
                { "data": "time_out" }
            ]
        });
    });
</script>