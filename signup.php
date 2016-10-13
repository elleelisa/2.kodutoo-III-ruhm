<?php

	require("../../../config.php");
	require("functions.php");
	
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	
	//kui kasutaja on sisse loginud, siis suuna data lehele
	if(isset ($_SESSION["userId"])) {
		header("Location: data.php");
		exit();

	}
	
	$signupEmailError = "";
	$signupEmail = "";
	
	if (isset ($_POST["signupEmail"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		//kas oli tühi
		if (empty ($_POST["signupEmail"])) {
			
			//oli tõesti tühi
			$signupEmailError = "See väli on kohustuslik";
			
		} else {
			//kõik korras, email ei ole tühi ja on olemas
			$signupEmail = $_POST["signupEmail"];
			
		}
	
	}

	$signupPasswordError = "";


	//kas on üldse olemas
	if (isset ($_POST["signupPassword"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		//kas oli tühi
		if (empty ($_POST["signupPassword"])) {
			
			//oli tõesti tühi
			$signupPasswordError = "See väli on kohustuslik";
			
		} else {

			//oli midagi, ei olnud tühi

			// kas pikkus vähemalt 8
			if (strlen ($_POST["signupPassword"]) < 8 ) {

				$signupPasswordError = "Parool peab olema vähemalt 8 tm pikk!";
			}
		}
	}
	
	


	$gender = "";
	if(isset($_POST["gender"])) {
		if(!empty($_POST["gender"])){

			//on olemas ja ei ole tühi
			$gender = $_POST["gender"];
		}
	}
	
	if (isset($_POST["signupEmail"]) &&
		 	isset($_POST["signupPassword"]) &&
		 	$signupEmailError == "" && 
		 	empty($signupPasswordError)
		) {
			
			// ühtegi viga ei ole, kõik vajalik olemas
		
			echo "salvestan...<br>";
			echo "email ".$signupEmail."<br>";
			echo "parool ".$_POST["signupPassword"]."<br>";
		
			$password = hash("sha512", $_POST["signupPassword"]);
		
			echo "räsi ".$password."<br>";
		
			//kutsun funktsiooni, et salvestada
			signup($signupEmail, $password);

	}
	
	$notice = "";	
	//mõlemad login vormi väljas on täidetud
	if (	isset($_POST["loginEmail"]) &&
				isset($_POST["loginPassword"]) &&
				!empty($_POST["loginEmail"]) &&
				!empty($_POST["loginPassword"])
	) {

			login($_POST["loginEmail"], $_POST["loginPassword"]);
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise leht</title>
	</head>
	<body>

		<h1>Logi sisse</h1>
		
		
		<form method="POST">
			
			<input placeholder="E-mail" name="loginEmail" type="email">
			
			<br><br>
			
			<input placeholder="Parool" name="loginPassword" type="password">
			
			
			<br><br>
			
			<input type="submit">
			
		
		</form>

	</body>
</html>


<html>
	<head>
		<title>Sisselogimise leht</title>
	</head>
	<body>

		<h1>Loo kasutaja</h1>
		
		
		<form method="POST">
			<label>Eesnimi</label><br>
			<input name="Firstname" type="text"> 	

			<br><br>
			
			<label>Perekonnanimi</label><br>
			<input name="Lastname" type="text"> 

			<br><br>
			
			<label>E-mail</label><br>
			<input type="E-mail" name="signupEmail" value="<?php echo $signupEmail; ?>">  <?php echo $signupEmailError; ?>

			<br><br>

			<label>Mobiiltelefoni number</label><br>
			<input type="text" name="mobilenumber">

			<br><br>
			
			<label>Parool</label><br>
			<input type="password" name="signupPassword"> <?=$signupPasswordError;?> 

			<br><br>

			<label>Parool uuesti</label><br>
			<input type="password" name="signupPassword"> <?=$signupPasswordError;?>
			
			<br><br>

			<label>Sünnipäev</label><br>
			<input type="date" name="birthday">
			
			<br><br>

			<label>Sugu</label><br>
			
			<?php if ($gender == "male") { ?>
				<input type="radio" name="gender" value="male" checked> Mees <br>
			<?php } else { ?>
				<input type="radio" name="gender" value="male" > Mees <br>
			<?php } ?>
			
			<?php if ($gender == "female") { ?>
				<input type="radio" name="gender" value="female" checked> Naine <br>
			<?php } else { ?>
				<input type="radio" name="gender" value="female"> Naine <br>
			<?php } ?>
			
			<?php if ($gender == "other") { ?>
				<input type="radio" name="gender" value="other" checked> Muu <br>
			<?php } else { ?>
				<input type="radio" name="gender" value="other"> Muu <br>
			<?php } ?>
			
				<input type="submit" value="Loo kasutaja">
		
		</form>

	</body>
</html>