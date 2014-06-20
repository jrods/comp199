<?php

class Cart {
    private $correctValue;
    private $totalCart;
    private $login;

    function __construct($server, $username, $password, $schema) {
        $this->cartOfItems = array();
        $this->totalCart = 0;
        $this->correctValue = 0;
        $this->login = new mysqli($server, $username, $password, $schema);
    }

    public function getAllItems(){
        return $this->cartOfItems;
    }

    public function clearCart() {
        $this->cartOfItems = array();
    }

    public function getAnItem($albumTitle) {

        foreach($this->cartOfItems as $item) {

            if($item->getTitle() == $albumTitle) {
                return $item;
            }
        }

        return null;
    }

    public function addItem($albumToAdd) {

        $result = $this->dbGetAlbum($albumToAdd);

        $newAlbum = @new Album($result['album_title'], $result['album_price'], $result['artist_name']);

        array_push($this->cartOfItems, $newAlbum);

        $this->totalCart += $result['album_price'];

    }

    public function getTotal() {
        if($this->totalCart <= 0) {
            return '0.00';
        }

        $formattedCart = number_format((float)($this->totalCart) / 100, 2, '.', '');
        return $formattedCart;
    }

    public function removeItem($lookingForTitle) {

        $copyCart = array();

        $this->totalCart = 0;

        foreach ($this->cartOfItems as $value) {

            $listAlbumTitle = $value->getTitle();

            if (strcmp($listAlbumTitle, $lookingForTitle) == 0) {
                // album skipped from being put on the new list
                continue;
            }

            $this->totalCart += $value->getPrice();

            array_push($copyCart, $value);
        }

        $this->cartOfItems = $copyCart;
    }

    public function repopulateCart($copyCartSession) {
        foreach($copyCartSession as $item) {
            $this->addItem($item);
        }
    }

    private function dbGetAlbum($album) {

        $this->login->connect(HOST, USER, PASSWORD, DATABASE);

        if($this->login->connect_error) {
            die("Connect Error: " . $this->login->connect_error);
        }

        $baseQuery = "select al.album_title, al.album_price, ar.artist_name
                      from album al, artist ar
                      where al.artist_id = ar.artist_id
                      and al.album_title = ? LIMIT 1";

        $query = $this->login->prepare($baseQuery);

        if(!$query) {
            $message = 'Invalid query: ' . $query->errno . "<br />";
            $message .= 'Whole query: ' . $baseQuery;
            die($message);
        }

        $query->bind_param('s', $album);
        $query->execute();
        $query->bind_result($album_title, $album_price, $artist_name);
        $query->fetch();

        return array('album_title' => $album_title, 'album_price' => $album_price, 'artist_name' => $artist_name);

        $this->login->close();
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
