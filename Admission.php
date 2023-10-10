<?php

include('ddb.php');

class RegistrationForm {
    private $conn;
    private $nameerr = "";
    private $nnamerr= "";
    private $userNameErr= "";
    private $birthdayerr= "";
    private $numberr= "";
    private $genderr= "";
    private $stateerr= "";
    private $placeerr= "";
    private $occupationerr= "";
    private $residentialerr= "";
    private $genotypeerr = "";
    private $blooderr= "";
    private $healtherr= "";
    private $classerr= "";
    private $Aclasserr= "";
    private $nokerr= "";
    private $questionserr= "";
    private $emailerr= "";
    private $passworderr= "";
	private $name = "";
    private $nname= "";
    private $username= "";
    private $birthday= "";
    private $number= "";
    private $gender= "";
    private $state= "";
    private $place= "";
    private $occupation= "";
    private $residential= "";
    private $genotype = "";
    private $blood= "";
    private $health= "";
    private $class= "";
    private $Aclass= "";
    private $nok= "";
    private $questions= "";
    private $email= "";
    private $password= "";
    
    
    function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    private function testInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function handleRegistration() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['firstname'])) {
                $this->nameerr = "Name is required";
            } else {
                $this->name = $this->testInput($_POST['firstname']);
            }
            
            if (empty($_POST['lastname'])) {
                $this->nnamerr = 'Lastname is required';
            } else {
                $this->nname = $this->testInput($_POST['lastname']);
            }
            
            if (empty($_POST['username'])) {
                $this->userNameErr = "Username is required";
            } else {
                $this->username = $this->testInput($_POST['username']);
                if (strlen($this->username) < 5) {
                    $this->userNameErr = "Username is too short";
                }
            }
            
            if (empty($_POST['birthday'])) {
                $this->birthdayerr = "Birthday is required";
            } else {
                $this->birthday = $this->testInput($_POST['day']) . "/" . $this->testInput($_POST['month']) . "/" . $this->testInput($_POST['year']);
            }
            
            if (empty($_POST['number'])) {
                $this->numberr = "Phone number is required";
            } else {
                $this->number = $this->testInput($_POST['number']);
            }
            if (empty($_POST['state'])) {
                $this->stateerr = "State is required";
            } else {
                $this->state = $this->testInput($_POST['state']);
            }
            if (empty($_POST['place'])) {
                $this->placeerr = "Place of resident is required";
            } else {
                $this->place = $this->testInput($_POST['place']);
            }
            
            if (empty($_POST['occupation'])) {
                $this->occupationerr = "Occupation is required";
            } else {
                $this->occupation = $this->testInput($_POST['occupation']);
            }
            if (empty($_POST['residential'])) {
                $this->residentialerr = "Residential address is required";
            } else {
                $this->residential = $this->testInput($_POST['residential']);
            }
            if (empty($_POST['genotype'])) {
                $this->genotypeerr = "Blood genotype is required";
            } else {
                $this->genotype = $this->testInput($_POST['genotype']);
            }
            if (empty($_POST['blood'])) {
                $this->bloodeerr = "Blood group is required";
            } else {
                $this->blood = $this->testInput($_POST['blood']);
            }
            if (empty($_POST['health'])) {
                $this->healtherr = "Health challenges is required";
            } else {
                $this->health = $this->testInput($_POST['health']);
            }
            
            if (empty($_POST['currentClass'])) {
                $this->classerr = "Current class is required";
            } else {
                $this->class = $this->testInput($_POST['currentClass']);
            }
            if (empty($_POST['anticipatedClass'])) {
                $Aclasserr = "Anticipated is required";
            } else {
                $genotype = $this->testInput($_POST['anticipatedClass']);
            }
            if (empty($_POST['nok'])) {
                $this->nokerr = "Anticipated is required";
            } else {
                $this->nok = $this->testInput($_POST['nok']);
            }
            
            if (empty($_POST['questions'])) {
                $this->questionserr = "Questions is required";
            } else {
                $this->questions = $this->testInput($_POST['questions']);
            }
            
            
            
            
            if (empty($_POST['email'])) {
                $this->emailerr = "Email is required";
            } else {
                $this->email = $this->testInput($_POST['email']);
                if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                    $this->emailerr = "A valid email is required";
                }
            }
            
            
            if (empty($_POST['password']) && empty($_POST['password2'])) {
                $this->passworderr = "Password is required";
            } else {
                $this->password = $this->testInput($_POST['password']);
                $this->password2 = $this->testInput($_POST['password2']);
                if ($this->password !== $this->password2) {
                    $this->passworderr = "Passwords do not match";
                }
            }

            if (empty($this->nameerr) && empty($this->nnamerr) && empty($this->userNameErr) &&
                empty($this->birthdayerr) && empty($this->numberr) && empty($this->genderr) &&
                empty($this->residentialerr) && empty($this->stateerr) && empty($this->placeerr) && empty($this->occupationerr) && empty($this->genotypeerr) 
                && empty($this->healtherrerr)&& empty($this->classerr)&& empty($this->Aclasserr)&& empty($this->nokerr)&& empty($this->questionserr)&& empty($this->emailerr)&& 
                empty($this->passworderr)) {
                
                $stmt = $this->conn->prepare("INSERT INTO admission (FirstName, LastName, UserName, UserName2, ContactNumber, Gender, DateofBirth, 
                    EmailAddress, ResidentialAddress, StateofOrigin, PlaceofBirth, OccupationofParent, BloodGenotype, HealthChallenges, CurrentClass,
                     AnticipatedClass, NextofKin, Questions, Password2, password1)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                
                if ($stmt) {
                    $stmt->bind_param(
                        "ssssisisssssssiissss",
                        $this->name,
                        $this->nname,
                        $this->username,
                        $this->username,
                        $this->number,
                        $this->gender,
                        $this->birthday,
                        $this->email,
                        $this->residential,
                        $this->state,
                        $this->place,
                        $this->occupation,
                        $this->genotype,
                        $this->health,
                        $this->class,
                        $this->$Aclass,
                        $this->nok,
                        $this->questions,
                        
                        $this->password,
                        $this->password2
                    );
                      $this->name= $_REQUEST['firstname'];
            	      $this->nname= $_REQUEST['lastname'];
	                  $this->username= $_REQUEST['username'];
                      $this->username= $_REQUEST['username'];
                      $this->number= $_REQUEST['number'];
                      $this->gender= $_REQUEST['gender'];
                      $this->birthday= $_REQUEST['birthday'];
                      $this->email= $_REQUEST['email'];
                      $this->residential= $_REQUEST['residential'];
                      $this->state= $_REQUEST['state'];
                      $this->place= $_REQUEST['place'];
                      $this->occupation= $_REQUEST['occupation'];
                      $this->genotype= $_REQUEST['genotype'];
                      $this->health= $_REQUEST['health'];
                      $this->class= $_REQUEST['class'];
	                  $this->Aclass= $_REQUEST['Aclass'];
	                  $this->nok= $_REQUEST['nok'];
	                  $this->questions= $_REQUEST['questions'];
	                  $this->password= $_REQUEST['password'];
	                  $this->password= $_REQUEST['password2'];

                    if ($this->stmt->execute()) {
                        echo "<script>alert('Account successfully created!'); window.location='momlogin.php'</script>";
                    } else {
                        echo "ERROR: Could not execute query: " . $this->stmt->error;
                    }
                    $stmt->close();
					$conn->closeConnection();

                } else {
                    echo "ERROR: Could not prepare query: " . $this->conn->error;
                }
            }
        }
    }
}

    




