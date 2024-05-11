<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap-grid.min.css" rel="stylesheet" />
    <link href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist//css/bootstrap.min.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
    <title>Lab2 - Sign up</title>
</head>

<body class="">
    <?php
    $email = $_POST["email"];
    $username = $_POST["username"];
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
                                <img src="https://placehold.co/110x110" class="img-fluid signInImg" />
                            </div>
                            <div class="col"></div>
                        </div>

                        <div class="row">
                            <div class="col"></div>
                            <div class="col-6">
                                <form id="myForm" method="POST" action="../Result/result2.php">
                                    <div class="formHolder">
                                        <div class="mb-3">
                                            <div class="form-text-up fs-4">Create an account</div>
                                            <div class="form-text-up fs-5">Join Our Family</div>
                                        </div>
                                        <div id="passwordsField">
                                            <div class="mb-3">
                                                <input placeholder="Password" type="password" class="form-control"
                                                    name="password" id="InputPassword1">
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="email"
                                                    value="<?php echo htmlspecialchars($email); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="username"
                                                    value="<?php echo htmlspecialchars($username); ?>">
                                            </div>
                                            <div id="passwordEmpty"
                                                class="form-text text-danger visually-hidden my-md-3">
                                                Empty Field
                                            </div>
                                            <div class="mb-3">
                                                <input placeholder="Confirm" type="password" class="form-control"
                                                    id="InputPassword2">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div id="passwordEmpty2" class="form-text text-danger visually-hidden">
                                                Empty Field
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div id="match" class="form-text text-danger visually-hidden">
                                                Those passwords didn’t match. Try again
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 col-12 mx-auto">
                                            <input class="btn btn-primary" id="submit" type="submit"
                                                value="Create Account"></input>
                                        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="JJSS/password.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>