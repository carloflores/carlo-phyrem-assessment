<!-- Include Instascan library -->
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>


<div class="container">
    <div class="row justify-content-center align-items-center flex-column">
        <div class="col-md-8 text-center">
            <h1>Scan QR Code</h1>
            <p>Hold your phone steady and position the QR code in the center of the screen.</p>
        </div>
        <div class="row justify-content-center align-items-center mt-4 p-0">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-4 text-center">
                <video id="scanner-container" style="height: 100%; width: 100%;"></video>
            </div>
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-4 h-100">
                <h3 class="mb-3">Latest<br />Employee Scanned</h3>
                <div class="card h-100">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name: <span id="name"></span></li>
                            <li class="list-group-item">Time In: <span id="in"></span></li>
                            <li class="list-group-item">Time Out: <span id="out"></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-8 mt-4">
           <div class="card">
            <div class="card-body table-responsive">
                 <table id="time_records" class="display">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Entered By</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                        </tr>
                    </thead>
                </table>
            </div>
           </div>
        </div>
    </div>


</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    try {
        var table = $('#time_records').DataTable({
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
                { "data": "time_in" },
                { "data": "time_out" }
            ]
        });

        let scanner = new Instascan.Scanner({
            continuous: true,
            video: document.getElementById('scanner-container'),
        });

        scanner.addListener('scan', function (content) {
            jQuery.post('<?= base_url('/dashboard/scan_qr/') ?>' + content, (data, status) => {

                if (data.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Unsuccessful Scan',
                        text: 'QR Code invalid',
                    })

                    return;
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Successfully Scanned',
                    text: 'Time has been recorded',
                })


                $('#name').text(data.first_name + ' ' + data.last_name)
                $('#in').text(data.date_added + ' ' + data.time_in)

                if (data.time_out != null) {
                    $('#out').text(data.date_added + ' ' + data.time_out)
                }

                table.ajax.reload();
            })
        });

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found.');
            }
        }).catch(function (e) {
            alert('Error: ' + e);
        });
    } catch (e) {

    }
</script>