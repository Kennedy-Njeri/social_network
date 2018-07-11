<?php
session_start();
include("includes/connection.php");
include("functions/functions.php");


if(!isset($_SESSION['user_email'])) {
header("location: index.php");

} else {

?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome User</title>
	<link rel="stylesheet" type="text/css" href="styles/home_style.css">
  <style type="text/css">
    
#user_profile {

padding: 10px;
margin-left: 50px;
background: #FFB6C1;
height: 350px;
border:2px solid black;
border-radius: 10px;

}


#user_profile img {

float:right;
border:2px solid black;

}


#user_profile p{margin: 5px;}
#user_profile button{margin-top: 10px;}





  </style>
</head>
<body>

<!--Container Starts-->
<div class="container">
	<div id="head_wrap">
		<div id="header">
			
       <ul id="menu">
       	<li><a href="home.php">Home</a></li>
        <li><a href="members.php">Members</a></li>
        <strong>Topics:</strong>
        <?php 
       
       global $con;

       $get_topics = "select * from topics";
       $run_topics = mysqli_query($con,$get_topics);
      
      while($row=mysqli_fetch_array($run_topics)) {

      $topic_id = $row['topic_id'];
      $topic_title = $row['topic_title'];

      echo "<li><a href='topic.php?topic=$topic_id'>$topic_title</a></li>";
     
      }
        
        ?>
       </ul>
       <form method="get" action="results.php" id="form1">
       	<input type="text" name="user_query" placeholder="Search a Topic">
        <input type="submit" name="search" value="search">


       </form>
		</div><!--Header Ends-->


</div><!--Header Wrapper Ends-->

<div class="content"><!--Content Area Starts-->
	<div id="user_timeline"><!--User Timeline Starts-->
		<div id="user_details">
          <?php 
          
          global $con;

          $user = $_SESSION['user_email'];
          $get_user = "select * from users where user_email='$user'";
          $run_user = mysqli_query($con,$get_user);
          $row=mysqli_fetch_array($run_user);

          $user_id = $row['user_id'];
          $user_name = $row['user_name'];
          $user_country = $row['user_country'];
          $user_image = $row['user_image'];
          $register_date = $row['register_date'];
          $last_login = $row['last_login'];
       
          $user_posts = "select * from posts where user_id='$user_id'";
          $run_posts = mysqli_query($con,$user_posts);
          $posts = mysqli_num_rows($run_posts);


          //getting the number of unread messages
           $sel_msg = "select * from messages where receiver='$user_id' AND status='unread'";

           $run_msg = mysqli_query($con,$sel_msg) or die("Error: ".mysqli_error($con));

           $count_msg = mysqli_num_rows($run_msg);



       echo " 
       <centre><img src='user/user_images/$user_image' width='200' height='200'></centre>
       <div id='user_mention'>
       <p><strong>Name:</strong>$user_name</p>
       <p><strong>Country:</strong> $user_country</p>
       <p><strong>Last Login:</strong> $last_login</p>
       <p><strong>Member Since:</strong> $register_date</p>

       
      <p><a href='my_messages.php?u_id=$user_id'>Messages ($count_msg)</a></p>
      <p><a href='my_posts.php?u_id=$user_id'>My Posts ($posts)</a></p>
      <p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
      <p><a href='logout.php'>Logout</a></p>
       </div> 

       ";
          ?>
			</div>
		</div>
    <!--User Timeline Ends Starts-->
    <div id="content_timeline"><!--Content_timeline Starts-->

       
       <h2>Information About This User: </h2>
       
      <?php user_profile(); ?>
    
   </div><!--Content_timeline Ends-->
</div> <!--Content Area Ends-->




</div>
<!--Container Ends-->


</body>
</html>
<?php 
}

?>