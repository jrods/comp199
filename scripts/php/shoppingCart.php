<?php
include('db_connect.php');

class Cart {
    private $correctValue;
    private $totalCart;
    private $login;

    function __construct($server, $username, $password, $schema) {
        $this->cartOfItems = array();
        $this->totalCart = 0;
        $this->correctValue = 0;
        $this->login = @new mysqli($server, $username, $password, $schema);
    }

    public function addItem($albumTitle) {

        if ($this->login->connect_error) {
            die("Connect Error: " . $this->login->connect_error);
        }

        $baseQuery =
            "select al.album_price, al.album_title, ar.artist_name
             from album al, artist ar
             where al.artist_id = ar.artist_id
             and al.album_title = '%s'; ";
        $baseQuery = sprintf($baseQuery, $albumTitle);

        $results = $this->login->query($baseQuery);

        $album = $results->fetch_assoc();

        $inAlbum = @new Album($album['album_title'], $album['album_price'], $album['artist_name']);

        array_push($this->cartOfItems, $inAlbum);
    }

    public function getTotal() {

        $this->totalCart = 0;

        foreach ($this->cartOfItems as $value) {
             $this->totalCart += $value->getPrice();

        }

        $formattedCart = number_format((float)($this->totalCart) / 100, 2, '.', '');
        return $formattedCart;
    }

    public function removeItem($lookingForTitle) {

        $testArray = array();

        foreach ($this->cartOfItems as $value) {

            $listAlbumTitle = $value->getTitle();

            if (strcmp($listAlbumTitle, $lookingForTitle) == 0) {
                continue;
            }

            array_push($testArray, $value);

        }

        $this->cartOfItems = $testArray;

    }
}


class Album {
    private $albumTitle;
    private $artistName;
    private $albumPrice;

    function __construct($inTitle, $inPrice, $inArtist) {
        $this->albumTitle = $inTitle;
        $this->albumPrice = $inPrice;
        $this->artistName = $inArtist;
    }

    public function getTitle() {
        return $this->albumTitle;
    }

    public function getPrice() {
        return $this->albumPrice;
    }

    public function getArtist() {
        return $this->artistName;
    }
}
