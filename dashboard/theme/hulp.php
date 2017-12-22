

<?php



function removeTheme($theme_id) {
    include_once '../../dashboard/include/framework.php';
    include '../../database.php';
    
    
    $removequery = $conn->prepare("SELECT background_file FROM theme WHERE theme_id = ?");
    $removequery->execute(array($theme_id));
    $file_id = $removequery->fetch(PDO::FETCH_ASSOC);
    
    $removequery = $conn->prepare("UPDATE `location` SET theme_id = NULL WHERE theme_id = ?");
    $removequery->execute(array($theme_id));
    
    $removequery = $conn->prepare("DELETE FROM theme WHERE theme_id = ?");
    $removequery->execute(array($theme_id));


    fileRemove($file_id["background_file"]);


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
    $file_id0 = fileUpload();

    $removequery = $conn->prepare("SELECT background_file FROM theme WHERE theme_id = ?");
    $removequery->execute(array($theme_id));
    $file_id1= $removequery->fetch(PDO::FETCH_ASSOC);

    $themequery = $conn->prepare("UPDATE theme SET `name` = ?, background_file = ? WHERE theme_id = ?");
        
    $themequery->execute(array($name, $file_id0[0], $theme_id));

    fileRemove($file_id1["background_file"]);


}



function handler() {
    if (isset($_POST["theme_id"])) {
        $theme_id = $_POST["theme_id"];
        if(isset($_POST["delete"])){
            removetheme($theme_id);
        }
    }
     
    if (isset($_POST["name"]) && (isset($_FILES["medium"]))){
        if(isset($_POST["edit"])){
            $theme_id = $_POST["theme_id"];
            editTheme($theme_id, $_POST["name"]);
        }
        elseif(isset($_POST["add"])){
            addTheme($_POST["name"]);
        }
    }
    header("Location: /KBS/Project-KBS/dashboard/theme/");
    exit;
}


handler();
?>
