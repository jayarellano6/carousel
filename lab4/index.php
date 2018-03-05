<?php
    $backgroundimage = "./img/sea.jpg";
    
    if(isset($_GET['keyword']) && isset($_GET['layout'])){
        if(isset($_GET['category'])){
            $_GET['keyword'] = $_GET['category']." ".$_GET['keyword'];
        }
        echo "You searched for: " .$_GET['keyword'];
        include 'api/pixabayAPI.php';
        $imageURLs = getImageURLs($_GET['keyword'], $_GET['layout']);
        $backgroundimage = $imageURLs[array_rand($imageURLs)];
        // print_r($imageURLs);
    }else{
        $backgroundimage = "./img/sea.jpg";
        echo "You must enter a keyword or select one from the options, along with an image orientation";
    }
?>
<html>
    <head>
        <title>Image Carousel</title>
        <link rel="icon" href="./img/i.ico">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel= "stylesheet">
        <style>
            @import url("css/styles.css");
            body{
                background-image: url('<?=$backgroundimage?>');
            }
        </style>
    
    </head>
    <body>
        <br/><br/>
        <?php
            if (!isset($imageURLs)){
                echo "<h2> type a key word</h2>";
            }else{
                
        ?>
        
        <div id= "carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!--I-->
            <ol class="carousel-indicators">
                <?php
                    for($i = 0; $i<7; $i++){
                        echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                        echo ($i == 0) ? "class='active'" : "";
                        echo "></li>";
                    }
                ?>
            </ol>
            
            <!--w-->
            <div class="carousel-inner" role="listbox">
                <?php
                    for($i = 0; $i < 7; $i++){
                        do{
                            $randomIndex = rand(0, count($imageURLs));
                        }while(!isset($imageURLs[$randomIndex]));
                        
                        echo '<div class= "item ';
                        echo ($i == 0) ? "active" : "";
                        echo '">';
                        echo '<img src="' .$imageURLs[$randomIndex]. '">';
                        echo '</div>';
                        unset($imageURLs[$randomIndex]);
                    }
                ?>
            </div>
            
            <!--C-->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php
            }
        ?>
        <br>
        <form>
            <input type="text" name="keyword" placeholder="Keyword" value="<?=$_GET['keyword']?>"/><br>
            <input type="radio" id = "lhorizontal" name="layout" value = "horizontal"/>
            <label for="Horizontal"></label><label for="lhorizontal">Horizontal</label>
            <input type="radio" id = "lvertical" name="layout" value = "vertical"/>
            <label for="Vertical"></label><label for="lvertical">Vertical</label>
            <br>
            <select name="category">
                <option value= "">Select one</option>
                <option value= "ocean">Ocean</option>
                <option value= "forest">Forest</option>
                <option value= "mountain">Mountain</option>
                <option value= "snow">Snow</option>
            </select>
            <br>
            <input type="submit" value="enter"/>
        </form>
        <br/><br/>
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>