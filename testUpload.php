<?php
// Upload a file to remote server.
// Upload file field on form having multipart/form-data.
// written by scriptime.blogspot.in
set_time_limit(0);
$url = 'http://23.226.228.26/userupload/uploader.php'; // change to your form action url.
$field_name1 = 'file'; // please edit it according to your form file field name.
$field_name2 = 'newAlbum';
//$field_name2 = 'newAlbum';
if (isset($_FILES['file']))
{
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POSTFIELDS, array("$field_name1"=>"@".$_FILES['file']['tmp_name']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);
echo $result;
}

{
        if (login_check($mysqli) == true) {
          $mysqli = @new mysqli('localhost', 'c199grp07', 'c199grp07', 'c199grp07');
          if ($mysqli->connect_error) {
             $error_msg = '<p class="error">Database error</p>';
             echo $error_msg;
             die("Connect Error: " . $mysqli->connect_error);
         }
         
         $albumName = '';
         $username = $_SESSION['username'];
         $genre = '';

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

            if ($stmt->num_rows != 0) {

            if ($stmt = $mysqli->prepare("SELECT album_title, album_price
                              FROM album WHERE artist_id = " . $artist_id)) {
            $stmt->execute();    // Execute the prepared query.
            $stmt->store_result();
            $metaResults = $stmt->result_metadata();
            $fields = $metaResults->fetch_fields();
            $statementParams='';
            
            foreach($fields as $field){
                if(empty($statementParams)){
                    $statementParams.="\$column['".$field->name."']";
                }else{
                    $statementParams.=", \$column['".$field->name."']";
                }
            }
          $statment="\$stmt->bind_result($statementParams);";
          eval($statment);

        } else {
            // Could not create a prepared statement
            header("Location: ../../error.php?err=Database error: cannot prepare statement");
            exit();
        }
//upload to existing album
            print "<br>Upload To Existing Album
            <form enctype=\"multipart/form-data\" "
            . "action=\"http://23.226.228.26/userupload/uploader.php\" method=\"post\" >\n";

            print '<p>
            <select name="albumName">';
            while($stmt->fetch()){
                echo '<option value ="'. $column['album_title'] .'">' . $column['album_title'] . '</option>';
                echo '<input type="hidden" name="albumPrice" value="'. $column['album_price'] .'">';
            }
           
           if ($stmt = $mysqli->prepare("SELECT tags
                              FROM album WHERE artist_id = " . $artist_id)) {
            $stmt->execute();    // Execute the prepared query.
            $stmt->store_result();

            // get variables from result.
            $stmt->bind_result($genre);
            $stmt->fetch();
        } else {
            // Could not create a prepared statement
            header("Location: ../../error.php?err=Database error: cannot prepare statement");
            exit();
        }

        print '</select>';
        ?>
        <input type="hidden" name="genre" value="<?php echo $genre; ?>">
        
        <input type="hidden" name="origURL" value ="<?php echo $_SERVER['PHP_SELF']; ?>">
        File name:<input type="file" name="file">
        <br>
        mp3/wav format only
        </p>
        <p>
        <input type="submit" name="Submit" value="Submit">
        </p>

        <?php
        print "</form>Upload To New Album";

        }
}
//upload to new album       
        print "<form enctype=\"multipart/form-data\" action=\"http://23.226.228.26/userupload/uploader.php\" method=\"post\" >\n";
        print '<p>
        <br>

        <br>
        Album Name: <input type="text" name="albumName">
        <br>
        Genre: <input type="text" name="genre">
        <br>
        File name:<input type="file" name="file">
        <br>
        mp3/wav format only
        </p>
        <p>
        <input type="submit" name="Submit" value="Submit">
        </p>';      
        print "</form>";

    } else {
        echo "Log in to upload songs";
    }
}
?>