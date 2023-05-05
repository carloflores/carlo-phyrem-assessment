<?php if ($this->session->has_userdata('user')): ?>
    <header>
        <div class="d-block d-sm-block d-md-none">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6"><h3 class="fw-bold m-0">DTR</h3></div>
                    <div class="col-6 text-end">
                        <button class="btn btn-secondary btn-sm mobile-trigger">Menu</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-content">
            <div class="text-center d-flex d-sm-flex d-md-block align-items-center justify-content-between">
                <h1 class="fw-bold display-1">DTR</h1>
                <button class="btn btn-secondary btn-sm mobile-trigger d-block d-sm-block d-md-none">Close</button>
            </div>

            <p class="small m-0 text-muted mt-4 mb-1">Main Menu</p>
            <ul class="list-group">

                <li class="list-group-item <?= uri_string() == 'dashboard/scan' ? 'active' : '' ?>">
                    <a href="<?= base_url('/dashboard/scan') ?>">Scan QR Code</a>
                </li>
                
                <li class="list-group-item <?= uri_string() == 'dashboard' ? 'active' : '' ?>">
                    <a href="<?= base_url('/dashboard') ?>">Time Records</a>
                </li>
                <li class="list-group-item <?= uri_string() == 'employees' ? 'active' : '' ?>">
                    <a href="<?= base_url('/employees') ?>">Employees</a>
                </li>
                <?php if ($this->session->userdata('user')->user_type == 1): ?>
                    <li class="list-group-item <?= uri_string() == 'users' ? 'active' : '' ?>">
                        <a href="<?= base_url('/users') ?>">Users</a>
                    </li>
                <?php endif; ?>

                <li class="list-group-item">
                    <a href="<?= base_url('/login/logout') ?>">Logout</a>
                </li>
            </ul>


            <p class="small m-0 text-muted mt-4 mb-1">You</p>
            <ul class="list-group">
                <li
                    class="list-group-item <?= uri_string() == 'users/update/' . $this->session->userdata('user')->id ? 'active' : '' ?>">
                    <a class="text-capitalize" href="<?= base_url('/users/update/' . $this->session->userdata('user')->id) ?>">
                        <?= $this->session->userdata('user')->user_name ?>
                    </a>
                </li>
            </ul>
        </div>
    </header>
<?php endif; ?>

<script>
    $('.mobile-trigger').click(() => {
        $('.header-content').toggleClass('active')
    })
</script>

<main>

