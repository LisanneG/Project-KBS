<?php 
    session_start(); 
    require 'dashboard/include/framework.php';
    $location_id = getLocation();
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Berichten</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="3600">
    <link rel="stylesheet" href="css/fpstyle.css">
    <?php $logo = getTheme(getLocation()); ?>
</head>

<body>
    <header>
        <nav class="navbar fixed-top" id="top-bar">
            <a id="date" class="navbar-brand"></a>
            <a id="time" class="navbar-brand"></a>
            <img id="logo" src="<?php print($logo); ?>" alt="Logo">
        </nav>
    </header>

    <div id="location_name">
        <?php echo $_GET["location"]; ?>
    </div>
    <div class="container-fluid">
        <div id="location_name">
            <?php print($_GET["location"]);?>
        </div>
        <div class="row">
            <div class="col-4 priority-box">
                <ul class="list-unstyle mw-50">
                    <?php getPriority($location_id); ?>
                </ul>
            </div>
            <div class="col"  id="messagediv">
                <ul class="list-unstyle mw-50">
                    <?php
            //borrowing DB connection code
            
            
            
            
            readDB($location_id);
            testspam(5);
            
            
                ?>
                </ul>
            </div>
        </div>
        <div id="weather"></div>
    </div>


    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-dateFormat.min.js"></script>
    <script src="js/jquery.visible.min.js"></script>
    <script src="js/indexscript.js"></script>
</body>

</html>