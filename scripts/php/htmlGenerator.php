<?php
/**
 * Created by IntelliJ IDEA.
 * User: jared
 * Date: 5/2/2014
 * Time: 10:47 PM
 */

function anchorBlockIdClassLink($idName, $className, $link, $content) {
    $results = '<a id="%s" class="%s" href="%s">%s</a>';
    return sprintf($results, $idName, $className, $link, $content);
}

function anchorBlockIdLink($idName, $link, $content) {
    $results = '<a id="%s" href="%s">%s</a>';
    return sprintf($results, $idName, $link, $content);
}

function anchorBlock($link, $content) {
    $results = '<a href="%s">%s</a>';
    return sprintf($results, $link, $content);
}

function songBlock($link, $content) {
    $results = '<ol><li><a href="#" data-src="%s">%s</a></li></ol>';
    return sprintf($results, $link, $content);
}

function albumBlock($id, $content) {

    $results = '<a href="#Album" class="%s">%s</a>';
    return sprintf($results, $id, $content);
}

function listItem($content) {
    $results = '<li class="galleryItem">%s</li>';
    return sprintf($results, $content);
}

function unOrderList($content) {
    $results = '<ul class="itemList">%s</ul>';
    return sprintf($results, $content);
}

function imgBlock($idName, $imgLocation) {
    $results = '<img id="%s" src="%s">';
    return sprintf($results, $idName, $imgLocation);
}

function spanBlock($className, $content) {
    $results = '<span class="%s">%s</span>';
    return sprintf($results, $className, $content);
}

function divId($idName, $content) {
    $results = '<div id="%s">%s</div>';
    return sprintf($results, $idName, $content);
}

function divIdClass($idName, $className, $content) {
    $results = '<div id="%s" class="%s">%s</div>';
    return sprintf($results, $idName, $className, $content);
}