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

       
      <p><a href='my_messages.php'>Messages ($count_msg)</a></p>
      <p><a href='my_posts.php'>My Posts</a></p>
      <p><a href='edit_profile.php'>Edit My Account</a></p>
      <p><a href='logout.php'>Logout</a></p>
       </div> 

       ";
          ?>
			</div>
		</div>
    <!--User Timeline Ends Starts-->
    <div id="content_timeline"><!--Content_timeline Starts-->

       
       <h2>All Registered Users On This Site:</h2><br/>
       <?php 
      
        
        global $con;


          $get_members = "select * from users";

          $run_members = mysqli_query($con,$get_members);

          while($row=mysqli_fetch_array($run_members)) {

          $user_id = $row['user_id'];
          $user_name = $row['user_name'];
          $user_image = $row['user_image'];
          



       echo " 

      <a href='user_profile.php?u_id=$user_id'>
      <img src='user/user_images/$user_image' width='50' height='50' title='$user_name'/>
    
       </a>

       ";
       }

       ?>
    
   </div><!--Content_timeline Ends-->
</div> <!--Content Area Ends-->




</div>
<!--Container Ends-->


</body>
</html>
<?php 
}

?>