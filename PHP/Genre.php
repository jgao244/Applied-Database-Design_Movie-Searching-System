<?php # Script 9.5 - ClassRoster.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Movie Roster';
include ('includes/header.html');

// Check for form submission:

// echo $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //remember the difference between post and get?

	require ('./mysqli_connect.php'); // Connect to the db.
		
	
	// Check for an courese information:
	if (empty($_POST['company_name'])) {  
		$fn2 = mysqli_real_escape_string($dbc, trim($_POST['Genre']));
    if ($fn2=='All'){
      $q = "SELECT 
      GenreName AS MovieType,
      Title AS MovieName,
      CompanyName as Company
      FROM Genre, Movies,MovieGenre, Company, CompanyMovie
      WHERE  Movies.MovieID = MovieGenre.MovieID
      AND MovieGenre.GenreID = Genre.GenreID
      AND Movies.MovieID = CompanyMovie.MovieID
      AND CompanyMovie.CompanyID = Company.CompanyID";
    }
    else{
    	$q = "SELECT 
      GenreName AS MovieType,
      Title AS MovieName,
      CompanyName as Company
      FROM Genre, Movies,MovieGenre, Company, CompanyMovie
      WHERE  Movies.MovieID = MovieGenre.MovieID
      AND MovieGenre.GenreID = Genre.GenreID
      AND Movies.MovieID = CompanyMovie.MovieID
      AND CompanyMovie.CompanyID = Company.CompanyID
      AND GenreName = '$fn2'";
    }

	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['company_name'])); 
		$fn2 = mysqli_real_escape_string($dbc, trim($_POST['Genre']));
    if ($fn2=='All'){
      $q = "SELECT 
      GenreName AS MovieType,
      Title AS MovieName,
      CompanyName as Company
      FROM Genre, Movies,MovieGenre, Company, CompanyMovie
      WHERE  Movies.MovieID = MovieGenre.MovieID
      AND MovieGenre.GenreID = Genre.GenreID
      AND Movies.MovieID = CompanyMovie.MovieID
      AND CompanyMovie.CompanyID = Company.CompanyID
      AND CompanyName like '%$fn%'";
    }
    else{
    	$q = "SELECT 
      GenreName AS MovieType,
      Title AS MovieName,
      CompanyName as Company
      FROM Genre, Movies,MovieGenre, Company, CompanyMovie
      WHERE  Movies.MovieID = MovieGenre.MovieID
      AND MovieGenre.GenreID = Genre.GenreID
      AND Movies.MovieID = CompanyMovie.MovieID
      AND CompanyMovie.CompanyID = Company.CompanyID
      AND CompanyName like '%$fn%'
      AND GenreName = '$fn2'";
    }

	}
	
    
    
    	
    $r = @mysqli_query ($dbc, $q); // Run the query.
	  $num = mysqli_num_rows($r);
		
	  if ($num > 0) { // If it ran OK, display the records.

	   
	   
	   
	   
	// Print how many users there are:
	    echo "<p>There is the information for the course you are looking for.</p>\n";

	// Table header.
	    echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
	    <tr><td align="left"><b>Genre</b></td><td align="left"><b>Movie Name</b></td><td align="left"><b>Company Name</b></td></tr>';
	
	// Fetch and print all the records:
	    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { //MYSQLI_ASSOC makes the returned array assortative. 
		    echo '<tr><td align="left">' . $row['MovieType'] . '</td><td align="left">' . $row['MovieName'] . '</td><td align="left">' . $row['Company'] . '</td></tr>
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
<h1>Movie Roster</h1>
<form action="Genre.php" method="post">
	<p>Company Name <input type="text" name="company_name" size="15" maxlength="50" value="<?php if (isset($_POST['company_name'])) echo $_POST['company_name']; ?>" /></p>
	
	<label for="Genre">Choose a Genre:</label>
	<p>Genre 
		<select name="Genre" id="SemesterName">
			<option value="All">All</option>
			<option value="Drama">Drama</option>
		  <option value="Crime">Crime</option>
		  <option value="Action">Action</option>
		  <option value="Adventure">Adventure</option>
			<option value="Biography">Biography</option>
		  <option value="Romance">Romance</option>
		  <option value="Western">Western</option>
			<option value="Sci-Fi">Sci-Fi</option>
		  <option value="Comedy">Comedy</option>
		  <option value="Animation">Animation</option>
		  <option value="War">War</option>
			<option value="Mystery">Mystery</option>
		  <option value="Fantasy">Fantasy</option>
		  <option value="Thriller">Thriller</option>
		  <option value="Horror">Horror</option>
		  <option value="History">History</option>
			<option value="Family">Family</option>
		  <option value="Music">Music</option>



		</select></p>

		
		
	<p><input type="submit" name="submit" value="Show Information" /></p>
<p>You can get information including the Genre, movie name, and production company of the movie. You can do this by simply enter any keywords of the company name (don't have to be full name) and use the dropdown box to select the movie genre. If you leave the company name blank and choose all for the movie genre, you will get information for all genre; if you leave the company name blank, but did choose a certain genre, you will get all movies for that specific genre; if you enter words for company name, but choose all for the genre, you will get all movie that corresponding company produce regardless of the movie genre; if you enter words for company name and made a choice in the genre, you will get information for the movie that produced by certain company with certain genre</p>
</form>

<?php include ('includes/footer.html'); ?>