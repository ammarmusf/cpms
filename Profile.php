<?php //this script will allow the user to change their password given the current password and new password.
   include("config.php");
   session_start();
   $msg="";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
    
      $role=mysqli_real_escape_string($db,$_SESSION['role']) ;
      $uname=mysqli_real_escape_string($db,$_SESSION['user_name']);
      $cpwd = mysqli_real_escape_string($db,$_POST['cpwd']);
      $npwd = mysqli_real_escape_string($db,$_POST['npwd']);
      $rnpwd = mysqli_real_escape_string($db,$_POST['rnpwd']);
	   
	    if(!strcasecmp($npwd,$rnpwd) == 0) {
	      $msg="Re-Entered Password is wrong";
	    }else{
        $sql="select * from users where username='$uname' and password='$cpwd' and role='$role'";  
        $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);
          
        if($count >= 1) {
          $sql2="update users set password='$npwd'  where username='$uname' and password='$cpwd' and role='$role'";  
          mysqli_query($db,$sql2);
          $msg="Password Changed Successfully";     
        }else{
          $msg="Typed Current Password is wrong";
        }   
	    }  
    } 
 ?>

<div class="container">    
  <head>
    <!-- Below is styling -->
    <style>
      body {
      background-color: #fff;
      font-family: Lato, sans-serif;
      }
      .container {
      background: linear-gradient(90deg, rgba(1,1,1,1) 5%, rgba(199,147,241,1) 81%, rgba(180,124,195,1) 100%);
      }
      header {
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #bfc4ff;
      box-sizing: border-box;
      position: fixed;
      width: 100%;
      top: 0;
      left: 0;

      font-family: Poppins, sans-serif;
      color: #222;
      }
      h1 {
      font-size: 2rem;
      }
      underline {
      text-decoration: underline;
      }
      li {
      display: inline-block;
      margin: 0 10px;
      font-size: 1rem;
      font-weight: 700;
      text-transform: uppercase;
      }
      main {
      min-height: 1200px;
      max-width: 90vw;  
      margin: 120px auto;
      padding-top: 40px;
      }
      p {
      font-size: 1.2rem;
      line-height: 1.5;
      color: #fbfbfb;
      }
      p2 {
      font-size: 1.2rem;
      line-height: 1.5;
      color: yellow;
      }
      login {
      font-size: 2rem;
      line-height: 1.5;
      color: #fbfbfb;
      }
      form {
      font-size: 1.2rem;
      line-height: 1.5;
      color: #fbfbfb;
      }
      .button { 
      height: 25px; 
      width: 75px; 
      } 
      forgotpass {
      color: #0645AD
      }
      table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      }
      td, th {
      color: #fbfbfb;
      font-weight: bold;
      border: 1px solid #dddddd;
      text-align: center;
      padding: 8px;
      }
      th{
      font-size: 20px;
      background-color: #222;
      }
      tr:nth-child(even) {
      background-color: #808080;
      }
      footer {
      left: 0;
      bottom: 0;
      height: 50px;
      width: 100%;
      background-color: #bfc4ff;
      color: #000000;
      text-align: center;
      }
    </style>
  </head>

  <header>
    <h1>CCSC - Consortium for Computing Sciences</h1>
    <nav>
      <ul>
        <li><a href="Homepage.php">Home</a></li>

        <?php //script to display the toolbar depending on the role of the user.
          $role=$_SESSION['role'] ;
          if(strcasecmp($role,"author") == 0) {       
              echo "<li><a href=paper_submission_form.php>Submit Paper</a></li>";
          }
          
            if(strcasecmp($role,"admin") == 0) {       
              echo "<li><a href=generate_report.php> Manage Submission </a></li>";
          }
          
            if(!strcasecmp($role,"admin") == 0) {       
              echo "<li><a href=Profile.php> Profile </a></li>";
          }
        ?>
        
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <p style="text-align:center">
      CCSC Profile      <br><p2>Fill in the fields and click 'Submit' to modify your profile information.</p2>
    </p>
    
    <br>
    <p> <form> Fields that have not been filled for edit will not be altered.</form></td> </p>

<?php //this script will display the current user information into the text fields and allow the user to edit them and submit to update their profile information.
  $role=$_SESSION['role'] ;
  $uname=mysqli_real_escape_string($db,$_SESSION['user_name']);

  if(strcasecmp($role,"author") == 0) {       
    $sql="select * from author where username='$uname'";
  }else if(strcasecmp($role,"reviewer") == 0) {       
    $sql="select * from reviewer where username='$uname'";
  }

  $result = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

  echo '<form name="profile_action"  action="profile_submit.php" method="POST"><table>                                                                                                                            ';
  echo '<tr><th>First Name</th><td> <input type="text"  			value="'.$row['first_name'].'"	 name="t_first_name" ></td></tr>                     ';
  echo '<tr><th>Middle Initial</th> <td> <input type="text"  		value="'.$row['middle_name'].'" 				 name="t_middle_initial"></td> </tr> ';
  echo '<tr><th>Last Name</th><td> <input type="text"  			value="'.$row['last_name'].'"	 name="t_last_name" ></td> </tr>                     ';
  echo '<tr><th>Affiliation</th><td> <input type="text"  			value="'.$row['Affiliation'].'"		 name="t_Affiliation" ></td> </tr>           ';
  echo '<tr><th>University</th> <td> <input type="text"  			value="'.$row['University'].'"	 name="t_University" ></td> </tr>                ';
  echo '<tr><th>Department</th> <td> <input type="text" 			value="'.$row['Department'].'"	 name="t_Department" ></td> </tr>                ';
  echo '<tr><th>Address</th><td> <input type="text"				value="'.$row['Address'].'"	 name="t_Address" ></td> </tr>                   ';
  echo '<tr><th>City</th> <td> <input type="text"  				value="'.$row['City'].'"	 name="t_City" ></td> </tr>                          ';
  echo '<tr><th>State</th><td> <input type="text" 				value="'.$row['State'].'" 	name="t_State" ></td> </tr>                          ';
  echo '<tr><th>Zip</th><td> <input type="text" 					value="'.$row['Zip_Code'].'" 	name="t_Zip" ></td> </tr>                        ';
  echo '<tr><th>Phone Number</th> <td> <input type="text" 	value="'.$row['Phone_Number'].'"				 name="t_Phone_Number" ></td> </tr>      ';
  echo '<tr><th>Email Address</th><td> <input type="text" 			value="'.$row['Email_Address'].'"	 name="t_Email" ></td> </tr>                         ';
  echo '</table> ';
  echo '<br><input type="submit" name="profile_btn" value="Submit"></form> ';
?>

<br><br><br>
<p>Change password:<br>

<form name="changing_prof_pwd"  action="" method="POST">
    <input type="text"  placeholder="current password" name="cpwd"><br>
    <input type="text"  placeholder="enter new password" name="npwd">
    <input type="text"  placeholder="re-enter new password" name="rnpwd">
    <?php echo '<br>'.$msg; ?>
    <br><input type="submit" name="chg_pwd value="Change Password">
    
    </form>

  </main>
   <div class="footer">
    <footer><b><br>Contact us ---- +1 813-666-666 ---- r.astley@usf.com</footer>
  </div>  
</div>