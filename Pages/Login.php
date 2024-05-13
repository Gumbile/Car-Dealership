<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist//css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/Car-Dealership/style/login.css" rel="stylesheet">
    <title>Lab2 - Login</title>
</head>

<body class="">
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p>{$_SESSION['message']}</p>";
        // Unset message after displaying it
        unset($_SESSION['message']);
    }
    ?>
    <div class="bg"></div>

    <div class="container signInPage">

        <div class="row">
            <div class="col"></div>
            <div class="col-sm-12 col-lg-6 col-md-8">
                <div class="card signInCard">
                    <div class="card-body">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-5">
                                <img src="https://placehold.co/110x110" class="img-fluid signInImg">
                            </div>
                            <div class="col"></div>
                        </div>



                        <div class="row">
                            <div class="col"></div>
                            <div class="col-6">
                                <form id="myForm" method="POST"
                                    action="http://localhost:8012/nour%20repo/Car-Dealership/pages/Result/result.php">
                                    <div class="formHolder">
                                        <div class="mb-3">
                                            <input placeholder="Email address" type="email" class="form-control"
                                                name="email" id="InputEmail" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <div id="emptyEmail" class="form-text text-danger visually-hidden">Empty
                                                Field</div>
                                        </div>
                                        <div class="mb-3 passwordEntry">
                                            <input placeholder="Password" type="password" class="form-control"
                                                name="password" id="InputPassword">
                                        </div>
                                        <div class="mb-3">
                                            <div id="emptyPassword" class="form-text text-danger visually-hidden">Empty
                                                Field</div>
                                        </div>
                                        <div class="mb-2 form-remember">
                                            <a href="#" class="link-sec link-primary">Forgot password?</a>
                                        </div>
                                        <div class="d-grid gap-2 col-12 mx-auto">
                                            <input class="btn btn-primary" id="submit" type="submit"
                                                value="Log In"></input>
                                        </div>
                                        <div class="mb-3 form-remember ">
                                            <input type="checkbox" class="form-check-input " id="exampleCheck1">
                                            <label class="text-secondary" for="rememberMe">Remember me</label>
                                        </div>
                                        <div id="emailHelp" class="form-text">We'll never share your email with anyone
                                            else.</div>
                                    </div>

                                </form>
                            </div>
                            <div class="col"></div>
                        </div>

                    </div>
                </div>
                <div class="form-signup"><a href="http://localhost/Car-Dealership/pages/Registration/Email.php"
                        class="link-primary formSignUp"> Create an
                        account</a></div>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="http://localhost/Car-Dealership/js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('message');
            if (message) {
                alert(message)

                urlParams.delete('message');

                const newUrl = window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');

                history.pushState({}, '', newUrl);
            }
        });
    </script>

</body>

</html>