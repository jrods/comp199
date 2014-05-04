<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">

    <title>Object Prototype</title>

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

        button.addToCartButton{
            font-size: 14px;
            color: #ffffff;
            padding: 3px 10px;
            margin: 3px 19px 2px;
            background: -moz-linear-gradient(
                top,
                #00db00 0%,
                #1f9900);
            background: -webkit-gradient(
                linear, left top, left bottom,
                from(#00db00),
                to(#1f9900));
            -moz-border-radius: 9px;
            -webkit-border-radius: 9px;
            border-radius: 9px;
            border: 0px solid #194d14;
            -moz-box-shadow:
            0px 1px 3px rgba(255,255,255,0),
            inset 0px 0px 1px rgba(255,255,255,0.6);
            -webkit-box-shadow:
            0px 1px 3px rgba(255,255,255,0),
            inset 0px 0px 1px rgba(255,255,255,0.6);
            box-shadow:
            0px 1px 3px rgba(255,255,255,0),
            inset 0px 0px 1px rgba(255,255,255,0.6);
            text-shadow:
            1px 1px 1px rgba(000,000,000,0.7),
            2px 2px 6px rgba(000,000,000,0.4);
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