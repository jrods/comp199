<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">

    <title>Object Prototype</title>
    <link href="css/cartButton.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'/>
    <style type="text/css">
        * {
            font-family: "Source Sans Pro";
        }

        a {
            text-decoration: none;
            color: #000;
        }

        .galleryWrapper {
            width: 45em;
            height: 30em;
            margin-left: auto;
            margin-right: auto;
        }

        .galleryContent {
            width: 45em;
            height: 30em;
            display: inline-block;
        }

        .itemList {
            list-style-type: none;
            vertical-align: top;
            display: inline-block;
            padding-left: 0em;
        }

        li.item {
            overflow: hidden;
            display: inline-block;
            margin: 0px 22px 0em 0px;
        }

        #albumObject {
            position: relative;
            display: inline-block;
            width: 8.6em;
            height: 12.5em;
            border: 1px solid #ccc;
        }

        .albumText {
            padding-left: 0.25em;
        }

        #albumTitle {
            font-size: 0.9em;
        }

        #artistName {
            font-size: 0.8em;
        }

        #tags {
            font-size: 0.7em;
            color: #aaa;
        }

        #art {
            width: 8.6em;
            height: 8.6em;
            top: 1em;
        }

        .playButton img {
            position: absolute;
            top: 42px;
            left: 38px;
        }

    </style>

</head>
<body>

<div id="galleryWrapper">
    <div id="galleryContent" class="galleryContent">
        <ul class="itemList">
            <li class="item">
                <a id="albumObject">
                    <span class="albumArt">
                        <img id="art" src="/res/image/test.jpg">

                        <span class="playButton">
                            <img id="playButton" src="/res/image/play.png">
                        </span>
                    </span>

                    <div id="albumTitle" class="albumText">album title</div>
                    <div id="artistName" class="albumText">artist name</div>
                    <div id="tags" class="albumText">tag</div>
                </a>
                <div id="addToCartSpace" class="albumItem">
                    <button type="button" name="" value="" class="addToCartButton">+ add to cart</button>
                </div>
            </li>
        </ul>
    </div>
</div>

</body>
</html>