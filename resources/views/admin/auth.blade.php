<!DOCTYPE html>
<html>

<head>
    <title>REGISTRATION FORM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
    <script src="https://kit.fontawesome.com/be494ca550.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="login-form-container">
        <div class="container py-5">
            <div class="row py-5">
                <div id="login-form-container" class="col-sm-6 my-5 mx-auto">
                    <h2 class="themeHeading h2">LOGIN</h2>
                    <form id="login-form" class="needs-validation validation-form" method="POST">
                        <div id="msg"></div>
                        <div class="form-group my-2">
                            <div class="row">
                                <div id="loginID-field" class="validation-form-field col-12 my-1">
                                    <input type="text" class="w-100 form-control" id="loginID" name="loginID"
                                        placeholder="Login ID" />
                                </div>
                                <div id="password-field" class="validation-form-field col-12 my-1">
                                    <input type="password" class="w-100 form-control" id="password" name="password"
                                        placeholder="Password" />
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="login-btn" class="shadow btn btn-blue-tinted w-100">
                            LOGIN
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>

    <script src="/scripts/js/form.js"></script>
    <script src="/scripts/js/auth.js"></script>
    <script src="/scripts/js/geography.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
        </script>

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</body>

</html>