?>
<!DOCTYPE html>
<html>

	<head>
		<title>Welcome  To Al-Bab - Sin up, Log in, Chat </title>
		<link rel="stylesheet" type="text/css" href="mom.css">
	</head>

<body>




	<div id="container">
		<div class="sign-in-form">
		<center>	
			<h1>Welcome to CMA</h1>
		</center>

			<h2>Sign up</h2>
			<b>All fields are required.</b>
		<br />
		
		<fieldset class="sign-up-form-1">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><label>First name*</label></td>
					<td><label>Last name *</label></td>
				</tr>
				<tr>
					<td><input type="text" name="firstname" placeholder="Enter your firstname....." class="form-1" 
					title="Enter your firstname" value="<?php echo $this->name;?>" required /></td><br>
					
					<td><input type="text" name="lastname" placeholder="Enter your lastname....." class="form-1" 
					title="Enter your lastname" value="<?php echo $this->nname;?>" required /></td><br>		
				</tr>
				<tr>
				<td><?php echo $this->nameerr;?></td><br>
				<td><?php echo $this->nnamerr;?></td><br>
				</tr>
        
				
				

				<tr>
					<td><label>User name*</label></td>
					<td><label>Repeat user name*</label></td>
				</tr>
				
				<tr>
					<td><input type="text" name="username" placeholder="Enter your username....." class="form-1" 
					title="Enter your username" value="<?php echo $this->username;?>" required/></td>
					<td><input type="text" name="username2" class="form-1" title="Enter your username" value="<?php echo $this->username;?>" required /></td>
				</tr>
				<tr>
				<td><?php echo $this->userNameErr;?></td><br>
				<td><?php echo $this->userNameErr;?></td><br>
				
				
			</tr>
        
				<tr>
					<td colspan="2">Note: No one can follow your username.</td>
				</tr>
				
				
			</table>
		</fieldset>
			
		<br />		
		
		<fieldset class="sign-up-form-1">
			<legend>Profile information</legend>
			<table celltedpadding="5" cellspacing="5">
				<tr>
					<td><label>Birthday</label></td>
					<td>
					<select name=day style="font-size:18px;" value="<?php echo $this->birthday;?>">
					<?php

					$day=1;
					while($day<=31)
					  {
					  echo "<option> $day
					  </option>";
					  $day++;
					  }
					?>
					</select>
					<select name=month style="font-size:18px;" >
						<option>January</option>
						<option>Febuary</option>
						<option>March</option>
						<option>April</option>
						<option>May</option>
						<option>June</option>
						<option>July</option>
						<option>August</option>
						<option>September</option>
						<option>October</option>
						<option>November</option>
						<option>December</option>
					</select>
					<select name=year style="font-size:18px;" required>
					<?php
					$year=1901;
					while($year<=2014)
					  {
					  echo "<option> $year
					  </option>";
					  $year++;
					  }
					?>
					</select>
					</td>
				</tr>
				
				
				
        
				

				<tr>
					<td><label>Gender</label></td>
					<td>
					<label>Male</label><input type="radio" name="gender" <?php if (isset($this->gender) && $this->gender=="male") echo "checked"; ?>
					 value="male" required />
					<label>Female</label><input type="radio" name="gender" <?php if (isset($this->gender) && $this->gender=="female") echo "checked"; ?>
					 value="female" required />
					</td>
				</tr>
				<tr>
				<td><?php echo $this->genderr;?></td><br>
				
				
			</tr>
        
				<tr>
					<td><label>Contact number*</label></td>
					<td><input type="text" name="number" placeholder="09...." maxlength="13" class="form-1" 
					title="Enter your mobile number" value="<?php echo $this->number?>" required /></td>
				</tr>
				<tr>
				<td><?php echo $this->numberr;?></td><br>
				
				
			</tr>
        
			</table>
		</fieldset>
		
		<br/>
		
		<fieldset class="sign-up-form-1">
			
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><label>State of Origin*</label></td>
					<td><label>Place of birth *</label></td>
				</tr>
				<tr>
					<td><input type="text" name="state" placeholder="Enter the state you come from....." class="form-1" 
					title="Enter your firstname" value="<?php echo $this->state;?>" required /></td>
					<td><input type="text" name="place" class="form-1" title="Enter your lastname" value="<?php echo $this->place;?>" required /></td>
				</tr>
				
				<tr>
				<td><?php echo $this->stateerr;?></td><br>
				<td><?php echo $this->placeerr;?></td><br>
				</tr>
			    
        
        
				<tr>
					<td><label>Occupation of parent*</label></td>
					<td><label>Residential address*</label></td>
				</tr>
				<tr>
					<td><input type="text" name="occupation" placeholder="Enter your occupation....." class="form-1" 
					title="Enter your occupation" required /></td>
					<td><input type="text" name="residential" class="form-1" title="Enter your residential address" required /></td>
				</tr>
				<tr>
				<td><?php echo $this->occupationerr;?></td><br>
				<td><?php echo $this->residentialerr;?></td><br>
				</tr>
        
				</table>
		</fieldset>
        
		
		<fieldset class="sign-up-form-1">
			
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><label>Face photograph*</label></td>
					<td><label>Blood genotype *</label></td>
				</tr>
				<tr>
					
					<td><input type="text" name="genotype" class="form-1" title="Enter your genotype" value="<?php echo $this->genotype;?>" required /></td>
				</tr>
				
				<tr>
				
				<td><?php echo $this->genotypeerr;?></td><br>
				</tr>
			    
        
        
				<tr>
					<td><label>Blood group*</label></td>
					<td><label>Health challenges*</label></td>
				</tr>
				<tr>
					<td><input type="text" name="blood" placeholder="Enter your blood group....." class="form-1" 
					title="Enter your occupation" required /></td>
					<td><input type="text" name="health" class="form-1" title="Enter your health challenges" required /></td>
				</tr>
				<tr>
				<td><?php echo $this->blooderr;?></td><br>
				<td><?php echo $this->healtherr;?></td><br>
				</tr>
        
				</table>
		</fieldset>
        <br>
        
        
		
		<fieldset class="sign-up-form-1">
			
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><label>Current class*</label></td>
					<td><label>Anticipated class *</label></td>
				</tr>
				<tr>
					<td><input type="text" name="currentClass" placeholder="Please enter your current class in prev school....." class="form-1" 
					title="Enter your firstname" value="<?php echo $this->class;?>" required /></td>
					<td><input type="text" name="anticipatedClass" class="form-1" title="Enter your anticipated class" value="<?php echo $this->Aclass;?>" required /></td>
				</tr>
				
				<tr>
				<td><?php echo $this->classerr;?></td><br>
				<td><?php echo $this->Aclasserr;?></td><br>
				</tr>
			    
        
        
				<tr>
					<td><label>Next of kin*</label></td>
					<td><label>Questions/Comments*</label></td>
				</tr>
				<tr>
					<td><input type="text" name="nok" placeholder="Enter your next of kin....." class="form-1" 
					title="Enter your next of kin" required /></td>
					<td><input type="text" name="questions" class="form-1" title="Enter your questions" required /></td>
				</tr>
				<tr>
				<td><?php echo $this->nokerr;?></td><br>
				<td><?php echo $this->questionerr;?></td><br>
				</tr>
        
				</table>
		</fieldset>
		
		<br />
        <fieldset class="sign-up-form-1">
			<legend>Log in information*</legend>
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><label>Your email address*</label></td>
					<td><label>Repeat email *</label></td>
				</tr>
				<tr>
					<td><input type="text" name="email" placeholder="Enter your email address....." class="form-1" 
					title="Enter your firstname" value="<?php echo $this->email;?>" required /></td>
					<td><input type="text" name="email" class="form-1" title="Enter your lastname" value="<?php echo $this->email;?>" required /></td>
				</tr>
				<tr>
					<td colspan="2">Note: no-one can see your email address.</td>
				</tr>
				<tr>
				<td><?php echo $this->emailerr;?></td><br>
				<td><?php echo $this->emailerr;?></td><br>
				</tr>
			    
        
        
				<tr>
					<td><label>Password*</label></td>
					<td><label>Repeat password*</label></td>
				</tr>
				<tr>
					<td><input type="password" name="password" placeholder="Enter your password....." class="form-1" 
					title="Enter your username" required /></td>
					<td><input type="password" name="password2" class="form-1" title="Enter your username" required /></td>
				</tr>
				<tr>
				<td><?php echo $this->passworderr;?></td><br>
				<td><?php echo $this->passworderr;?></td><br>
				</tr>
        
				<tr>
					<td colspan="2">Note: no-one else can see your password.</td>
				</tr>
			</table>
		</fieldset>
		
		<br>
		
			<strong>Yes, I have read and I accept the <a href="#">CMA Terms of Use</a> and the <a href="#"><Al-bab></Al-bab> Privacy Statement</a></strong>
			
		<br />
		<br />
					<input type="submit" name="submit" value="I Agree - Continue" class="btn-sign-in" title="Log in" />
		</form>
		
		</div>
	</div>
	

	


</body>
</html>



                    