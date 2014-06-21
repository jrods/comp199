<?php

if (isset($_POST['username'], $_POST['albumName'], $_POST['fileName'], $_POST['albumPrice'], $_POST['songTitle'], $_POST['songPrice'],$_POST['genre'])) {

    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $albumName = filter_input(INPUT_POST, 'albumName', FILTER_SANITIZE_STRING);
    $fileName = filter_input(INPUT_POST, 'fileName', FILTER_SANITIZE_STRING);
    $albumPrice = filter_input(INPUT_POST, 'albumPrice', FILTER_SANITIZE_STRING);
    $songTitle = filter_input(INPUT_POST, 'songTitle', FILTER_SANITIZE_STRING);
    $songPrice = filter_input(INPUT_POST, 'songPrice', FILTER_SANITIZE_STRING);
    $albumGenre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);
    
    if(strpos($songPrice, '.') !== FALSE){
        str_replace($songPrice, '.', '');
    }

    $rootdir = '';
    $album_id = 0;
    $daterelease = '1000-10-10';

    $mysqli = @new mysqli('localhost', 'c199grp07', 'c199grp07', 'c199grp07');
    if ($mysqli->connect_error) {
        $error_msg = '<p class="error">Database error</p>';
        echo $error_msg;
        die("Connect Error: " . $mysqli->connect_error);
    }

    if (empty($error_msg)) {  

        if ($stmt = $mysqli->prepare("SELECT artist_id
				  FROM artist WHERE artist_name = ? LIMIT 1")) {
        $stmt->bind_param('s', $username);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();

        // get variables from result.
        $stmt->bind_result($artist_id);
        $stmt->fetch();
        } else {
        // Could not create a prepared statement
        header("Location: ../../error.php?err=Database error: cannot prepare statement");
        exit();
    }
    if ($stmt->num_rows == 0) {

            if ($insert_stmt = $mysqli->prepare("INSERT INTO artist (artist_name, root_dir) VALUES (?, ?)")) {
                $insert_stmt->bind_param('ss', $username, $rootdir);

                // Execute the prepared query.
                if ($insert_stmt->execute() == false) {
                    echo $insert_stmt->error;
    
                    header('Location: /error.php?err=Registration failure: INSERT1');
                    $stmt->close();
                    exit();
                }
            }


       // Insert the new user into the database
                
       if ($stmt = $mysqli->prepare("SELECT artist_id
				  FROM artist WHERE artist_name = ? LIMIT 1")) {
        $stmt->bind_param('s', $username);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();

        // get variables from result.
        $stmt->bind_result($artist_id);
        $stmt->fetch();
        } else {
        // Could not create a prepared statement
        header("Location: ../../error.php?err=Database error: cannot prepare statement");
        exit();
    }
}
               // see if album exists
        if ($stmt = $mysqli->prepare("SELECT album_id FROM album WHERE album_title = ? LIMIT 1")) {
                    $stmt->bind_param('s', $albumName);  // Bind "$email" to parameter.
                    $stmt->execute();    // Execute the prepared query.
                    $stmt->store_result();

        // get variables from result.
        $stmt->bind_result($album_id);
        $stmt->fetch();
        } else {

                header('Location: /error.php?err=Registration failure: INSERT1');
                $stmt->close();
                exit();
        }
    if ($stmt->num_rows == 1) {
        if ($update_stmt = $mysqli->prepare("UPDATE album SET album_title = ?, album_price = ?, date_of_release = ? WHERE album_id = ? AND artist_id = ?")) {
            $update_stmt->bind_param('sisii', $albumName, $albumPrice, $daterelease, $album_id, $artist_id);

                // Execute the prepared query.
                if ($update_stmt->execute() == false) {
                    echo $update_stmt->error;

                    header('Location: /error.php?err=Registration failure: INSERT1');
                    $stmt->close();
                    exit();
                }
            }
        } else {

           if ($insert_stmt = $mysqli->prepare("INSERT INTO album(artist_id, album_title, album_price, date_of_release, tags) VALUES (?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('isiss',$artist_id, $albumName, $albumPrice, $daterelease, $albumGenre);

                // Execute the prepared query.
                if ($insert_stmt->execute() == false) {
                    echo $insert_stmt->error;
                    header('Location: /error.php?err=Registration failure: INSERT7');
                    $stmt->close();
                    exit();
                }
            }
            
            if ($stmt = $mysqli->prepare("SELECT album_id FROM album WHERE album_title = ? LIMIT 1")) {
                    $stmt->bind_param('s', $albumName);  // Bind "$email" to parameter.
                    $stmt->execute();    // Execute the prepared query.
                    $stmt->store_result();

            // get variables from result.
            $stmt->bind_result($album_id);
            $stmt->fetch();

            } else {

                    header('Location: /error.php?err=Registration failure: INSERT1');
                    $stmt->close();
                    exit();
            }
    }
    $songNumber = 0;
        if ($stmt = $mysqli->prepare("SELECT max(song_number) FROM song")) {
                    $stmt->execute();    // Execute the prepared query.
                    $stmt->store_result();

            // get variables from result.
            $stmt->bind_result($songNumber);
            $stmt->fetch();
            } else {

                    header('Location: /error.php?err=Registration failure: INSERT1');
                    $stmt->close();
                    exit();
            }
        $songNumber++;
        
        if ($stmt = $mysqli->prepare("SELECT album_id FROM album WHERE album_title = ? LIMIT 1")) {
                    $stmt->bind_param('s', $albumName);  // Bind "$email" to parameter.
                    $stmt->execute();    // Execute the prepared query.
                    $stmt->store_result();

            // get variables from result.
            $stmt->bind_result($album_id);
            $stmt->fetch();
        //echo $songNumber . $songNumber . $album_id . $songTitle . $fileName . $songPrice;
        }
        // Insert the new song into the database
        if ($insert_stmt = $mysqli->prepare("INSERT INTO song (song_number, album_id, song_title, file_name, song_price) VALUES (?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('iissi', $songNumber, $album_id, $songTitle, $fileName, $songPrice);

            // Execute the prepared query.
            if ($insert_stmt->execute() == false) {
                echo $insert_stmt->error;
                header('Location: /error.php?err=Registration failure: INSERTsong' . $songNumber . $album_id . $songTitle . $fileName . $songPrice . '');
                $stmt->close();
                exit();
            }
        }


        $stmt->close();
        header('Location: index.php');
        exit();

    }
}
?>