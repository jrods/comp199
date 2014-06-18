<?php

if (isset($_POST['username'], $_POST['albumName'], $_POST['fileName'], $_POST['albumPrice'], $_POST['songTitle'], $_POST['songPrice'])) {

    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $albumName = filter_input(INPUT_POST, 'albumName', FILTER_SANITIZE_STRING);
    $fileName = filter_input(INPUT_POST, 'fileName', FILTER_SANITIZE_STRING);
    $albumPrice = filter_input(INPUT_POST, 'albumPrice', FILTER_SANITIZE_STRING);
    $songTitle = filter_input(INPUT_POST, 'albumPrice', FILTER_SANITIZE_STRING);
    $songPrice = filter_input(INPUT_POST, 'albumPrice', FILTER_SANITIZE_STRING);
    $rootdir = '';

    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.

    $mysqli = @new mysqli('localhost', 'c199grp07', 'c199grp07', 'c199grp07');
    if ($mysqli->connect_error) {
        $error_msg = '<p class="error">Database error</p>';
        echo $error_msg;
        die("Connect Error: " . $mysqli->connect_error);
    }

    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.

    if (empty($error_msg)) {

        // Insert the new user into the database
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

        if ($stmt = $mysqli->prepare("SELECT artist_id
				  FROM artist WHERE artist_name = ? LIMIT 1")) {
        $stmt->bind_param('i', $username);  // Bind "$email" to parameter.
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
       $artist_id = 5;
       $daterelease = '1000-10-10';
                // Insert the new user into the database
        if ($insert_stmt = $mysqli->prepare("INSERT INTO album (artist_id, album_title, album_price, date_of_release) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('isis',$artist_id, $albumName, $albumPrice, $daterelease);

            // Execute the prepared query.
            if ($insert_stmt->execute() == false) {
                echo $insert_stmt->error;
                //header('Location: /error.php?err=Registration failure: INSERT2');
                $stmt->close();
                exit();
            }
        }

                // Insert the new user into the database
        if ($insert_stmt = $mysqli->prepare("INSERT INTO song (album_id, song_title, file_name, song_price) VALUES (?, ?, ?)")) {
            $insert_stmt->bind_param('ssi', $songName, $fileName, $songPrice);

            // Execute the prepared query.
            if ($insert_stmt->execute() == false) {
                echo $insert_stmt->error;
                header('Location: /error.php?err=Registration failure: INSERT');
                $stmt->close();
                exit();
            }
        }

        $stmt->close();
        header('Location: index.php');
        exit();
    }
?>