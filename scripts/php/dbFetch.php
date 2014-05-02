<?php

$server = 'localhost';
$username = 'root';
$password = 'root';
$schema = 'c199grp07';

$login = @new mysqli($server, $username, $password, $schema);

if($login->connect_error) {
	die("Connect Error: ". $login->connect_error); 
}

?>

<html>
<head>
<title>DB Fetching</title>
</head>

<body>
<p>Test, Hello Jason</p>
<?php
$testQuery = $login;

$userQuery = sprintf("select * from user");
$userResults = $testQuery->query($userQuery);

if (!$userResults) {
    $message  = 'Invalid query: ' . $testQuery->errno . "\n";
    $message .= 'Whole query: ' . $userQuery;
    die($message);
}

// some quick and dirty (gross) format code from query
echo '<table border="1px" cellpadding="5">';
printf('<tr><td colspan="3"><b>User</b></td></tr>');

printf("<tr><td>First Name</td><td>Last name</td><td>Email Address</td></tr>");

while ($row = $userResults->fetch_assoc()) {
    printf('<tr><td>%s<td>%s</td><td>%s</td></tr>', $row['first_name'], $row['last_name'], $row['email_address']);
}
echo "</table>";

$artistQuery = sprintf("select * from artist");
$artistResults = $testQuery->query($artistQuery);

if (!$userResults) {
    $message  = 'Invalid query: ' . $testQuery->errno . "\n";
    $message .= 'Whole query: ' . $artistQuery;
    die($message);
}

$login->close(); // close connection to database

?>

</body>
</html>