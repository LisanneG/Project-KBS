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
        <link rel="stylesheet" type="text/css" href="/Project-KBS-master/css/style.css">
        <link rel="stylesheet" type="text/css" href="/Project-KBS-master/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/Project-KBS-master/dashboard/Thema/hulp.css">
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

        <script type="text/javascript" src="../../js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/script.js"></script>
        <script type="text/javascript" src="hulp.js"></script>
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
                        <table class="table table-custom" id="theme-table" >
                            <thead>
                                <tr class="font-bold-weight">
                                    <th>#</th>
                                    <th>Naam</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'hulp.php';
                                getThema();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid ">
            <div class="row">
                <button type="submit" class="btn btn-default"  data-toggle="modal" data-target="#toevoegen">Toevoegen</button>
                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#verwijderen">Verwijderen</button>
            </div>
        </div>



        <div class="modal fade" id="toevoegen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addmenu">Toevoegen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="newthemename">Naam</label>
                                <input type="text" class="form-control" id="newthemename" placeholder="Naam">
                            </div>


                        </form>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" method="post" type="submit">Opslaan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="verwijderen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="remove-title">Verwijderen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h7 class="font-weight-bold">Weet u zeker dat u deze items wilt verwijderen?</h7>
                        <br>
                        <h8 id="selected-items" class="pt-5"></h8>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" type="submit" method="post">Ja</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nee</button>
                    </div>
                </div>
            </div>
        </div>




</body>
</html>
