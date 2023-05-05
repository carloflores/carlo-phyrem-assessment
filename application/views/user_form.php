<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-3">
                        <?= isset($user) ? 'Update' : 'Add' ?> User
                    </h1>
                    <form method="POST"
                        action="<?php echo site_url("users/" . (isset($user) ? 'update/' . $user['id'] : 'create')); ?>">
                        <input type="hidden" name="user_id"
                            value="<?php echo isset($user['id']) ? $user['id'] : ''; ?>">
                        <div class="mb-3">
                            <label for="user_name" class="form-label">Username</label>
                            <input type="text" class="form-control" id="user_name" name="user_name"
                                value="<?php echo isset($user['user_name']) ? $user['user_name'] : ''; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="user_password" class="form-label">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="user_password" name="user_password"
                                    <?php if (!isset($user['id'])) {
                                        echo 'required';
                                    } ?> placeholder="Password"
                                    aria-label="Password" aria-describedby="show-password-button">
                                <button class="btn btn-outline-secondary" type="button"
                                    id="show-password-button">Show</button>
                                <button class="btn btn-outline-secondary" type="button"
                                    id="generate-password-button">Generate</button>
                            </div>
                            <div class="password-error text-danger"></div>

                        </div>
                        <div class="mb-3">
                            <label for="user_type" class="form-label">User Type</label>
                            <select class="form-select" id="user_type" name="user_type" required>
                                <option value="1" <?php if (isset($user['user_type']) && $user['user_type'] == 1) {
                                    echo 'selected';
                                } ?>>Super Admin</option>
                                <option value="2" <?php if (isset($user['user_type']) && $user['user_type'] == 2) {
                                    echo 'selected';
                                } ?>>Admin</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary">
                                <?php echo isset($user['id']) ? 'Update' : 'Save'; ?>
                            </button>
                            <a href="<?php echo site_url('users'); ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(($) => {
        $('form').on('submit', (e) => {
            console.log(e)
            var password = $('#user_password').val();
            var passwordChecher = password == '' ? [] : checkPasswordStr(password);
            console.log(passwordChecher)
            $('.password-error').html('')
            if (passwordChecher.length > 0) {

                passwordChecher.map(v => {
                    $('.password-error').append(`<p class="small m-0">Password ${v}</p>`)
                })

                e.preventDefault();
                return false;
            }

            return true
        })

        $("#show-password-button").click(function () {
            var passwordInput = $("#user_password");
            console.log(passwordInput.attr("type"))
            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                $(this).html("Hide");
            } else {
                passwordInput.attr("type", "password");
                $(this).html("Show");
            }
        });

        // Generate password
        $("#generate-password-button").click(function () {
            $("#user_password").val(generatePassword());
        });


        function checkPasswordStr(password) {
            var checker = [];

            if (password.length < 10) {
                checker.push('too short');
            }

            if (!/\d/.test(password)) {
                checker.push('must contain a digit');
            }

            if (!/[a-z]/.test(password)) {
                checker.push('must contain lowercase letter');
            }

            if (!/[A-Z]/.test(password)) {
                checker.push('must contain uppercase letter');
            }

            if (!/[^\w\d]/.test(password)) {
                checker.push('must contain a symbol');
            }

            return checker;
        }

        function generatePassword() {
            var length = 10,
                charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+~`|}{[]:;?><,./-=";

            var password = "";
            for (var i = 0, n = charset.length; i < length; ++i) {
                password += charset.charAt(Math.floor(Math.random() * n));
            }

            if (!password.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+~`|}{[\]:;"'<,>.?/\\-]).{10,}$/)) {
                return generatePassword();
            }

            return password;
        }
    })
</script>