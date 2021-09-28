<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Travel Agency</title>
<script src="../SAKIB/View/js/login.js"></script>
<link rel="stylesheet" href="../SAKIB/View/css/logino.css"></link>
</head>
<body>
<?php 
include '../SAKIB/Model/dbmanager.php';
$usernameErr = $passwordErr = "";
$login = "";
$flag = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{ 


if (empty($_POST["username"])) 
    {  
       $usernameErr = " Username is required";
       $flag = True;  
    } 

if (empty($_POST["password"])) 
    {  
       $passwordErr = " Password is required";
       $flag = True;  
    } 
 
if(!$flag) 
    {

    $username = input_data($_POST["username"]);
    $password = input_data($_POST["password"]); 
    
    $res = login($username,$password);
    if($res)
    {
    setcookie("uname", $username, time() + 60*60*24);
    session_start();
    $_SESSION['username'] = $username;
    header("Location: ../SAKIB/view/Manager.php");
    }
    else 
    {
    $login =  "Username/Password doesn't match";
    }
    }


}
  function input_data($data) 
  {  
  $data = trim($data);  
  $data = stripslashes($data);  
  $data = htmlspecialchars($data);  
  return $data;  
  }

?>

<span style="color: white;text-align:center"><h1>Login Page</h1></span> 
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" name ="login" onsubmit="return isValid();">
		<fieldset id="fd">
			<legend><h3 >User Info</h3></legend>

			<input type="text" name="username" id="username" placeholder="username" id="a">
            <span id="usernameErr"></span>
			<span style="color: red"><?php echo $usernameErr; ?> </span><br><br>
			<input type="password" name="password" id="password" placeholder="Password" id="b">
            <span id="passwordErr"></span>
			<span style="color: red"><?php echo $passwordErr; ?> </span><br><br>
			<input type="submit" name="submit" value="Login" id="sub">
             <div style= "text-align:center"><span style="color: red"><?php echo "<h1>". $login . "</h1>"?> </span></div>
             <br><br>
             <a href="../SAKIB/Controller/Reg.php">Create New Account</a>
		</fieldset>
	</form>
    

</body>
</html>