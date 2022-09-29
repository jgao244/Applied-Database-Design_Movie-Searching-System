<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Actors';
include ('includes/header.html');

// Check for form submission:

// echo $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //remember the difference between post and get?

	require ('./mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for an email address:
	if (empty($_POST['first_name'])) {  //$_POST is a global variable. empty() method determines whether a variable is considered to be empty.
		$errors[] = 'You forgot to enter the first name';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name'])); //mysqli_real_escape_strin()escapes special characters in a string for use in an SQL statement.
	}
	
    if (empty($errors)) { // If there is no errors. If everything's OK.
      // Make the query:
		$q = "SELECT CONCAT(ActorFirstName, ', ', ActorLastName) AS Name, CharacterName, Title FROM Actors, Movies,Characters 
			where Movies.MovieID = Characters.MovieID AND
 			Characters.ActorID = Actors.ActorID AND
 			ActorFirstName = '$fn'
 			Order by CharacterName desc";	
		$r = @mysqli_query ($dbc, $q); // Run the query.
		$num = mysqli_num_rows($r);
		
	   if ($num > 0) { // If it ran OK, display the records.

	// Print how many users there are:
	   echo "<p>There is the information for the student you are looking for.</p>\n";

	// Table header.
	   echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
	    <tr><td align="left"><b>Name</b></td><td align="left"><b>Character</b></td><td align="left"><b>Movie</b></td></tr>
';
	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { //MYSQLI_ASSOC makes the returned array assortative. 
		echo '<tr><td align="left">' . $row['Name'] . '</td><td align="left">' . $row['CharacterName'] . '</td><td align="left">' . $row['Title'] . '</td></tr>
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
<h1>Search Actors by First Name</h1>
<form action="Actor.php" method="post">
	<p>First Name <input type="text" name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p> 
	<p><input type="submit" name="submit" value="Search Actor" /></p>
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
		$fn = mysqli_real_escape_string($dbc, trim($_POST['last_name'])); //mysqli_real_escape_strin()escapes special characters in a string for use in an SQL statement.
	}
	
    if (empty($errors)) { // If there is no errors. If everything's OK.
      // Make the query:
		$q = "SELECT CONCAT(ActorFirstName, ', ', ActorLastName) AS Name, CharacterName, Title FROM Actors, Movies,Characters 
			where Movies.MovieID = Characters.MovieID AND
 			Characters.ActorID = Actors.ActorID AND
 			ActorLastName = '$fn'
 			Order by CharacterName desc";	
		$r = @mysqli_query ($dbc, $q); // Run the query.
		$num = mysqli_num_rows($r);
		
	   if ($num > 0) { // If it ran OK, display the records.

	// Print how many users there are:
	   echo "<p>There is the information for the student you are looking for.</p>\n";

	// Table header.
	   echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
	    <tr><td align="left"><b>Name</b></td><td align="left"><b>Character</b></td><td align="left"><b>Movie</b></td></tr>
';
	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { //MYSQLI_ASSOC makes the returned array assortative. 
		echo '<tr><td align="left">' . $row['Name'] . '</td><td align="left">' . $row['CharacterName'] . '</td><td align="left">' . $row['Title'] . '</td></tr>
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
<h1>Search Actors by Last Name</h1>
<form action="Actor.php" method="post">
	<p>Last Name <input type="text" name="last_name" size="15" maxlength="20" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p> 
	<p><input type="submit" name="submit" value="Search Actor" /></p>
<p>You can search the information of information including the name of the actor, the corresponding character of the actor, as well as the corresponding movie. You can search it by inputting either first name or last name </p>
	</form>


<?php include ('includes/footer.html'); ?>

