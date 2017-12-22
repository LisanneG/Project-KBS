<?php
include '../include/framework.php';
include '../include/header.php';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Thema's</title>
        <?php include '../include/css.php'; ?>
        <link rel="stylesheet" type="text/css" href="../../dashboard/Thema/hulp.css">
    </head>

    <body>
        <!-- Tabs bovenin niet maken -->
        <?php include '../include/navbar.php'; ?>

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
                                    <th>#</th>
                                    <th>Naam</th>
                                    <th>Afbeelding</th>
                                    <th>Wijzigen</th>
                                    <th>Verwijderen</th>
                            </thead>
                            <tbody>
                                <?php
                                function getThema() {
                                    include '../../database.php';
                                
                                    $themequery = $conn->prepare("SELECT t.name as 'theme_name', theme_id, f.location as 'image' FROM theme t LEFT JOIN file f on t.background_file = f.file_id ORDER BY theme_id"); //SQL QUERY
                                    $themequery->execute();
                                    foreach ($themequery as $row) {
                                        print("<tr id='row-".$row["theme_id"]."'>");
                                        print("<td>" . $row["theme_id"] . "</td>");
                                        print("<td>" . $row["theme_name"] . "</td>");
                                        print("<td> <img class='img-fluid themeimage' src='" . $row["image"] . "'></img></td>");
                                        if(CheckIfUserHasRight($_SESSION["admin"], "Bewerken thema", $_SESSION["user_id"])){
                                            print("<td><button type='submit' class='btn btn-primary' id='edit-" . $row["theme_id"] . "'>Bijwerken</button></td>");
                                        }
                                        if(CheckIfUserHasRight($_SESSION["admin"], "Verwijderen thema", $_SESSION["user_id"])){
                                            print("<td><button type='submit' class='btn btn-danger' id='remove-" . $row["theme_id"] . "'>Verwijderen</button>");
                                        }
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

            <?php if(CheckIfUserHasRight($_SESSION["admin"], "Aanmaken thema", $_SESSION["user_id"])){ ?>
            <div class="container-fluid ">
                <div class="row">
                    <button type="submit" class="btn btn-primary mt-3" data-toggle="modal" data-target="#toevoegen">Toevoegen</button>
                </div>
            </div>
            <?php } ?>



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
                            <form action="/KBS/Project-KBS/dashboard/theme/hulp.php" method="POST" id="form-add" enctype="multipart/form-data">
                                <button class="btn btn-primary" method="post" type="submit">Opslaan</button>
                                <button type="button" class="btn btn-secondary cancelbtn0" data-dismiss="modal">Annuleren</button>
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
                                <input type="hidden" id="newtheme-edit-id" value="" name="theme_id" form="form-edit">
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
                            <form action="/KBS/Project-KBS/dashboard/theme/hulp.php" method="POST" id="form-edit" enctype="multipart/form-data">
                                <button class="btn btn-primary" type="submit">Opslaan</button>
                                <button type="button" class="btn btn-secondary cancelbtn0" data-dismiss="modal">Annuleren</button>
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
                            <h8 id="selected-items-del" class="pt-5"></h8>
                        </div>
                        <div class="modal-footer">
                            <form method="POST" action="/KBS/Project-KBS/dashboard/theme/hulp.php">
                                <input type="hidden" id="theme-id" name="theme_id" value="">
                                <input type="hidden" name="delete" id="bool-remove" value="1">
                                <button type="submit" class="btn btn-primary" id="deletebutton">Ja</button>
                                <button type="button" class="btn btn-secondary cancelbtn0" data-dismiss="modal">Nee</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    <?php include '../include/footer.php'; ?>



    </body>

    </html>