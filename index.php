<?php //script that will authenticate when a user logs in.
   include("config.php");
   session_start();
    $error ="";
  
   if($_SERVER["REQUEST_METHOD"] == "POST") {

      // checks the database for username and password that was entered into the form.
      $myusername = mysqli_real_escape_string($db,$_POST['l_uname']);
      $mypassword = mysqli_real_escape_string($db,$_POST['l_pwd']); 
      
      $sql = "SELECT * FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, it will log the user into the homepage. otherwise throw an error for invalid credentials.
      if($count == 1) {
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $role = $row['role'];
        $luser_name = $row['username'];
        $_SESSION['role'] = $role;
        $_SESSION['user_name'] = $luser_name;
        header("location: Homepage.php");
      }else {
         $error = "Your Username or Password are invalid";
      }
   }
?>



<div class="container">   
  <!DOCTYPE html 
  <head>
    <!-- Below is styling -->
    <style>
      body {
      background-color: #fff;
      font-family: Lato, sans-serif;
      }
      <!-- styling for for ALL text fields -->
      input{
        display: inline-block;
        margin: 25px;
        width: 200px;
        text-align: left;
      }
      .container {
      background: linear-gradient(90deg, rgba(1,1,1,1) 5%, rgb(119, 93, 139) 81%, rgb(150, 96, 165) 100%);
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
      .footer {
      left: 0;
      bottom: 0;
      height: 50px;
      width: 100%;
      background-color: #bfc4ff;
      color: #000000;
      text-align: center;
      }
      h1 {
      font-size: 2rem;
      
      }
        h2 {
      color: #FF0000;
      }
      underline {
      text-decoration: underline;
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
      legendstyle {
      font-size: 2rem;
      line-height: 1.5;
      color: #fbfbfb;
      }

      form2 {
      font-size: 1.2rem;
      line-height: 0.5;
      color: #fbfbfb;
      }
      .button { 
      height: 25px; 
      width: 75px; 
      }
      forgotpass {
      color: #f6d84e 
      }
    </style>
  </head>

  <header>
    <h1>CCSC - Consortium for Computing Sciences</h1>
  </header>

  <main>
    <fieldset>
        <legend><legendstyle><b>Welcome to the <underline>Conference paper management system</underline> webpage for the <underline>Consortium for Computing Sciences!</underline></b></legendstyle></legend>  
          <p>
            The Consortium for Computing Sciences in Colleges (CCSC) is a non-profit organization focused on promoting quality computing curricula and the effective use of computing in colleges and universities. The CCSC encourages the sharing of research, effective curricula, teaching expertise, and efficient technological applications in the classroom.
            <br><br>
            The conference paper management system (CPMS) is designed to provide a hastle free, paperless and efficient solution for authors/reviewers to partake in the Consortium for Computing Sciences in Colleges
            <br><br> <underline><b>Login</underline> or <underline>Create an Account</underline> to Continue.</b>
          </p>
    </fieldset><br><br><br>

    <fieldset>
        <legend><legendstyle>Login</legendstyle></legend>
             <form action = "" method = "post">
			<table>
                <tr>
                  <td><label for="username"><form2>Username :</form2></label></td>
                  <td><input id="Username1" placeholder="Username" type="text" name="l_uname" required/></td>
                </tr>
                <tr>
                  <td><label for="password"><form2>Password :</form2></label></td>
                  <td><input id="Password1" placeholder="Password" type="password" name="l_pwd" required/></td>
                </tr>
                <tr>
                  <td><br><input type="submit" class="button" value="Login" /></td>
                  <td><br><forgotpass> <a href="forgot_password.php">forgot Password?</a> </forgotpass> </td>
				 <td> <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div></td>
                </tr>
            </table> 
			</form>
      </fieldset> <br><br><br>
           
      <fieldset>
        <legend><legendstyle>Sign Up</legendstyle></legend>
          <form name = "sign" method="POST" action = "insert.php">
          <table>
              <tr>
                <td><label for="username"><form2>Username :</form2></label></td>
                <td><input name = "tUsername" id="tUsername" placeholder="Username" type="text" required/></td>
              </tr>
              <tr>
                <td><label for="password"><form2>Password :</form2></label></td>
                <td> <input name = "tPassword" id="tPassword" placeholder="Password" type="Password" required/></td>
              </tr>
              <tr>
                <td><label for="firstname"><form2>First Name :</form2></label></td>
                <td><input name = "tFirstName" id="tFirstName" placeholder="First Name" type="text" required/></td>
                <td><label for="middleinitials"><form2>Middle Initials :</form2></label></td>
                <td><input name = "tMiddleInitials" id="tMiddleInitials" placeholder="Middle Initial" type="text" required/></td>
                <td><label for="lastname"><form2>Last Name :</form2></label></td>
                <td><input name = "tLastName" id="tLastName" placeholder="Last Name" type="text" /></td>
              </tr>
              <tr>
                <td><label for="affiliation"><form2>Affiliation :</form2></label></td>
                <td><input name = "tAffiliation" id="tAffiliation" placeholder="Affiliation" type="text" required/></td>
              </tr>
              <tr>
                <td><label for="university"><form2>University :</form2></label></td>
                <td><input name = "tUniversity" id="tUniversity" placeholder="University" type="text" required/></td>
              </tr>
              <tr>
                <td><label for="department"><form2>Department :</form2></label></td>
                <td><input name = "tDepartment" id="tDepartment" placeholder="Department" type="text" required/></td>
              </tr>
              <tr>
                <td><label for="address"><form2>Address :</form2></label></td>
                <td><input name = "tAddress" id="tAddress" placeholder="Address" type="text" required/></td>
                <td><label for="city"><form2>City :</form2></label></td>
                <td><input name = "tCity" id="tCity" placeholder="City" type="text" required/></td>
                <td><label for="state"><form2>State :</form2></label></td>
                <td><input name = "tState" id="tState" placeholder="State" type="text" required/></td>
                <td><label for="zipcode"><form2>Zip Code :</form2></label></td>
                <td><input name = "tZipCode" id="tZipCode" placeholder="ZipCode" type="text" required/></td>
              </tr>
              <tr>
                <td><label for="phonenumber"><form2>Phone Number :</form2></label></td>
                <td><input name = "tPhoneNumber" id="tPhoneNumber" placeholder="Phone Number" type="text" required/></td>
              </tr>
              <tr>
                <td><label for="emailaddress"><form2>Email Address :</form2></label></td>
                <td><input name = "tEmailAddress" id="tEmailAddress" placeholder="Email Address" type="text" required/></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
              </tr>
          </table><br><br>
          <table>
            <input type="checkbox" name="isreviewer" id="isreviewer" value="isreviewer"> 
            <label for="isreviewer"> <form2>Please Check this Box and select your interests <b><underline>ONLY</b></underline> if you are a reviewer.</form2><br><br>
          </table>
          <table>
            <tr>
              <td><form2>interest 1:</form2></td>
              <td><select name="interest1" id="interest1">
                                   <option value="Analysis of Algorithms">Analysis of Algorithms</option>
                  <option value="Applications">Applications</option>
                  <option value="Architecture">Architecture</option>
                  <option value="Artificial Intelligence">Artificial Intelligence</option>
                  <option value="Computer Engineering">Computer Engineering</option>
                  <option value="Curriculum">Curriculum</option>
                  <option value="Data Structures">Data Structures</option>
                  <option value="Databases">Databases</option>
                  <option value="Distance Learning">Distance Learning</option>
                  <option value="Distributed Systems">Distributed Systems</option>
                  <option value="EthicalSocietalIssues">EthicalSocietalIssues</option>
                  <option value="FirstYearComputing">FirstYearComputing</option>
                  <option value="GenderIssues">GenderIssues</option>
                  <option value="GrantWriting">GrantWriting</option>
                  <option value="GraphicsImageProcessing">GraphicsImageProcessing</option>
                  <option value="HumanComputerInteraction">HumanComputerInteraction</option>
                  <option value="LaboratoryEnvironments">LaboratoryEnvironments</option>
                  <option value="Literacy">Literacy</option>
                  <option value="MathematicsInComputing">MathematicsInComputing</option>
                  <option value="Multimedia">Multimedia</option>
                  <option value="NetworkingDataCommunications">NetworkingDataCommunications</option>
                  <option value="NonMajorCourses">NonMajorCourses</option>
                  <option value="ObjectOrientedIssues">ObjectOrientedIssues</option>
                  <option value="OperatingSystems">OperatingSystems</option>
                  <option value="ParallelProcessing">ParallelProcessing</option>
                  <option value="Pedagogy">Pedagogy</option>
                  <option value="ProgrammingLanguages">ProgrammingLanguages</option>
                  <option value="Research">Research</option>
                  <option value="Security">Security</option>
                  <option value="SoftwareEngineering">SoftwareEngineering</option>
                  <option value="SystemsAnalysisAndDesign">SystemsAnalysisAndDesign</option>
                  <option value="UsingTechnologyInClassroom">UsingTechnologyInClassroom</option>
                  <option value="WebAndInternetProgramming">WebAndInternetProgramming</option>
                  <option value="Other">Other</option>
              </select></td>
            </tr>
            <tr>
              <td><form2>interest 2:</form2></td>
              <td><select name="interest2" id="interest1">
                                   <option value="Analysis of Algorithms">Analysis of Algorithms</option>
                  <option value="Applications">Applications</option>
                  <option value="Architecture">Architecture</option>
                  <option value="Artificial Intelligence">Artificial Intelligence</option>
                  <option value="Computer Engineering">Computer Engineering</option>
                  <option value="Curriculum">Curriculum</option>
                  <option value="Data Structures">Data Structures</option>
                  <option value="Databases">Databases</option>
                  <option value="Distance Learning">Distance Learning</option>
                  <option value="Distributed Systems">Distributed Systems</option>
                  <option value="EthicalSocietalIssues">EthicalSocietalIssues</option>
                  <option value="FirstYearComputing">FirstYearComputing</option>
                  <option value="GenderIssues">GenderIssues</option>
                  <option value="GrantWriting">GrantWriting</option>
                  <option value="GraphicsImageProcessing">GraphicsImageProcessing</option>
                  <option value="HumanComputerInteraction">HumanComputerInteraction</option>
                  <option value="LaboratoryEnvironments">LaboratoryEnvironments</option>
                  <option value="Literacy">Literacy</option>
                  <option value="MathematicsInComputing">MathematicsInComputing</option>
                  <option value="Multimedia">Multimedia</option>
                  <option value="NetworkingDataCommunications">NetworkingDataCommunications</option>
                  <option value="NonMajorCourses">NonMajorCourses</option>
                  <option value="ObjectOrientedIssues">ObjectOrientedIssues</option>
                  <option value="OperatingSystems">OperatingSystems</option>
                  <option value="ParallelProcessing">ParallelProcessing</option>
                  <option value="Pedagogy">Pedagogy</option>
                  <option value="ProgrammingLanguages">ProgrammingLanguages</option>
                  <option value="Research">Research</option>
                  <option value="Security">Security</option>
                  <option value="SoftwareEngineering">SoftwareEngineering</option>
                  <option value="SystemsAnalysisAndDesign">SystemsAnalysisAndDesign</option>
                  <option value="UsingTechnologyInClassroom">UsingTechnologyInClassroom</option>
                  <option value="WebAndInternetProgramming">WebAndInternetProgramming</option>
                  <option value="Other">Other</option>
              </select></td>
            </tr>
            <tr>
              <td><form2>interest 3:</form2></td>
              <td><select name="interest3" id="interest1">
                                    <option value="Analysis of Algorithms">Analysis of Algorithms</option>
                  <option value="Applications">Applications</option>
                  <option value="Architecture">Architecture</option>
                  <option value="Artificial Intelligence">Artificial Intelligence</option>
                  <option value="Computer Engineering">Computer Engineering</option>
                  <option value="Curriculum">Curriculum</option>
                  <option value="Data Structures">Data Structures</option>
                  <option value="Databases">Databases</option>
                  <option value="Distance Learning">Distance Learning</option>
                  <option value="Distributed Systems">Distributed Systems</option>
                  <option value="EthicalSocietalIssues">EthicalSocietalIssues</option>
                  <option value="FirstYearComputing">FirstYearComputing</option>
                  <option value="GenderIssues">GenderIssues</option>
                  <option value="GrantWriting">GrantWriting</option>
                  <option value="GraphicsImageProcessing">GraphicsImageProcessing</option>
                  <option value="HumanComputerInteraction">HumanComputerInteraction</option>
                  <option value="LaboratoryEnvironments">LaboratoryEnvironments</option>
                  <option value="Literacy">Literacy</option>
                  <option value="MathematicsInComputing">MathematicsInComputing</option>
                  <option value="Multimedia">Multimedia</option>
                  <option value="NetworkingDataCommunications">NetworkingDataCommunications</option>
                  <option value="NonMajorCourses">NonMajorCourses</option>
                  <option value="ObjectOrientedIssues">ObjectOrientedIssues</option>
                  <option value="OperatingSystems">OperatingSystems</option>
                  <option value="ParallelProcessing">ParallelProcessing</option>
                  <option value="Pedagogy">Pedagogy</option>
                  <option value="ProgrammingLanguages">ProgrammingLanguages</option>
                  <option value="Research">Research</option>
                  <option value="Security">Security</option>
                  <option value="SoftwareEngineering">SoftwareEngineering</option>
                  <option value="SystemsAnalysisAndDesign">SystemsAnalysisAndDesign</option>
                  <option value="UsingTechnologyInClassroom">UsingTechnologyInClassroom</option>
                  <option value="WebAndInternetProgramming">WebAndInternetProgramming</option>
                  <option value="Other">Other</option>
              </select></td>
            </tr>
            <tr>
              <td><br><input type="submit" name="Submit" id="Submit" value="Submit" class="button"></td>
              <td> <?php 
              //this will throw an error when the user tries to create an account using an existing username/email/password.
              if(isset( $_SESSION['login_error_msg'])){
              echo  '<br><h2>'.$_SESSION['login_error_msg'].'</h2>';  
              $_SESSION['login_error_msg']="";
              }
              ?>  </td>
            </tr>
          </table>  
        </form>
      </fieldset>

  </main>
  
  <div class="footer">
    <footer><b><br>Contact us ---- +1 813-666-666 ---- r.astley@usf.com</footer>
  </div>    
  </html> 
</div>
