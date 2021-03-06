<?php

/* 
 * Copyright (C) 2013 peter
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

//include_once 'db_connect.php';
//include_once 'psl-config.php';


$error_msg = "";


if (isset($_POST['username'], $_POST['email'], $_POST['bday'], $_POST['firstname'], $_POST['lastname'], $_POST['p'])) {

    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $bday = filter_input(INPUT_POST, 'bday', FILTER_SANITIZE_STRING);
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
    
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }

    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.

    $mysqli = @new mysqli('localhost', 'c199grp07', 'c199grp07', 'c199grp07');

    if ($mysqli->connect_error) {
        die("Connect Error: " . $mysqli->connect_error);
    }

    $prep_stmt = "SELECT user_id FROM user WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error_msg = '<p class="error">A user with this username already exists.</p>';
            echo $error_msg;
            $stmt->close();
            die;
        }

    } else {
        $error_msg = '<p class="error">Database error</p>';
        echo $error_msg;
        die;
    }

    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.

    if (empty($error_msg)) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Create salted password 
        $password = hash('sha512', $password . $random_salt);

        // Insert the new user into the database
        if ($insert_stmt = $mysqli->prepare("INSERT INTO user (username, birth_date, first_name, last_name, email_address, not_a_password, salt) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('sssssss', $username, $bday, $firstname, $lastname, $email, $password, $random_salt);

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
}