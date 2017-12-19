<?php

function getThema() {
    include '../../database.php';

    $themequery = $conn->prepare("SELECT t.name as 'theme_name', theme_id, f.location as 'image' FROM theme t LEFT JOIN file f on t.background_file = f.file_id"); //SQL QUERY
    $themequery->execute();
    foreach ($themequery as $row) {
        print("<tr>");
        print("<td>" . $row["theme_id"] . "</td>");
        print("<td>" . $row["theme_name"] . "</td>");
        print("<td> <img class='img-fluid' src='" . $row["image"] . "'></img></td>");
        print("<td><button type='submit' class='btn btn-primary' id='edit-". $row["theme_id"]."'>bijwerken</button></td>");
        print("</tr>");
    }
    //voor iedere rij in de tabel toon de tabelinhoud
}

function removeTheme() {
    $priorityquery = $conn->prepare("DELETE FROM theme WHERE theme_id = ?");
    $priorityquery->execute(array($theme_id));

    //gebruik een GET of POST functie om $theme_id te gebruiken hiervoor.
}

function addTheme() {
    include '/database.php';
    $themequery = $conn->prepare("INSERT INTO `file`() VALUES(?, ?, ?, ?)");
    $themequery->execute(array(NULL, NULL, "photo", NULL));
}

function handler() {
    if (isset($_POST[""])) {
        //doe de juiste taken
    } elseif (isset($_POST[""])) {
        //doe de juiste taken
    }
}

handler();
?>