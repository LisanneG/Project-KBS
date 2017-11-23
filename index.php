<!DOCTYPE HTML>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Berichten</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet"  href="/css/fpstyle.css">

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

            testspam(20);
            
            
            ?>
        </ul>
        </div>

        
        <script src="/js/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/jquery-dateFormat.min.js"></script>
        <script src="/js/indexscript.js"></script>
    </body>
</html>