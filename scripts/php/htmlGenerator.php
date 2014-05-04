<?php
/**
 * Created by IntelliJ IDEA.
 * User: jared
 * Date: 5/2/2014
 * Time: 10:47 PM
 */

function anchorBlock($idName, $link, $content) {
    $results = '<a id="%s" href="%s">%s</a>';
    return sprintf($results, $idName, $link, $content);
}

function listItem($content) {
    $results = '<li class="item">%s</li>';
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

function divId($className, $content) {
    $results = '<div class="%s">%s</div>';
    return sprintf($results, $className, $content);
}

function divIdClass($idName, $className, $content) {
    $results = '<div id="%s" class="%s">%s</div>';
    return sprintf($results, $idName, $className, $content);
}