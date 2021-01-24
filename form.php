<?php
	$name = '';
	$password = '';
	$gender = '';
	$color = '';
	$languages = [];
	$comments = '';
	$tc = '';

	if(isset($_POST['submit'])) {

		if (isset($_POST['name'])) {
			$name = $_POST['name'];
		};

		if (isset($_POST['password'])) {
			$password = $_POST['password'];
		};

		if (isset($_POST['gender'])) {
			$gender = $_POST['gender'];
		};

		if (isset($_POST['color'])) {
			$color = $_POST['color'];
		};

		if (isset($_POST['languages'])) {
			$languages = $_POST['languages'];
		};

		if (isset($_POST['comments'])) {
			$comments = $_POST['comments'];
		};

		if (isset($_POST['tc'])) {
			$tc = $_POST['tc'];
		};

		printf('User name: %s
		<br>Password: %s
		<br>Gender: %s
		<br>Color: %s
		<br>Language(s): %s
		<br>Comments: %s
		<br>T&C: %s',
		htmlspecialchars($name, ENT_QUOTES),
		htmlspecialchars($password, ENT_QUOTES),
		htmlspecialchars($gender, ENT_QUOTES),
		htmlspecialchars($color, ENT_QUOTES),
		htmlspecialchars(implode(' ', $languages), ENT_QUOTES),
		htmlspecialchars($comments, ENT_QUOTES),
		htmlspecialchars($tc, ENT_QUOTES));
		//echo htmlspecialchars($_POST['searchterm'], ENT_QUOTES);

		$db = new mysqli('localhost','phpuser','test1234','php');
		if(isset($_POST['name']) && isset($_POST['gender']) && isset($_POST['color'])) {
			$sql = sprintf(
				"INSERT INTO users (name, gender, color) 
				VALUES ('%s','%s', '%s')" ,
				$db->real_escape_string($name),
				$db->real_escape_string($gender),
				$db->real_escape_string($color),
			);
			$db->query($sql);
			printf('<br>details added');
		}
		else {
			printf('<br>blank fields');
		}
		$db->close();
	}
?>

<form action="" method="post">
	User name: <input type="text" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>"><br>
	Password: <input type="password" value="password"><br>
	Gender:
	<div>
		<input type="radio" name="gender" value="f"> Female
		<input type="radio" name="gender" value="m"> Male
		<input type="radio" name="gender" value="o"> Other <br>
	</div>
	<select name="color">
		<option value="">Please select</option>
		<option value="#f00">Red</option>
		<option value="#0f0">Green</option>
		<option value="#00f">Blue</option>
	</select>
	Language spoken:
	<select name="languages[]" multiple size="3">
	<option value="en">English</option>
	<option value="fr">French</option>
	<option value="it">Italian</option>
	</select><br>
	Comments: <textarea name="comments"></textarea><br>
	<input type="checkbox" name="tc" value="ok">
	I accept the T&C
	<input type="submit" name="submit" value="Search">
</form>
