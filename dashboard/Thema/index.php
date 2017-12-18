<?php
session_start();
include '../include/framework.php';

if (!isset($_SESSION["email"])) {
    header("Location: ../login.php"); //Redirecting to login.php
    exit();
}

if (isset($_POST["logout"])) {
    session_destroy(); //Removing the login session

    header("Location: ../login.php"); //Redirecting to login.php
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Thema's</title>
        <link rel="stylesheet" type="text/css" href="../../css/style.css">
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    </head>
    <body>
        <!-- Tabs bovenin niet maken -->
        <?php include '../include/navbar.php'; ?>
        <img src="../../img/dotsolutions-logo.png" alt="dotsolutions logo" class="img-fluid dotsolutions_logo">

        <!-- Modal for logging out -->
        <div class="modal fade" id="modal-logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Uitloggen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Weet jij zeker dat je wilt uitloggen?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form method="POST">
                            <input type="submit" name="logout" class="btn btn-success" value="Uitloggen">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="../../js/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/script.js"></script>
        <!-- Alles wat hierboven staat is ok. Nu de rest programmeren. -->
        <section id="dashboard-content" class="container-fluid">
            <h1>Thema's</h1>
            <!--<div class="container">
                <div class="row">
                    <div class="col-sm">
                        Thema
                    </div>
                    <div class="col-sm">
                        Actief vanaf
                    </div>
                    <div class="col-sm">
                        Actief tot
                    </div>
                    <div class="col-sm">
                        Afbeelding
                    </div>
                    <div class="col-sm">
                        Standaard
                    </div>
                    <div class="col-sm">
                        Gemaakt door
                    </div>
                </div>
            </div>-->
            <div class="container-fluid" style="border:1px solid #cecece;">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-custom" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Thema</th>
                                    <th>Actief vanaf</th>
                                    <th>Actief tot</th>
                                    <th>Afbeelding</th>
                                    <th>Standaard</th>
                                    <th>Gemaakt door</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>

                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>

                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row">
                <button type="submit" class="btn btn-default" name="submit" >Toevoegen</button>
            </div>
        </div>
</body>
</html>
