<!DOCTYPE html>
<html>
<style>
	body{background-color: #F7E4F7;}
</style>
	<head>
		<title>Language Query</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../../main.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	</head>

	<body>
		<!-- Connect to database -->
		<?php
			$servername = "localhost";
			$username = "sayft1";
			$password = "masonjackie666%$#@!";
			$dbname = "sayft1_WORLD_Assignment2";

			$conn = mysqli_connect($servername, $username, $password, $dbname);

			if (!$conn){
				die("Conection failed: ". mysqli_connect_error);
			}
		?>

		<?php

			$CountryCode = $_POST['CountryCode'];
			$Language = $_POST['Language'];
			$IsOfficial = $_POST['IsOfficial'];
			$Percentage = $_POST['Percentage'];

			$sql = "SELECT CountryCode, Language, IsOfficial, Percentage FROM LANG WHERE (CountryCode LIKE '%$CountryCode%' OR CountryCode IS NULL) AND 
																						 (Language LIKE '%$Language%' OR Language IS NULL) AND 
																						 (IsOfficial LIKE '%$IsOfficial%' OR IsOfficial IS NULL) AND 
																						 (Percentage LIKE '%$Percentage%' OR IsOfficial IS NULL)";



			mysqli_set_charset($conn,"utf8");

			$result = mysqli_query($conn, $sql);

			$affected = mysqli_affected_rows($conn);
		?>

		<div class="navbar">
			<a href="https://www.nottingham.edu.my/CorporateMarketing/Services/Service-Details/University-website.aspx" style="padding: 0px 0px;padding-right: 10px;"><img height="50" src="../../NOTTpng.png" width="140" /></a>
			<a href="../language.php">Back</a>
			<a href="../../city/city.php">City</a>
		  	<a href="../../country/country.php">Country</a>
		  	<a href="../language.php">Language</a>
		</div>

		<div class="main">
			<h2>Query result</h2>
			<?php echo " <p>Number of result: {$affected}</p>"; ?>
			<!-- Start table -->
			<table>
				<tr>
					<th>CountryCode</th>
					<th>Language</th>
					<th>IsOfficial</th>
					<th>Percentage</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>

				<?php
				while($row = mysqli_fetch_array($result)):
				?>

				<tr>
					<td><?php echo $row['CountryCode']; ?></td>
					<td><?php echo $row['Language']; ?></td>
					<td><?php echo $row['IsOfficial']; ?></td>
					<td><?php echo $row['Percentage']; ?></td>
					<td class="edit">
		    			<form action='../edit/edit.php' method="post">
		        			<input type="hidden" name="CountryCode" value="<?php echo $row['CountryCode'];?>">
		        			<input type="hidden" name="Language" 	value="<?php echo $row['Language'];?>">
		        			<input type="submit" name="submit" value="Edit">
		    			</form>
					</td>
					<td class="delete">
		    			<form action='../delete/delete.php' method="post">
		        			<input type="hidden" name="CountryCode" value="<?php echo $row['CountryCode'];?>">
		        			<input type="hidden" name="Language" 	value="<?php echo $row['Language'];?>">
		        			<input type="submit" name="submit" value="Delete">
		    			</form>
					</td>
				</tr>

			<?php endwhile; ?>
			</table>
		</div>

		<?php $conn-> close(); ?>
	</body>

</html>