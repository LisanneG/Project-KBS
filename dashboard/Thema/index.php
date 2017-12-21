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
        <link rel="stylesheet" type="text/css" href="../../dashboard/Thema/hulp.css">
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
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/script.js"></script>
        <script type="text/javascript" src="hulp.js"></script>
        <!-- Alles wat hierboven staat is ok. Nu de rest programmeren. -->
        <section id="dashboard-content" class="container-fluid">

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
            <h1>Thema's</h1>
            <div class="container-fluid" style="border:1px solid #cecece;">

                <div class="row">

                    <div class="table-responsive">
                        <table class="table table-custom" id="theme-table">
                            <thead>
                                <tr class="font-bold-weight">
                                    <th>Selecteren</th>
                                    <th>#</th>
                                    <th>Naam</th>
                                    <th>Afbeelding</th>
                                    <th>Wijzigen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                function getThema() {
                                    include '../../database.php';
                                
                                    $themequery = $conn->prepare("SELECT t.name as 'theme_name', theme_id, f.location as 'image' FROM theme t LEFT JOIN file f on t.background_file = f.file_id"); //SQL QUERY
                                    $themequery->execute();
                                    foreach ($themequery as $row) {
                                        print("<tr id='row-".$row["theme_id"]."'>");
                                        print("<td><input type='checkbox' id='checkboxid-". $row["theme_id"] ."'></td>");
                                        print("<td>" . $row["theme_id"] . "</td>");
                                        print("<td>" . $row["theme_name"] . "</td>");
                                        print("<td> <img class='img-fluid themeimage' src='" . $row["image"] . "'></img></td>");
                                        print("<td><button type='submit' class='btn btn-primary' id='edit-" . $row["theme_id"] . "'>Bijwerken</button></td>");
                                        print("</tr>");
                                    }
                                    //voor iedere rij in de tabel toon de tabelinhoud
                                }

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
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#toevoegen">Toevoegen</button>
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
                            <div class="form-group">
                                <!--<label for="newthemename">Naam</label>-->
                                <input type="text" class="form-control" id="newthemename" placeholder="Naam" name="name" form="form-add" required>
                                <input type="hidden" value="1" id="bool-add" name="add" form="form-add">
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-2 col-form-label" for="file">Afbeelding:</label>
                                <div class="col-10">
                                    <input class="btn btn-default" id="file" type="file" name="medium[]" required form="form-add">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <form action="/dashboard/Thema/hulp.php" method="POST" id="form-add" enctype="multipart/form-data">
                                <button class="btn btn-primary" method="post" type="submit">Opslaan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="bijwerken" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addmenu">Bijwerken</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <!--<label for="newthemename">Naam</label>-->
                                <input type="hidden" id="newtheme-edit-id" value="" name="theme_id">
                                <input type="hidden" value="1" id="bool-edit" name="edit" form="form-edit">
                                <!--<label class="control-label col-2 col-form-label" for="newthemename">Naam:</label>-->
                                <input type="text" class="form-control" id="newthemename" placeholder="Naam" name="name" required form="form-edit">
                            </div>


                            <!--<button type="submit" class="btn btn-primary">Afbeelding toevoegen</button>-->
                            <div class="form-group row">
                                <label class="control-label col-2 col-form-label" for="file">Afbeelding:</label>
                                <div class="col-10">
                                    <input class="btn btn-default" id="file" type="file" name="medium[]" form="form-edit" required>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <form action="/dashboard/Thema/hulp.php" method="POST" id="form-edit" enctype="multipart/form-data">
                                <button class="btn btn-primary" type="submit">Opslaan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                            </form>
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
                            <form method="POST" action="/dashboard/Thema/hulp.php">
                                <input type="hidden" id="theme-id" name="theme_id[]" value="">
                                <input type="hidden" name="delete" id="bool-remove" value="1">
                                <button type="submit" class="btn btn-primary" id="deletebutton">Ja</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Nee</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




    </body>

    </html>