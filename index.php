<!DOCTYPE HTML>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Berichten</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet"  href="css/fpstyle.css">

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
            //location needs to be set. Will be set to NULL for now.
            function readDB($location)
            {
                include 'database.php';
                $currentdbtime = date("Y-m-d H:i:s");   /*using time() to pull local time and formatting it to DATETIME Mysql format*/
            
                $mainquery = $conn->prepare("SELECT nieuwsbericht_id, titel, catagorie_id, bestand_id, datum, prioriteit, beschrijving FROM niewsbericht 
                WHERE weergave_van => ? AND weergave_tot <= ? AND locatie = ?"); 
                $mainquery->execute(array($currentdbtime, $currentdbtime, $location));
                $result = $mainquery->fetch(); // getting information
                

                if(!($mainquery->rowCount() > 0)){
                    print("<li class='media mb-5 mt-5 border border-dark'>");
                    print("<div class='media-body'>");
                    print("<h5 class='mt-0'>Geen Titel</h5>");
                    print("<p>Deze Database is leeg</p>");
                    print("</div>");
                    print("<img class='align-self-center mr-3 img-thumbnail img-responsive' src='...' alt='Geen Foto'>");                                        
                    print("</li>");
                    return false;
                } 
                else {
                    
                }
                
                while($row = $result) {
                    
                    

                    $querymedia = $conn->prepare("SELECT locatie FROM bestand 
                    WHERE bestand_id = (SELECT bestand_id FROM nieuwsbericht WHERE bestand_id = ?)"); 
                    $querymedia->execute(array($row['bestand_id']));
                    $medialocation = $querymedia->fetch(); // getting information for images

                    //just some example stuff I wrote, probably want to store them inside a array and sort them based on priority.
                    //TODO: figure out a way to handle ID's. Maybe with the nieuwsbericht_id row? (update: so far using a combo)
                    //https://stackoverflow.com/questions/8934025/php-initiate-variable-with-multiple-lines
                    //TODO: finish catagories and manage the contents of this loop
                    if($row['catagorie_id'] = 2 ){
                        //nieuwbericht gewoon
                        print("<li class='media mb-5 mt-5 border border-dark'> id='" .$row['nieusbericht_id'] ."-" . $row['catagorie_id'] . "'>");
                        print("<div class='media-body'>");
                        print("<h5 class='mt-0'>". $row['titel'] ."</h5>");
                        print("<p>". $row['beschrijving'] ."</p>");
                        print("<p>Datum: ". date( "d-m-Y", $row['datum']) ."</p>");
                        print("</div>");
                        print("<img class='align-self-center mr-3 img-thumbnail img-responsive' src='". $medialocation['locatie'] ."' alt='Geen Foto'>");                                        
                        print("</li>");
                    }
                    elseif($row['catagorie_id'] = 3 ){
                        //video (can it be mp4 only? the standard now is mp4 until further notice. I am also using 16:9)
                        print("<li class='media mb-5 mt-5 border border-dark' id='" .$row['nieusbericht_id'] ."-" . $row['catagorie_id'] . "'>");
                        print("<div class='media-body'>");
                        print("<h5 class='mt-0'>". $row['titel'] ."</h5>");
                        print("<video class='embed-responsive-item embed-responsive-item-16by9' muted>
                        <source src='". $medialocation['locatie'] ."'>Your browser does not support video</video>");
                        print("<p>Datum: ". date( "d-m-Y", $row['datum']) ."</p>");
                        print("</div>");
                        print("</li>");
                    }
                }
            } 

            function testspam($run){
                for($i = 0; $i < $run; $i++){
                    print("<li class='media mb-5 mt-5 border border-dark'>");
                    print("<div class='media-body'>");
                    print("<h5 class='mt-0'>Test titel</h5>");
                    print("<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>");
                    print("</div>");
                    print("<img class='align-self-center mr-3 img-thumbnail img-responsive' src='...' alt='Generic placeholder image'>");                                        
                    print("</li>");
                }
            }
            
            readDB(NULL);
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