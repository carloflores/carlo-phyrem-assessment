<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <h1 class="fw-bold">
                        <?= isset($employee) ? 'Update' : 'Add' ?> Employee
                    </h1>
                    <?= isset($employee) ? 'Employee #' . $employee->id : '' ?>
                    <?php echo validation_errors(); ?>
                    <form class="mt-4"
                        action="<?php echo base_url('employees/' . (isset($employee) ? '/edit/' . $employee->id : 'create')); ?>"
                        method="post">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required
                                placeholder="Enter first name"
                                value="<?= isset($employee) ? $employee->first_name : '' ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required
                                placeholder="Enter last name"
                                value="<?= isset($employee) ? $employee->last_name : '' ?>">
                        </div>

                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>

                            <a href="<?php echo site_url('employees'); ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>