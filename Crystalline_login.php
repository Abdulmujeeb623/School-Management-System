<?php session_start(); ?>
<?php

error_reporting(0);

class Database {
    private $conn;

    public function __construct($host, $username, $password, $database) {
        $this->conn = new mysqli($host, $username, $password, $database);
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

class Authentication {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    private function testInput($x) {
        $x = trim($x);
        $x = stripslashes($x);
        $x = htmlspecialchars($x);
        return $x;
    }

    public function authenticate($name, $password) {
        $conn = $this->db->getConnection();
        $name = $this->testInput($name);
        $password = $this->testInput($password);

        $sql = "SELECT * FROM user WHERE user_name=? AND pass1=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $name, $password);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows) {
                $_SESSION['name'] = $name;
                header('Location: Crystalline_dashboard.php');
                exit();
            } else {
                return "Wrong username and/or password";
            }
        }
        
        $stmt->close();
        return null;
    }
}

$database = new Database("localhost", "root", "", "crystalline");
$auth = new Authentication($database);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['name'];
    $password = $_POST['password'];
    
    if (!empty($email) && !empty($password)) {
        $err = $auth->authenticate($email, $password);
    }

    $database->closeConnection();
}
?>
  <!DOCTYPE html>
<html>


	<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Welcome  To CMA - Sin up, Log in </title>
        
	<link rel="stylesheet" type="text/css" href="momlogin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <link href="bootstrap.min.css" rel="stylesheet">

    <style>
            li {
                list-style: none;
            }

            .hide-password {
                display: none;
            }
        </style>

	</head>


    <body>

	<div id="container">
		<div class="sign-in-form">
			<table>
			<h1>Welcome to CMA</h1>
			<h2>Log in</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
				<tr>
					<td><label>Name
                        <?php
                        if(!empty($err))
                        
                            echo"<SPAN class=\"red\">*</SPAN>";
                            else
                            
                                echo "*";
                            
                               

                        

                        
                        ?>
                    </label><br></td>
					<td><input type="name" name="name" placeholder="Please enter your name" class="form-1" title="Enter your name" required /></td>
				</tr>
				<tr>
					<td><label>Password
                    <?php
                        if(!empty($err))
                        
                            echo"<SPAN class=\"red\">*</SPAN>";
                            else
                            
                                echo "*";
                        ?>
                    </label></td>
					<td><input type="password" name="password" id="passInput" class="password" placeholder="~~~~~~~~~~"  title="Enter your password"  required />
                    <span><input type="checkbox" id="showPass">Show password
        </span>
                    
                    </td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
					<input type="submit" name="submit" value="Log in" class="btn-sign-in" title="Log in" />
					<input type="reset" name="cancel" value="Cancel" class="btn-sign-up" title="Cancel" />
					</td>
				</tr>
                <tr>
					<td colspan="2">
					<a href="ForgottenPassword.php" style="padding-left: 20px; background-color: blue;">Forgotten password</a>
					</td>
				</tr>
	</form>
	
    <?php
        echo"<DIV class=\"red\">";
        if(isset($err))
        echo $err;
        echo"</DIV>";
        ?>

			</table>
		
		</div>
        
	</div>
    <script src="jquery-1.12.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#show-password").on('click', function () {
                    var passInput = $("#passInput");
                    if (passInput.attr('type')==='password') 
                    {
                        passInput.attr('type','text');
                    }
                    else {
                        passInput.attr('type','password');


                    }
                })
            })


        </script>
    
	
</body>

</html>