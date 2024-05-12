<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="../bootstrap-5.0.2-dist/bootstrap-5.0.2-dist//css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/Car-Dealership/style/registration.css" rel="stylesheet">
    <title>Lab2 - Sign up</title>
</head>

<body class="">
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
                                <form id="myForm" method="POST" action="Username.php">
                                    <div class="formHolder">
                                        <div class="mb-3">
                                            <div class="form-text-up fs-4">Create an account</div>
                                            <div class="form-text-up fs-5">Join Our Family</div>
                                        </div>
                                        <div class="mb-3">
                                            <input placeholder="Email address" type="email" name="email"
                                                class="form-control" id="InputEmail" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <div id="exists" class="form-text text-danger visually-hidden">Email Already
                                                Exists</div>
                                        </div>
                                        <div class="mb-3">
                                            <div id="emailFormat" class="form-text text-danger visually-hidden">Wrong
                                                Email Format</div>
                                        </div>
                                        <div class="mb-3">
                                            <div id="emptyEmail" class="form-text text-danger visually-hidden">Empty
                                                Field</div>
                                        </div>
                                        <div class="mb-3">
                                            <input placeholder="First Name" type="text" name="fname"
                                                class="form-control" id="Inputfname" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <input placeholder="Last Name" type="text" name="lname" class="form-control"
                                                id="Inputlname" aria-describedby="emailHelp">
                                        </div>
                                        <div class="d-grid gap-2 col-12 mx-auto">
                                            <input class="btn btn-primary" id="submit" type="submit"
                                                value="Next"></input>
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
            </div>
            <div class="col"></div>
        </div>
    </div>
    <script src="http://localhost/Car-Dealership/js/email.js"></script>
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

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>