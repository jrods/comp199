<?php
set_time_limit(0);
$url = 'http://23.226.228.26/userupload/uploadImage.php'; // change to your form action url.
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
$albumID = -1;
}

  $mysqli = @new mysqli('localhost', 'c199grp07', 'c199grp07', 'c199grp07');
          if ($mysqli->connect_error) {
             $error_msg = '<p class="error">Database error</p>';
             echo $error_msg;
             die("Connect Error: " . $mysqli->connect_error);
         }

         if (empty($error_msg)) {

        if ($stmt = $mysqli->prepare("SELECT AUTO_INCREMENT
				      FROM INFORMATION_SCHEMA.TABLES
                                      WHERE TABLE_SCHEMA = 'c199grp07'
                                      AND TABLE_NAME = 'album'")) {
            $stmt->execute();    // Execute the prepared query.
            $stmt->store_result();

            // get variables from result.
            $stmt->bind_result($albumID);
            $stmt->fetch();
        } else {
            // Could not create a prepared statement
            header("Location: ../../error.php?err=Database error: cannot prepare statement");
            exit();
        }

        }

        print "<form enctype=\"multipart/form-data\" action=\"http://23.226.228.26/userupload/uploadImage.php\" method=\"post\" >\n";
        print '<p>
        <br>

            <input type="hidden" value ="'. $_SESSION['username'] .'" name="username" id="username"/>
            <input type="hidden" name="albumName" id="albumName" value ="'. $_POST['albumName'] .'" />
            <input type="hidden" name="genre" id="genre" value ="'. $_POST['genre'] .'" />
            <input type="hidden" name="albumID" id="albumID" value ="'. $albumID .'" />
            <input type="hidden" value ="'. $_POST['fileName'] .'" name="fileName" id="fileName"/>
            <div id="albumPrice" class="label">Album Price:</div>
            <input type="text" name="albumPrice" id="albumPrice"/>
            <div id="songTitle" class="label">Song Title:</div>
            <input type="text" name="songTitle" id="songTitle"/>
            <div id="songPrice" class="label">Song Price:</div>
            <input type="text" name="songPrice" id="songPrice"/>
            <br>
            File name:<input type="file" name="file">
            <br>
            <input type="submit" name="Submit" value="Submit">
        </p>';
        print "</form>";
        
?>