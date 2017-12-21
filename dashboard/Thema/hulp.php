<?php echo exec('whoami'); ?>



<?php



function removeTheme($theme_id) {
    include '../../database.php';
    $ids = implode(',', array_fill(0, count($theme_id), '?'));
    
    $removequery = $conn->prepare("UPDATE `location` SET theme_id = NULL WHERE theme_id IN (". $ids .")");
    $removequery->execute($theme_id);
    
    $removequery = $conn->prepare("DELETE FROM theme WHERE theme_id IN (". $ids .")");
    $removequery->execute($theme_id);


    //gebruik een GET of POST functie om $theme_id te gebruiken hiervoor.
}

function addTheme($name) {
    include_once '../../dashboard/include/framework.php';
    include '../../database.php';
    $file_id = fileUpload();


    $themequery = $conn->prepare("INSERT INTO theme(`name`, background_file) VALUES(?, ?)");
    $themequery->execute(array($name, $file_id[0]));

    
}



function editTheme($theme_id, $name){
    include_once '../../dashboard/include/framework.php';
    include '../../database.php';
    $file_id = fileUpload();


        $themequery = $conn->prepare("UPDATE theme SET `name` = ? background_file = ? WHERE theme_id = ?");
        $themequery->execute(array($name, $file_id[0], $theme_id));

}



function handler() {
    if (isset($_POST["theme_id"])) {
        $theme_id = $_POST["theme_id"];
        if($_POST["delete"] == "1"){
            removetheme($theme_id);
        }
    } 
    elseif (isset($_POST["name"]) && (isset($_FILES["medium"]))){
         if($_POST["edit"] = "1" && (isset($_POST["theme_id"]))){
            $theme_id = $_POST["theme_id"];
            editTheme($theme_id, $_POST["name"]);
        }
        elseif($_POST["add"] == "1"){
            addTheme($_POST["name"]);
        }
    }
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}


handler();
?>
