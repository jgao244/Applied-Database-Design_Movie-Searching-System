<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Actors & Characters';
include ('includes/header.html');

// Check for form submission:

// echo $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //remember the difference between post and get?

	require ('./mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for an email address:
	if (empty($_POST['Key'])) {  //$_POST is a global variable. empty() method determines whether a variable is considered to be empty.
		$errors[] = 'You forgot to enter the first name';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['Key'])); //mysqli_real_escape_strin()escapes special characters in a string for use in an SQL statement.
	}
	
    if (empty($errors)) { // If there is no errors. If everything's OK.
      // Make the query:
		$q = "SELECT 
DFirstName as FirstName,
DLastName AS LastName,
Gender as gender
FROM Director WHERE
DFirstName like '%$fn%'
OR DLastName like  '%$fn%'";
		$r = @mysqli_query ($dbc, $q); // Run the query.
		$num = mysqli_num_rows($r);
		
	   if ($num > 0) { // If it ran OK, display the records.

	// Print how many users there are:
	   echo "<p>There is the information for the student you are looking for.</p>\n";

	// Table header.
	   echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
	    <tr><td align="left"><b>FirstName</b></td><td align="left"><b>LastName</b></td><td align="left"><b>gender</b></td></tr>
';
	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { //MYSQLI_ASSOC makes the returned array assortative. 
		echo '<tr><td align="left">' . $row['FirstName'] . '</td><td align="left">' . $row['LastName'] . '</td><td align="left">' . $row['gender'] . '</td></tr>
		';
	   }

	echo '</table>'; // Close the table.
			} 
			else { // If it did not run OK.

				// Public message:
				echo '<h1>Error</h1>
				<p class="error">Oops, maybe you miss type the name!</p>'; 
	
			}
			}
			
			mysqli_close($dbc); // Close the database connection.
		} // End of the main Submit conditional.
?>
<h1>Search director by Keyword</h1>
<form action="Director.php" method="post">
	<p>Keyword <input type="text" name="Key" size="15" maxlength="20" value="<?php if (isset($_POST['Key'])) echo $_POST['Key']; ?>" /></p> 
	<p><input type="submit" name="submit" value="Search director" /></p>
	</form>




<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //remember the difference between post and get?

	require ('./mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for an email address:
	if (empty($_POST['last_name'])) {  //$_POST is a global variable. empty() method determines whether a variable is considered to be empty.
		$errors[] = 'You forgot to enter the first name';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name'])); 
		$fn2 = mysqli_real_escape_string($dbc, trim($_POST['last_name']));//mysqli_real_escape_strin()escapes special characters in a string for use in an SQL statement.
	}
	
    if (empty($errors)) { // If there is no errors. If everything's OK.
      // Make the query:
		$q = "SELECT 
CONCAT(DFirstName, ', ', DLastName) AS Name,
Title AS MovieTitle,
Gender AS gender
FROM Director, Movies,DirectorMovie
WHERE  DirectorMovie.MovieID = Movies.MovieID
AND Director.DirectorID = DirectorMovie.DirectorID
AND DFirstName = '$fn' AND
DLastName = '$fn2';";	

		$r = @mysqli_query ($dbc, $q); // Run the query.
		$num = mysqli_num_rows($r);
		
	   if ($num > 0) { // If it ran OK, display the records.

	// Print how many users there are:
	   echo "<p>There is the information for the student you are looking for.</p>\n";

	// Table header.
	   echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
	    <tr><td align="left"><b> Name </b></td><td align="left"><b> MovieTitle </b></td><td align="left"><b>gender </b></td></tr>
';
	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { //MYSQLI_ASSOC makes the returned array assortative. 
		echo '<tr><td align="left">' . $row['Name'] . '</td><td align="left">' . $row['MovieTitle'] . '</td><td align="left">' . $row['gender'] . '</td></tr>
		';
	   }

	echo '</table>'; // Close the table.
			} 
			else { // If it did not run OK.

				// Public message:
				echo '<h1>Error</h1>
				<p class="error">Oops, maybe you miss type the name!</p>'; 
	
			}
			}
			
			mysqli_close($dbc); // Close the database connection.
		} // End of the main Submit conditional.
?>
<h1>Or Search director by full Name</h1>
<form action="Director.php" method="post">
	<p>First Name <input type="text" name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p> 
	<p>Last Name <input type="text" name="last_name" size="15" maxlength="20" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p> 
	<p><input type="submit" name="submit" value="Search Actor" /></p>
<p>This page can help you find the information of director and movie he or she produced. Considering forgetting the specific name of the director, you can first search the full name by just entering any keyword of the directors' name. At this time, you will get the full name and gender of the director. Then if you are still interested in this director, you can find his or her information in the below search by simply copy and paste the first name and last name of the director. At this time, you will get the full name, the movie the director produced as well as the gender just to make sure it's the same person you are interested in. Or if you are sure you remember the full name correctly, you can simply enter the first name and last name to get the movie information!</p>
	</form>


<?php include ('includes/footer.html'); ?>




