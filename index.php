<!DOCTYPE HTML>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Berichten</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <script>
        $(function(){$('#myCarousel').carousel();});
    </script>
    </head>
    
    <body>
    <a href="#" class="button">Test</a>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol>
                <?php
                print("<li data-target='#myCarousel' data-slide-to='0' class='active'></li>");
                print("<li data-target='#myCarousel' data-slide-to='1'></li>");
                print("<li data-target='#myCarousel' data-slide-to='2'></li>");

                ?>
            </ol>
            <?php
            print("<div class='carousal-inner'>");
            print("<div class='item active'>");

            print("</div>");
            print("<div class='item'>");
            
            print("</div>");
            print("<div class='item'>");
            
            print("</div>");

            print("</div>");
            ?>
            <a class="left carousal-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Vorige</span>
            </a>
            <a class="right carousal-control" href="#myCarousal" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Volgende</span>
            </a>
        </div>
    
    </body>
</html>