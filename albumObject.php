<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">

    <title>Object Prototype</title>
    <link href="css/cartButton.css" rel="stylesheet" type="text/css" />
    <link href="css/galleryGenerator.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'/>

</head>
<body>

<div id="galleryWrapper">
    <div id="galleryContent" class="galleryContent">
        <ul class="itemList">
            <li class="item">

                <div id="albumObject">

                    <a href="temp/link">
                        <span class="albumArt">
                            <img id="art" src="/res/image/test.jpg">

                            <span class="playButton">
                                <img id="playButton" src="/res/image/play.png">
                            </span>
                        </span>
                    </a>

                    <div id="albumTitle" class="albumText">album title</div>
                    <div id="artistName" class="albumText" >artist name</div>
                    <div id="tags" class="albumText">tag</div>
                </div>

                <div id="addToCartSpace" class="albumItem">
                    <button type="button" name="" value="" class="addToCartButton">+ add to cart</button>
                </div>

            </li>
        </ul>
    </div>
</div>

</body>
</html>