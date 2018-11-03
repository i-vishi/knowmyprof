<?php
session_start();

// initializing variables
// $username = "";
$email    = "";
$fname = "";
$lname = "";
$aoi = "";
$qual = "";
$achi = "";
$imgContent;
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', 'password', 'it');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  // $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  // $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  // $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
	$lname = mysqli_real_escape_string($db, $_POST['lname']);
	$aoi = mysqli_real_escape_string($db,$_POST['aoi']);
  $qual = mysqli_real_escape_string($db, $_POST['qual']);
  $achi = mysqli_real_escape_string($db, $_POST['achi']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  // if (empty($username)) { array_push($errors, "Username is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	$check = getimagesize($_FILES['image']['tmp_name']);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
				$imgContent = addslashes(file_get_contents($image));
				$ttt = true;
			}
				if (count($errors) == 0 && $ttt) {
					// $password = md5($password_1);//encrypt the password before saving in the database
			
					$query = "INSERT INTO prof (fname, lname, aoi,email,qual, achi,image)
								VALUES('$fname', '$lname','$aoi' ,'$email','$qual', '$achi', '$imgContent')";
					mysqli_query($db, $query);
					// $_SESSION['username'] = $username;
					$_SESSION['success'] = "You are now logged in";
					header('location: index.php');
				}
		}	
?>

<!DOCTYPE html>
<html>
  <head>
      <title>KMP</title>
      <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>

	<form method="post" action="newprof.php" enctype="multipart/form-data">
  		<?php include('errors.php'); ?>
  		<!-- <div class="input-group">
	  		<label>Roll No.</label>
	  		<input type="text" name="username" value="<?php echo $username; ?>">
			</div> -->
  		<div class="input-group">
	  		<label>First Name</label>
  			<input type="text" name="fname" value="<?php echo $fname; ?>">
  		</div>
    	<div class="input-group">
  			<label>Last Name</label>
  			<input type="text" name="lname" value="<?php echo $lname; ?>">
  		</div>
  		<div class="input-group">
  			<label>Email</label>
  			<input type="email" name="email" value="<?php echo $email; ?>">
    	</div>
    	<div class="input-group">
  			<label>Qualification</label>
  			<input type="text" name="qual" value="<?php echo $qual; ?>">
    	</div>
    	<div class="input-group">
  			<label>Area of interest</label>
  			<input type="text" name="aoi" value="<?php echo $aoi; ?>">
  		</div>    
    	<div class="input-group">
  			<label>Achivements</label>
  			<input type="text" name="achi" value="<?php echo $achi; ?>">
    	</div>
    	<div class="input-group">
  			<label>Display Picture</label>
  			<input type="file" name="image" value="UPLOAD">
  		</div>  
    	<div class="input-group">
  			<button type="submit" class="btn" name="reg_user">Register</button>
  		</div>
		</form>
	</body>
	</html>