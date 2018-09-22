<?php
session_start();
include('connection.php');
include('logout.php');
include('remember.php');
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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/source.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/sunny/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfHjaZETn3MZBrzf6Ffn6tAg9evXJu_v0&libraries=places"></script>
        <style>
            body {
                background-color: blue;
                font-family: Arvo, serif;
                background: url("background.jpg") no-repeat center center;
                background-attachment: fixed;
                background-size: cover;
            }

            #myContainer {
                margin-top: 50px;
                text-align: center;
                color: black;
            }

            #myContainer h1 {
                font-size: 2.8em;
                font-weight: 400;
                margin-bottom: 20px;
            }

            .title {
                font-size: 1.2em;
                font-weight: bold;
                margin-bottom: 20px;
            }

            #googleMap {
                width: 100%;
                height: 30vh;
                margin: 10px auto;
            }

            .signup {
                margin-top: 20px;
            }

            #spinner {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                height: 85px;
                text-align: center;
                margin: auto;
                z-index: 1000;
            }

            #results {
                margin-bottom: 100px;
            }

            .driver {
                font-size: 1.4em;
                text-transform: capitalize;
                text-align: center;
            }

            .departure,
            .destination,
            .price {
                font-size: 1.4em;
            }

            .perseat {
                font-size: 0.5em;
            }

            .journey {
                text-align: left;
            }

            .journey2 {
                text-align: right;
            }

            .time {
                margin-top: 10px;
            }

            .telephone {
                margin-top: 10px;
            }

            .seatsavailable {
                font-size: 0.7em;
                margin-top: 5px;
            }

            .moreinfo {
                text-align: left;
            }

            .aboutme {
                border-top: 1px solid grey;
                margin-top: 15px;
                padding-top: 5px;
            }

            #message {
                margin-top: 20px;
            }

            .journeysummary {
                text-align: left;
                font-size: 1.5em;
            }

            .noresults {
                text-align: center;
                font-size: 1.5em;
            }

            .previewing {
                max-width: 100%;
                height: auto;
                border-radius: 50%;
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
        <?php
        if(isset($_SESSION["user_id"])){
            include("navconnect.php");
        }else{
            include("navdisconnect.php");
        }  
        ?>

            <div class="container-fluid" id="myContainer">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <h1>Plan your next trip now!</h1>
                        <p class="title">Save Money! Save the Environment!</p>
                        <!--Search Form-->
                        <form class="form-inline" method="get" id="searchform">
                            <div class="form-group">
                                <label class="sr-only" for="departure">Departure</label>
                                <input type="text" class="form-control" id="departure" placeholder="Departure" name="departure">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="destination">Destination</label>
                                <input type="text" class="form-control" id="destination" placeholder="Destination" name="destination">
                            </div>
                            <input type="submit" value="Search" class="btn btn-lg btn-success" name="search">

                        </form>
                        <!--Search Form End-->

                        <!--Google Map-->
                        <div id="googleMap"></div>

                        <!--Sign up button-->
                        <?php
                  if(!isset($_SESSION["user_id"])){
                      echo '<button type="button" class="btn btn-lg btn-success signup" data-toggle="modal" data-target="#signupModal">Sign up-It\'s free</button>';
                  }
                  ?>
                            <div id="results">
    
                            </div>

                    </div>

                </div>

            </div>

            <!--Login form-->
            <form method="post" id="loginform">
                <div class="modal" id="loginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                                <h4 id="myModalLabel">
                                    Login
                                </h4>
                            </div>
                            <div class="modal-body">

                                <!--Login message from PHP file-->
                                <div id="loginmessage"></div>


                                <div class="form-group">
                                    <label for="loginemail" class="sr-only">Email</label>
                                    <input class="form-control" type="email" name="loginemail" id="loginemail" placeholder="Email" maxlength="50">
                                </div>
                                <div class="form-group">
                                    <label for="loginpassword" class="sr-only">Password</label>
                                    <input class="form-control" type="password" name="loginpassword" id="loginpassword" placeholder="Password" maxlength="30">
                                </div>
                                <div class="checkbox">
                                    <label>
                          <input type="checkbox" name="rememberme" id="rememberme">
                        Remember me
                      </label>
                                    <a class="pull-right" style="cursor: pointer" data-dismiss="modal" data-target="#forgotpasswordModal" data-toggle="modal">
                      Forgot Password?
                      </a>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input class="btn btn-success" name="login" type="submit" value="Login">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                  Cancel
                </button>
                                <button type="button" class="btn btn-info pull-left" data-dismiss="modal" data-target="#signupModal" data-toggle="modal">
                  Register
                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--Sign up form-->
            <form method="post" id="signupform">
                <div class="modal" id="signupModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                                <h4 id="myModalLabel">
                                    Sign Up
                                </h4>
                                <p>Pleasee fill in this form to create an account.</p>
                            </div>
                            <div class="modal-body">

                                <!--Sign up message from PHP file-->
                                <div id="signupmessage"></div>

                                <div class="form-group">
                                    <label for="username" class="sr-only">Username</label>
                                    <input class="form-control" type="text" name="username" id="username" placeholder="Username" maxlength="30">
                                </div>
                                <div class="form-group">
                                    <label for="firstname" class="sr-only">Firstname</label>
                                    <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Firstname" maxlength="30">
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="sr-only">Lastname</label>
                                    <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Lastname" maxlength="30">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" maxlength="50">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Enter password</label>
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Enter password" maxlength="30">
                                </div>
                                <div class="form-group">
                                    <label for="password2" class="sr-only">Confirm password</label>
                                    <input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm password" maxlength="30">
                                </div>
                                <div class="form-group">
                                    <label for="phonenumber" class="sr-only">Telephone</label>
                                    <input class="form-control" type="text" name="phonenumber" id="phonenumber" placeholder="Telephone Number" maxlength="15">
                                </div>
                                <div class="form-group">
                                    <label><input type="radio" name="gender" id="male" value="male">Male</label>
                                    <label><input type="radio" name="gender" id="female" value="female">Female</label>
                                </div>
                                <div class="form-group">
                                    <label for="moreinformation">Comments</label>
                                    <textarea name="moreinformation" class="form-control" rows="5" maxlength="300"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input class="btn btn-success" name="signup" type="submit" value="Sign up">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                  Cancel
                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--Forgot password form-->
            <form method="post" id="forgotpasswordform">
                <div class="modal" id="forgotpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                                <h4 id="myModalLabel">
                                    Find your Account
                                </h4>
                                <p>Please enter your email to search for your account.</p>
                            </div>
                            <div class="modal-body">
                                <!--forgot password message from PHP file-->
                                <div id="forgotpasswordmessage"></div>

                                <div class="form-group">
                                    <label for="forgotemail" class="sr-only">Email</label>
                                    <input class="form-control" type="email" name="forgotemail" id="forgotemail" placeholder="Email" maxlength="50">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input class="btn btn-success" name="forgotpassword" type="submit" value="Submit">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                  Cancel
                </button>
                                <button type="button" class="btn btn-info pull-left" data-dismiss="modal" data-target="#signupModal" data-toggle="modal">
                  Register
                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Footer-->
            <div class="footer">
                <p>Car-Sharing &copy; <?php $today = date("Y"); echo $today?>.</p>
            </div>

            <!--Spinner-->
            <div id="spinner">
                <img src='ajax-loader.gif' width="120px" height="120px" />
                <br>Loading..
            </div>

            <script src="js/bootstrap.min.js"></script>
            <script src="js/map.js"></script>
            <script src="js/source.js"></script>
    </body>

    </html>
