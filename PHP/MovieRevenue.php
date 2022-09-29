<?php # Script 9.5 - ClassRoster.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Company';
include ('includes/header.html');

// Check for form submission:

// echo $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
	require ('./mysqli_connect.php'); 
	
	if (empty($_POST['movie_name'])) {  
		
		if (empty($_POST['gross'])) {
			$q = "SELECT 
			Title as MovieName,
			Gross AS GrossRevenue,
			Runtime as Duration
			FROM Movies";
		}else{
			$fn2 = mysqli_real_escape_string($dbc, trim($_POST['gross']));
			$q = "SELECT 
			Title as MovieName,
			Gross AS GrossRevenue,
			Runtime as Duration
			FROM Movies WHERE
			Gross >= $fn2";
		}

   } else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['movie_name'])); 
		
        if (empty($_POST['gross'])) {
			$q = "SELECT 
			Title as MovieName,
			Gross AS GrossRevenue,
			Runtime as Duration
			FROM Movies WHERE
			Title like '%$fn%'";
		}else{
			$fn2 = mysqli_real_escape_string($dbc, trim($_POST['gross']));
			$q = "SELECT 
			Title as MovieName,
			Gross AS GrossRevenue,
			Runtime as Duration
			FROM Movies WHERE
			Title like '%$fn%'
			AND Gross >= $fn2 ";
		}

	}

	/*
	$fn = mysqli_real_escape_string($dbc, trim($_POST['movie_name'])); 
	$fn2 = mysqli_real_escape_string($dbc, trim($_POST['gross']));
	$q = "SELECT 
	Title as MovieName,
	Gross AS GrossRevenue,
	Runtime as Duration
	FROM Movies WHERE
	Title like '%$fn%'
	AND Gross >= $fn2 ";
    */
    
    	
    $r = @mysqli_query ($dbc, $q); // Run the query.
	$num = mysqli_num_rows($r);
		
    if ($num > 0) { // If it ran OK, display the records.

	   
	   
	   
	   
	// Print how many users there are:
	    echo "<p>There is the information for the course you are looking for.</p>\n";

	// Table header.
	    echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
	    <tr><td align="left"><b>Movie</b></td><td align="left"><b>GrossRevenue</b></td><td align="left"><b>Duration</b></td></tr>';
	
	// Fetch and print all the records:
	    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { //MYSQLI_ASSOC makes the returned array assortative. 
		    echo '<tr><td align="left">' . $row['MovieName'] . '</td><td align="left">' . $row['GrossRevenue'] . '</td><td align="left">' . $row['Duration'] . '</td></tr>
		    ';
	    }
 
	    echo '</table>'; // Close the table.
	  } 
	  else { // If it did not run OK.

				// Public message:
		  echo '<h1>Error</h1>
		  <p class="error">There is no movie roster match with the information you provided</p>'; 
	  }
  
			
	mysqli_close($dbc); // Close the database connection.
} // End of the main Submit conditional.
?>
<h1>Movie Revenue</h1>
<form action="MovieRevenue.php" method="post">
	<p>Movie Name <input type="text" name="movie_name" size="15" maxlength="50" value="<?php if (isset($_POST['movie_name'])) echo $_POST['movie_name']; ?>" /></p>
	<p>With Gross Revenue Equal and Greater Than <input type="text" name="gross" size="15" maxlength="40" value="<?php if (isset($_POST['gross'])) echo $_POST['gross']; ?>" /></p>



		
		
	<p><input type="submit" name="submit" value="Show Information" /></p>
	<p>You can search the information of the movie name, gross revenue, and duration by putting any keyword of the movie title, gross revenue range, or both of the information</p>
</form>

<?php include ('includes/footer.html'); ?>