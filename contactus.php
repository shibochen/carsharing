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

        .header h2 {
            padding-bottom: 15px;
        }

        .content1 h3,
        .content2 h3 {
            padding-bottom: 10px;
            border-bottom: 1px solid #222;
        }

        .content1 p,
        .content2 p {
            padding: 7px;
        }

      .previewing2{
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
                    <li><a href="help.php">Help</a></li>
                    <li class="active"><a href="contactus.php">Contact us</a></li>
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
            <div class="header">
                <h2>CONTACT US!</h2>
                <p>Here's how to get in touch with us!</p>
            </div>
            <div class="content1">
                <h3>Contact our Customer Service Representative via email:</h3>
                <p>If you would like to contact our support staff via <strong>email</strong>, please email at <a href="mailto:wzzjroyop@gmail.com">wzzjroyop@gmail.com</a></p>
                <p>Please include as much information as you can in your request, as this will help to ensure that your issue is resolved in a more timely manner. Emails will be answered in the order they are received.</p>
            </div>
            <div class="content2">
                <h3>Need to call us?</h3>
                <p>If your question is urgent or you require assistance via <strong>telephone</strong>, please call us at 1-347-257-2777.</p>
                <p><strong>Customer Support Phone Representatives are available Monday through Friday, 9am to 5pm, US Eastern time.</strong></p>
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
