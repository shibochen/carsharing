<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
include('connection.php');

$user_id = $_SESSION['user_id'];

//get username and email
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if($count == 1){
    $row = mysqli_fetch_array($result, MYSQL_ASSOC); 
    $username = $row['username'];
    $email = $row['email']; 
    $picture = $row['profilepicture'];
}else{
    echo "There was an error retrieving the username and email from the database";   
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content ="free, simple, car sharing">
    <meta name="description" content="free online car sharing website, sign up today and start your car journey!">
    <link rel="shortcut icon" type="image/png" href="http://www.thecoursecorrection.com/wp-content/uploads/2018/08/columbian-c-logo-large.png">
    <title>Car Sharing Website</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/source.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
    <style>
        body {
            background-color: #F9F9F9;
        }
        
        .body {
            width: 60%;
            margin: 100px auto 0 auto;
            padding: 20px;
        }
        
        .h3title {
            font-size: 2em;
            text-decoration: underline;
            color: #3F84BF;
            margin-bottom: 30px;
        }
        
        .border{
            font-size: 1.5em;
            padding: 15px;
            border: 1px solid skyblue;
        }
        .border a:hover {
            color: skyblue;
        }
        
        .previewing2 {
            margin: auto;
            height: 20px;
            border-radius: 50%;
        }
    
    </style>
</head>

<body>
           <!--Navigation Bar-->  
      <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
          <div class="container-fluid">
              <div class="navbar-header">
                  <a class="navbar-brand">Car Sharing</a>
                  <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
              </div>
              <div class="navbar-collapse collapse" id="navbarCollapse">
                  <ul class="nav navbar-nav">
                    <li><a href="index.php">Search</a></li>  
                    <li><a href="profile.php">Profile</a></li>
                    <li class="active"><a href="help.php">Help</a></li>
                    <li><a href="contactus.php">Contact us</a></li>
                    <li><a href="mainpage.php">My Trips</a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                      <li><a href="#">
                            <?php
                                if(empty($picture)){
                                    echo "<div class='image_preview'  data-target='#updatepicture' data-toggle='modal'><img class='previewing2' src='profilepicture/noimage.jpg' /></div>";
                                }else{
                                    echo "<div class='image_preview' data-target='#updatepicture' data-toggle='modal'><img class='previewing2' src='$picture' /></div>";
                                }
                              ?>
                          </a>
                      </li>
                      <li><a href="profile.php"><span class='glyphicon glyphicon-user'></span> <?php echo $username; ?></a></li>
                    <li><a href="index.php?logout=1"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
                  </ul>
              </div>
          </div>
      </nav>

        <!--Container-->
        <div class="body">
          <h3 class="h3title">Frequently Asked Questions:</h3>      
          <div id="accordion">
           <div class="card border">
              <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseOne">
                 What is car sharing?
              </a>
              </div>
              <div id="collapseOne" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  Car sharing is a membership based website, which allows users around world to share car journeys with each other!
                </div>
              </div>
            </div>
            <div class="card border">
              <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                How much is member fee?
              </a>
              </div>
              <div id="collapseTwo" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  The website is completely free. Anyone can sign up if you are interested in it!
                </div>
              </div>
            </div>
            <div class="card border">
              <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                  How much does it cost if I take a journey to one place?
                </a>
              </div>
              <div id="collapseThree" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  It is very dependent on the driver. The price and number of available seats will be posted on the website by the driver!
                </div>
              </div>
            </div>
            <div class="card border">
              <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
                  How do I contact with the driver?
                </a>
              </div>
              <div id="collapseFour" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  Once you join, you need to log in the website and then search for the driver's basic personal information!
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer-->
        <div class="footer">
            <p>Car-Sharing &copy; <?php $today = date("Y"); echo $today?>.</p>
        </div>


        <script src="js/bootstrap.min.js"></script>
        <script src="js/source.js"></script>
</body>

</html>
