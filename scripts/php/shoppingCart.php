<?php
include('db_connect.php');

class Cart {
    private $cartOfItems = array();
    private $totalCart;
    private $correctValue;

    function __construct(){
        //$cartOfItems = array();
        $totalCart = 0;

    }

    public function addItem($albumTitle){
        
        $server = 'localhost';
        $username = 'c199grp07';
        $password = 'c199grp07';
        $schema = 'c199grp07';

        $login = @new mysqli($server, $username, $password, $schema);

        if($login->connect_error) {
            die("Connect Error: ". $login->connect_error);
        }

        $testQuery = $login;
        
        $baseQuery =
           "select al.album_price, al.album_title
            from album al
            where al.album_title = '%s';
           ";
        $baseQuery = sprintf($baseQuery, $albumTitle);
        $results = $testQuery->query($baseQuery);

        $album = $results;
        array_push($this->cartOfItems, $album);
    }

    public function getTotal(){
        /*
        $albumTemp = self::$cartOfItems[0];
        $album = $albumTemp->fetch_object();
        echo $album->album_price;  */

        foreach($this->cartOfItems as $value){

            $album = $value->fetch_assoc();
            //echo gettype($album);
            $correctValue = number_format((float)($album["album_price"] / 100), 2, '.', '');
            $this->totalCart += $correctValue;

        }
        $this->totalCart = number_format((float)($this->totalCart), 2, '.', '');
        return $this->totalCart;
    }

    public function removeItem($albumTitle){
      
                $server = 'localhost';
        $username = 'c199grp07';
        $password = 'c199grp07';
        $schema = 'c199grp07';

        $login = @new mysqli($server, $username, $password, $schema);

        if($login->connect_error) {
            die("Connect Error: ". $login->connect_error);
        }

        $testQuery = $login;
        
        $baseQuery =
           "select al.album_price, al.album_title
            from album al
            where al.album_title = '%s';
           ";
        $baseQuery = sprintf($baseQuery, $albumTitle);
        $results = $testQuery->query($baseQuery);

        $album = $results;

        $testArray = array();
        foreach($this->cartOfItems as $value){
            $album = $value->fetch_assoc();
            echo gettype($value);
            if(strcmp($album["album_title"],$albumTitle) == 0){
                continue;
            }
            array_push($testArray, $album);

        }
        $this->cartOfItems = $testArray;

    }
}
