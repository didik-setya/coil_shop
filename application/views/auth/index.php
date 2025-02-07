<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Admin Login</title>
</head>

<body style="background-color: #ededed;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="card" style="margin-top: 20vh;">
                    <div class="card-header text-center bg-dark text-light">
                        <h5>Login Page</h5>
                    </div>
                    <?= form_open('verify_login_admin') ?>
                    <div class="card-body my-2">
                        <div class="form-group">
                            <input type="text" name="email" id="email" placeholder="Email.." required
                                class="form-control">
                            <small class="text-danger" id="err_email"></small>
                        </div>
                        <div class="form-group my-2">
                            <input type="password" name="password" id="password" placeholder="Password.." required
                                class="form-control">
                            <small class="text-danger" id="err_password"></small>
                        </div>
                        <button class="btn btn-sm btn-primary w-100 mt-3" type="submit">Login</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(Document).ready(function() {
        $('form').submit(function(e) {
            e.preventDefault()
            loading_animation()

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(response) {
                    setTimeout(() => {
                        Swal.close()
                        if (response.type == 'validation') {
                            if (response.err_email) {
                                $('#err_email').html(response.err_email)
                            } else {
                                $('#err_email').html('')
                            }

                            if (response.err_password) {
                                $('#err_password').html(response.err_password)
                            } else {
                                $('#err_password').html('')
                            }
                            regenerate_token(response.token)

                        } else if (response.type == 'result') {
                            $('#err_password').html('')
                            $('#err_email').html('')
                            if (response.status == true) {
                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',
                                }).then(() => {
                                    window.location.href = response.redirect
                                })
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: response.message,
                                    icon: 'error',
                                })
                                regenerate_token(response.token)
                            }
                        }
                    }, 200);
                },
                error: function(xhr, status, error) {
                    setTimeout(() => {
                        Swal.close()
                        Swal.fire({
                            title: 'Error',
                            text: xhr.responseText,
                            icon: 'error',
                        })
                    }, 200);
                }
            })
        })
    })

    function loading_animation() {
        Swal.fire({
            title: 'Loading..',
            html: 'Please wait..',
            timerProgressBar: true,
            draggable: true,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            },
        })
    }

    function regenerate_token(token) {
        const c_name = '<?= $this->security->get_csrf_token_name() ?>'
        $('input[name="' + c_name + '"]').val(token)
    }
    </script>

</body>

</html>