<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Berichten</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="3600">
    <link rel="stylesheet"  href="css/fpstyle.css">
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
        
<<<<<<< HEAD
        <div class="container" id="messagediv">
=======
        <nav class="navbar fixed-top" id="top-bar">
            <a id="date" class="navbar-brand"></a>
            <a id="time" class="navbar-brand"></a>
            <img id="logo" src="<?php $logo; ?>" alt="Logo">
        </nav>
        <div class="container">
            <div id="location_name"><?php echo $_GET["location"]; ?></div>
>>>>>>> b748d7d57edd9695d4d5f7db9b5c43cc2d0e2c59
            
        <ul class="list-unstyle mw-50" >
            <?php
            //borrowing DB connection code
            
            
            function getLocation(){
                //TODO: work on it
                include 'database.php';
                if(!(isset($_GET["location"]))){
                    print("<div class='alert alert-danger' role='alert'><strong>Error:</strong> Geen locatie ingesteld.</div>");
                    return NULL;
                }
                elseif(isset($_SESSION["location"]) && (isset($_SESSION["location_id"]))){
                    $_GET["location"] = $_SESSION["location"];
                    return $_SESSION["location_id"];
                }

                else{
                    $locationquery = $conn->prepare("SELECT location_id, `name` FROM `location` WHERE `name` = ? ");
                    $locationquery->execute(array($_GET["location"]));
                    $locationresult = $locationquery->fetch();

                    if($locationquery->rowCount() > 0){
                        $_SESSION["location_id"] = $locationresult["location_id"];
                        $_SESSION["location_name"] = $locationresult["name"];
                        return $locationresult["location_id"];
                    }
                    else{
                        print("<div class='alert alert-danger' role='alert'><strong>Error:</strong> Geen geldige locatie.</div>");
                        return NULL;
                    }
                }

            }
            
            function getTheme($location_id){
                include 'database.php';
                if($location_id == NULL){
                    return;
                }
                
                
                //TODO: make query, add relevant info to style
                $themequery = $conn->prepare("SELECT lay.font as 'font', lay.font_color as 'font-color', flayoutlogo.location as 'logo', flayoutbg.location as 'background-layout', ftheme.location as 'background-theme', lay.background_color as 'background-color-navbar', loc.theme_id as 'isTheme' FROM `location` loc
                
                LEFT JOIN theme th ON loc.theme_id = th.theme_id
                LEFT JOIN layout lay ON loc.layout_id = lay.layout_id
                LEFT JOIN `file` ftheme ON th.background_file = ftheme.file_id
                LEFT JOIN `file` flayoutlogo ON lay.logo = flayoutlogo.file_id
                LEFT JOIN `file` flayoutbg ON lay.default_background = flayoutbg.file_id

                WHERE loc.location_id = ? ");
                $themequery->execute(array($location_id));
                $themeresult = $themequery->fetch(PDO::FETCH_ASSOC);

                if(($themequery->rowCount() > 0) && ($themequery->rowCount() < 2)){
                    print("<style>");
                    if($themeresult["isTheme"] == NULL){
                    print("body {background-image: '". $themeresult["background-layout"] ."'; font: ". $themeresult["font"] .";}");
                    }
                    
                    else {
                        print("body {background-image: '". $themeresult["background-theme"] ."'; font: ". $themeresult["font"] .";}");
                    }
                    
                    
                    
                    print(" nav#top-bar {background-color: ". $themeresult["background-color-navbar"] ." ; color: ". $themeresult["font-color"] ." ;}");
                    print("</style>");
                    $logo = $themeresult["logo"];
                            //li bgcolor needed?
                            return $logo;
 


                }
                else{
                    return;
                }

            }
            
            function getPriorityWarning($priority){
                if($priority == 1){
                    $string = "<div class='d-flex align-self-end mt-5'><i class='fa fa-exclamation-triangle fa-4x priority-alert float-right' aria-hidden='true' ></i></div>";
                    return $string;
                }
                else{
                    return;
                }
            }
            
            function setPriority($priority){
                if($priority == 1){
                    $string = "fixed-top";
                    return $string;
                }
                else{
                    return;
                }
            }
            
            
            function readDB($location_id)
            {
                
                include 'database.php';            
                $mainquery = $conn->prepare("SELECT n.news_article_id, title, background_color, n.file_id, `date`, `description`, nahl.location_id , `type`, `priority`, f.muted, `location` FROM news_article n 
                LEFT JOIN `file` f ON n.file_id = f.file_id 
                LEFT JOIN category c ON n.category_id = c.category_id 
                LEFT JOIN news_article_has_location nahl ON n.news_article_id = nahl.news_article_id 
                WHERE (display_from <= NOW() AND display_till >= NOW()) 
                AND nahl.location_id = ? 
                ORDER BY priority");
                $mainquery->execute(array($location_id));
                

                if(!($mainquery->rowCount() > 0)){
                    print("<div class='alert alert-info' role='alert'><strong>Error:</strong> Geen berichten.</div>");
                    return false;
                } 
                else {
                    
                }
                
                

                foreach($mainquery as $row) {
                    
                    if($row['type'] == "afbeelding"){
                        //nieuwbericht gewoon
                        
                        print("<li class='media mb-5 mt-5 border border-dark ". setPriority($row["priority"]) ."' style='background-color: ". $row['color']."' id='" . $row['news_article_id']. "-messageimg'>
                        <div class='media-body mx-4 mt-4'>
                        <h3 class='font-weight-bold mb-4'> " . $row['title'] . "</h3>
                        <div class='messagecontent01'>" . $row['description']. "</div>
                        <p class='mt-2'>Datum: ". date( "d-m-Y", $row['date']) ."</p>
                        </div>
                        <div class='media-object d-flex align-self-end mr-4 flex-column col-5 mt-4 mb-4' '>
                        <img class='align-self-center img-thumbnail img-responsive' src='". $row['location'] ."' alt='Error'>");
                        print(getPriorityWarning($row['priority']));
                        print("</div>");                                   
                        print("</li>");
                        
                    }
                    elseif($row['n.file_id'] == NULL){
                    
                        print("<li class='media mb-5 mt-5 border border-dark". setPriority($row["priority"]) ."' id='" . $row['news_article_id']. "-message'>
                        <div class='media-body mx-4 mt-4'>
                        <h3 class='mt-0'> " . $row['title'] . "</h3>
                        <div class'messagecontent01'>" . $row['description']. "</div>
                        <p class='mt-2'>Datum: ". date( "d-m-Y", $row['date']) ."</p>
                        </div>
                        <div class='media-object d-flex align-self-end mr-4 flex-column col-5 mt-4 mb-4' '>
                        ");
                        print(getPriorityWarning($row['priority']));
                        print("</div>");
                        print("</li>");
                    }
                    elseif($row['type'] == "video"){
                        $videotype = explode(".", $row['location']);

                        print("<li class='media mb-5 mt-5 border border-dark". setPriority($row["priority"]) ."' style='background-color: ". $row['color']."' id='" .$row['news_article_id'] ."-messagevideo'>
                        <div class='media-body mx-4 mt-4'>
                        <h3 class='font-weight-bold mb-4'>". $row['title'] ."</h3>
                        <video class='embed-responsive-item embed-responsive-item-16by9' muted>
                        <source src='". $row['location'] ." type='video/". $videotype ."'>Your browser does not support video</video>
                        <p class='mt-2'>Datum: ". date( "d-m-Y", $row['date']) ."</p>
                        </div>");
                        print(getPriorityWarning($row['priority']));
                        print("</li>");
                    }
                    elseif($row['type'] == "video" && $row["muted"] == 0){
                        $videotype = explode(".", $row['location']);

                        print("<li class='media mb-5 mt-5 border border-dark". setPriority($row["priority"]) ."' style='background-color: ". $row['color']."' id='" .$row['news_article_id'] ."-messagevideowithsound'>
                        <div class='media-body mx-4 mt-4'>
                        <h3 class='font-weight-bold mb-4'>". $row['title'] ."</h3>
                        <video class='embed-responsive-item embed-responsive-item-16by9'>
                        <source src='". $row['location'] ." type='video/". $videotype ."'>Your browser does not support video</video>
                        <p class='mt-2'>Datum: ". date( "d-m-Y", $row['date']) ."</p>
                        </div>");
                        print(getPriorityWarning($row['priority']));
                        print("</li>");
                    }
                }

                $birthdayquery = $conn->prepare("SELECT f.location `date`, birthday_id, b.file_id, b.category_id, first_name FROM birthday b 
                LEFT JOIN user u ON b.user_id = u.user_id 
                LEFT JOIN category c ON b.category_id = c.category_id 
                LEFT JOIN `file` f ON b.file_id = f.file_id 
                WHERE birthday = NOW() AND u.location = ?
                ORDER BY first_name"); 
                $birthdayquery->execute(array($locationid));
                // getting birthday information
                
                foreach($birthdayquery as $bdrow){
                    //hou hier geen rekening met catagorie, ik ga er van uit dat dat er sowieso anders uit ziet.
                    if($bdrow['b.file_id'] == NULL){
                        //verjaardag zonder foto
                        print("<li class='media mb-5 mt-5 border border-dark' style='background-color: ". $bdrow['color']."' id='" . $bdrow['birthday_id']. "-birthdaynoimg'>
                        <div class='media-body mx-4 mt-4'>
                        <h3 class='mx-5 my-5'> " . $bdrow['first_name'] . " is jarig!</h3>
                        </div>
                        </li>");
                    }
                    else{
                        //verjaardag met foto
                        print("<li class='media mb-5 mt-5 border border-dark' style='background-color: ". $bdrow['color']."' id='" . $bdrow['birthday_id']. "-birthdayimg'>
                        <div class='media-body mx-4 mt-4'>
                        <h3 class='mt-0'> " . $bdrow['first_name'] . " is jarig!</h3>
                        </div>
                        <div class='media-object d-flex align-self-end mr-4 flex-column col-5 mt-4 mb-4' '>                        
                        <img class='align-self-center img-thumbnail img-responsive' src='". $bdrow['f.location'] ."' alt='Error'>                                    
                        </div>
                        </li>");
                    }
                }



            } 

            function testspam($run){
                for($i = 0; $i < $run; $i++){
                    print("<li class='media mb-5 mt-5 border border-dark' id='12137-message'>"); //dummy id to trigger animation or else it will just do the normal scrolling
                    print("<div class='media-body mx-4 mt-4'>");      //from top to bottom really fast.
                    print("<h3 class='font-weight-bold mb-4'>Test title</h3>");                    
                    print("<div class='messagecontent01'><p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p></div>");
                    print("</div>");
                    print("<div class='media-object d-flex align-self-end mr-4 flex-column col-5 mt-4 mb-4'>");
                    print("<img class='align-self-end img-thumbnail img-responsive' src='https://4.bp.blogspot.com/-lYq2CzKT12k/VVR_atacIWI/AAAAAAABiwk/ZDXJa9dhUh8/s0/Convict_Lake_Autumn_View_uhd.jpg' alt='Generic placeholder image'>");
                    print("</div>");                                   
                    print("</li>");
                }
            }
            
            readDB(getLocation());
            testspam(5);
            
            
            ?>            
        </ul>

            <div id="weather"></div>
        </div>

        
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-dateFormat.min.js"></script>
        <script src="js/indexscript.js"></script>        
    </body>
</html>