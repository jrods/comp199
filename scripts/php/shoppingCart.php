<?php
include('db_connect.php');

class Cart
{
    private $correctValue;
    private $totalCart;
    private $login;

    function __construct($server, $username, $password, $schema)
    {
        $this->cartOfItems = array();
        $this->totalCart = 0;
        $this->correctValue = 0;
        $this->login = @new mysqli($server, $username, $password, $schema);
    }

    public function addItem($albumTitle)
    {

        if ($this->login->connect_error) {
            die("Connect Error: " . $this->login->connect_error);
        }

        $baseQuery = "select al.album_price, al.album_title from album al where al.album_title = '%s'; ";
        $baseQuery = sprintf($baseQuery, $albumTitle);

        $results = $this->login->query($baseQuery);

        $album = $results->fetch_assoc();

        $inAlbum = @new Album($album['album_title'], $album['album_price']);

        array_push($this->cartOfItems, $inAlbum);
    }

    public function getTotal()
    {
        $this->totalCart = 0;

        foreach ($this->cartOfItems as $value) {
            $albumPrice = number_format((float)($value->getPrice() / 100), 2, '.', '');
            $this->totalCart += $albumPrice;

        }

        $formattedCart = number_format((float)($this->totalCart), 2, '.', '');
        return $formattedCart;
    }

    public function removeItem($lookingForTitle)
    {

        $testArray = array();

        foreach ($this->cartOfItems as $value) {

            $listAlbumTitle = $value->getName();
            if (strcmp($listAlbumTitle, $lookingForTitle) == 0) {
                continue;
            }

            array_push($testArray, $value);

        }

        $this->cartOfItems = $testArray;

    }
}


class Album
{
    private $albumName;
    private $albumPrice;

    function __construct($inName, $inPrice)
    {
        $this->albumName = $inName;
        $this->albumPrice = $inPrice;
    }

    public function getName()
    {
        return $this->albumName;
    }

    public function getPrice()
    {
        return $this->albumPrice;
    }
}
