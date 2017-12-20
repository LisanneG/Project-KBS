<?php

function getThema() {
    include '../../database.php';

    $themequery = $conn->prepare("SELECT t.name as 'theme_name', theme_id, f.location as 'image' FROM theme t LEFT JOIN file f on t.background_file = f.file_id"); //SQL QUERY
    $themequery->execute();
    foreach ($themequery as $row) {
        print("<tr>");
        print("<td>" . $row["theme_id"] . "</td>");
        print("<td>" . $row["theme_name"] . "</td>");
        print("<td> <img class='img-fluid themeimage' src='" . $row["image"] . "'></img></td>");
        print("<td><button type='submit' class='btn btn-primary' id='edit-" . $row["theme_id"] . "'>Bijwerken</button></td>");
        print("</tr>");
    }
    //voor iedere rij in de tabel toon de tabelinhoud
}

function removeTheme($theme_id) {
    include '../../database.php';
    $ids = implode(',', array_fill(0, count($theme_id), '?'));
    
    $removequery = $conn->prepare("UPDATE `location` SET theme_id = NULL WHERE theme_id IN (". $ids .")");
    $removequery->execute($theme_id);
    
    $removequery = $conn->prepare("DELETE FROM theme WHERE theme_id IN (". $ids .")");
    $removequery->execute($theme_id);


    //gebruik een GET of POST functie om $theme_id te gebruiken hiervoor.
}

function addTheme($name, $file) {
    include '../../dashboard/include/framework.php';
    include '../../database.php';

    $file_id = fileUpload($file);


    $themequery = $conn->prepare("INSERT INTO theme(`name`, background_file) VALUES(?, ?)");
    $themequery =execute(array($name, $file_id[0]));

    
}



function editTheme($theme_id, $name, $file){
    include '../../dashboard/include/framework.php';
    include '../../database.php';
    $file_id = fileUpload($file);

        $themequery = $conn->prepare("UPDATE theme SET `name` = ? background_file = ? WHERE theme_id = ?");
        $themequery =execute(array($name, $file_id, $theme_id));

}



function handler() {
    if (isset($_POST["theme_id"])) {
        $theme_id = $_POST["theme_id"];
        if($_POST["delete"] == "1"){
            removetheme($theme_id);
        }
    } elseif (isset($_POST["name"]) && (isset($_POST["medium"]))){
        $name = $_POST["name"];
        $file = $_POST["medium"];
        if($_POST["edit"] = "1" && (isset($_POST["theme_id"]))){
            $theme_id = $_POST["theme_id"];
            editTheme($theme_id, $name, $file);
        }
        elseif($_POST["add"] == "1"){
            addTheme($name, $file);
        }
        }
    }


?>
