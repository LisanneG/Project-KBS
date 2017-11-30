<!DOCTYPE HTML>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Berichten</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="3600">
    <link rel="stylesheet"  href="css/fpstyle.css">
    <?php session_start(); ?>
    </head>
    
    <body>        

        <nav class="navbar" id="top-bar">
            <a id="date" class="navbar-brand"></a>
            <a id="time" class="navbar-brand"></a>
            <img id="logo" src="https://images.pexels.com/photos/380768/pexels-photo-380768.jpeg?w=1260&h=750&auto=compress&cs=tinysrgb" alt="">
        </nav>
        <div class="container">
        <ul class="list-unstyle mw-50" >
            <?php
            //borrowing DB connection code
            
            
            function getLocation(){
                //TODO: work on it
                include 'database.php';
                if(!(isset($_GET["location"]))){
                    print("<div class='alert alert-danger' role='alert'><strong>Error:</strong>Geen locatie ingesteld.</div>");
                    return NULL;
                }
                else{
                    $locationquery = $conn->prepare("SELECT location_id FROM `location` WHERE `name` = ? ");
                    $locationquery->execute(array($_GET["location"]));
                    $locationresult = $locationquery->fetch();

                    if($locationquery->rowCount() > 0){
                        return $locationresult();
                    }
                    else{
                        print("<div class='alert alert-danger' role='alert'><strong>Error:</strong>Geen geldige locatie.</div>");
                        return NULL;
                    }
                }

            }
            
            function getTheme($location_id){

            }
            
            
            
            
            
            function readDB($location_id)
            {
                include 'database.php';
                $currentdbtime = date("Y-m-d H:i:s");   /*using time() to pull local time and formatting it to DATETIME Mysql format*/
            
                $mainquery = $conn->prepare("SELECT n.news_article_id, title, color, n.file_id, `date`, `description`, nahl.location_id , `type` FROM news_article n 
                LEFT JOIN `file` f ON n.file_id = f.file_id 
                LEFT JOIN catagory c ON n.catagory_id = c.catagory_id 
                LEFT JOIN news_article_has_location nahl ON n.newsarticle_id = nahl.newsarticle_id
                WHERE display_from => ? AND display_till <= ? AND nahl.location_id = ? ORDER BY priority"); 
                $mainquery->execute(array($currentdbtime, $currentdbtime, $location_id));
                $result = $mainquery->fetch(); // getting information
                

                if(!($mainquery->rowCount() > 0)){
                    print("<li class='media mb-5 mt-5 border border-dark'>");
                    print("<div class='media-body'>");
                    print("<h5 class='mt-0'>Geen title</h5>");
                    print("<p>Deze Database is leeg</p>");
                    print("</div>");
                    print("<img class='align-self-center mr-3 img-thumbnail img-responsive' src='...' alt='Geen Foto'>");                                        
                    print("</li>");
                    return false;
                } 
                else {
                    
                }
                
                

                while($row = $result) {
                    
                    if($row['type'] == "afbeelding"){
                        //nieuwbericht gewoon
                        
                        print("<li class='media mb-5 mt-5 border border-dark' style='background-color: ". $row['color']."' id='" . $row['news_article_id']. "-messageimg'>
                        <div class='media-body'>
                        <h5 class='mt-0'> " . $row['title'] . "</h5>
                        " . $row['description']. "
                        <p>Datum: ". date( "d-m-Y", $row['date']) ."</p>
                        </div>
                        <img class='align-self-center mr-3 img-thumbnail img-responsive' src='". $row['location'] ."' alt='Error'>                                    
                        </li>");
                        
                    }
                    elseif($row['n.file_id'] == NULL){
                    
                        print("<li class='media mb-5 mt-5 border border-dark' id='" . $row['news_article_id']. "-message'>
                        <div class='media-body'>
                        <h5 class='mt-0'> " . $row['title'] . "</h5>
                        " . $row['description']. "
                        <p>Datum: ". date( "d-m-Y", $row['date']) ."</p>
                        </div>
                        </li>");
                    }
                    elseif($row['type'] == "video"){
                        $videotype = explode(".", $row['location']);

                        print("<li class='media mb-5 mt-5 border border-dark' style='background-color: ". $row['color']."' id='" .$row['news_article_id'] ."-messagevideo'>
                        <div class='media-body'>
                        <h5 class='mt-0'>". $row['title'] ."</h5>
                        <video class='embed-responsive-item embed-responsive-item-16by9' muted>
                        <source src='". $row['location'] ." type='video/". $videotype ."'>Your browser does not support video</video>
                        <p>Datum: ". date( "d-m-Y", $row['date']) ."</p>
                        </div>
                        </li>");
                    }
                    
                }

                $birthdayquery = $conn->prepare("SELECT f.location `date`, birthday_id, b.file_id, b.catagory_id, first_name, color FROM birthday b LEFT JOIN user u ON b.user_id = u.user_id LEFT JOIN catagory c ON b.catagory_id = c.catagory_id LEFT JOIN `file f` ON b.file_id = f.file_id
                WHERE birthday = ? AND u.location = ? ORDER BY first_name"); 
                $birthdayquery->execute(array($currentdbtime, $locationid));
                $result = $mainquery->fetch();
                // getting birthday information
                
                while($bdrow = $result){
                    //hou hier geen rekening met catagorie, ik ga er van uit dat dat er sowieso anders uit ziet.
                    if($bdrow['b.file_id'] == NULL){
                        //verjaardag zonder foto
                        print("<li class='media mb-5 mt-5 border border-dark' style='background-color: ". $bdrow['color']."' id='" . $bdrow['birthday_id']. "-birthdaynoimg'>
                        <div class='media-body'>
                        <h5 class='mt-0'> " . $bdrow['first_name'] . " is jarig!</h5>
                        </div>
                        </li>");
                    }
                    else{
                        //verjaardag met foto
                        print("<li class='media mb-5 mt-5 border border-dark' style='background-color: ". $bdrow['color']."' id='" . $bdrow['birthday_id']. "-birthdayimg'>
                        <div class='media-body'>
                        <h5 class='mt-0'> " . $bdrow['first_name'] . " is jarig!</h5>
                        </div>
                        <img class='align-self-center mr-3 img-thumbnail img-responsive' src='". $bdrow['f.location'] ."' alt='Error'>                                    
                        </li>");
                    }
                }



            } 

            function testspam($run){
                for($i = 0; $i < $run; $i++){
                    print("<li class='media mb-5 mt-5 border border-dark' id='12137-message'>"); //dummy id to trigger animation or else it will just do the normal scrolling
                    print("<div class='media-body'>");      //from top to bottom really fast.
                    print("<h5 class='mt-0'>Test title</h5>");
                    print("<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>");
                    print("</div>");
                    print("<img class='align-self-center mr-3 img-thumbnail img-responsive' src='...' alt='Generic placeholder image'>");                                        
                    print("</li>");
                }
            }
            
            readDB(getLocation());
            testspam(20);
            
            
            ?>

            <div id="weather"></div>
        </ul>
        </div>

        
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-dateFormat.min.js"></script>
        <script src="js/indexscript.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>