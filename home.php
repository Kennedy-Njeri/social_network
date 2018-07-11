<?php
session_start();
include("includes/connection.php");
include("functions/functions.php");
include("alert.php");

if(!isset($_SESSION['user_email'])) {
header("location: index.php");

} else {

?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome User</title>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!--<link rel="stylesheet" type="text/css" href="styles/home_style.css">-->
  <style type="text/css">
  
  .contain {

float: left;
margin-left: 40px;
margin-top: 0px;


  }

  .contain img {

   border-radius: 50%;
   margin-bottom: 20px;

  }
    
.container {

  
  margin-left: 315px;
  margin-right: 250px;
  margin-bottom: 0px;
  margin-top: 100px;
}
.container1 {

  float: ;
  margin-left: 330px;
  margin-right: 260px;
  margin-bottom: 200px;

}

.well {
            background-color: white;
        }

  .well:hover {


background-color: #e3f2fd;
  }

      
      ///

.dropdown-menu>li>a:hover,
.navbar-default .navbar-nav>li>a:hover,
.navbar-default .navbar-nav >.active>a,
.navbar-default .navbar-header>a:hover,
.navbar-default .navbar-nav>.active>a:hover,
.navbar-default .navbar-nav .open .dropdown-menu>li>a:hover

a
{
    cursor:pointer;
}
      
a:hover .fa
{
    -webkit-animation:fa-spin 1s;animation:fa-spin 1s
}
      
      .navbar-container {
           transition: 0.8s;
    -webkit-transition:  0.8s;
      }
      



  </style>
</head>
<body style="background-color: #e8e8e8; ">

<!--Container Starts-->


			<nav class="navbar-fixed-top navbar-expand-lg navbar-light" style="background-color: #e3f2fd; min-height: 80px;">
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="list-inline" style="margin-top: 25px; margin-left: 30px; margin-right: 70px;">

     


         <li class="nav-item">
             <a class="faa-parent animated-hover">
             <a class="nav-link" href="home.php"><i class="fa fa-fw fa-lg fa-home faa-tada faa-fast"></i>Home</a>
             </a>
        </li>

        <li class="nav-item">
            <a class="faa-parent animated-hover">
                <a class="nav-link" href="members.php"><i class="fa fa-user-plus"></i>Members</a>
            </a>
       </li>

        <li class="nav-item">
            <a class="faa-parent animated-hover">
                <a class="nav-link" href="my_messages.php?inbox&u_id=$user_id"><i class="fa fa-envelope faa-horizontal animated"></i>Messages</a>
            </a>
       </li>    
            
            

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
     <span class="glyphicon glyphicon-search form-control-feedback"></span>
            
       <form method="get" action="results.php" id="form1" style="float: right;">
           
       	<input type="text" name="user_query" class=""  placeholder="Search a Topic" style="">
     <button name="search" value="search" class="btn btn-primary" style="margin-left: 30px;">Search</button>

       </form>
       </ul>
  
 
	</nav>


<!--Header Wrapper Ends-->

<!--Content Area Starts-->
<div class="contain">
<div class="well" style="border-radius: 25px; background-color: #e3f2fd;">
	
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
       <centre><img src='user/user_images/$user_image' width='140' height='140'></centre>
       <div id='user_mention'>
       <p><strong>Name:</strong>$user_name</p>
       <p><strong>Country:</strong> $user_country</p>
       <p><strong>Last Login:</strong> $last_login</p>
       <p><strong>Member Since:</strong> $register_date</p>

       
      <p><a href='my_messages.php?inbox&u_id=$user_id'>Messages ($count_msg)</a></p>
      <p><a href='my_posts.php?u_id=$user_id'>My Posts ($posts)</a></p>
      <p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
      <p><a href='logout.php'>Logout</a></p>
       </div> 

       ";
          ?>
		
  </div>
    </div>
    <!--User Timeline Ends Starts-->
    <!--Content_timeline Starts-->

   <div class="container">
    <div class="well" style="color: green; height: 440px; width: 600px; border-radius: 25px;">
      <div class="form-group">
       <form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f">
       <h2>What is your question Today? Let Us Discuss</h2>
       <input type="text" name="title" class="form-control" placeholder="Write a Title" size="73" required="required"></br>
       <textarea cols="71" rows="4" name="content" class="form-control" placeholder="Write description"></textarea></br>
       <select name="topic">
       	<option class="form-control">Select Topic</option>
       	<?php echo getTopics(); ?>
       </select></br></br>
       <input type="submit" name="sub" class="btn btn-primary" value="Post To Timeline">
        </form>
        </div>
    </div>
</div>

    <i class="icon-comment-alt"></i><h3 style="margin-left: 330px;">Most Recent Discussions!</h3></br>
        <div class="container1" style="align-items: center;">
       <div class="well" style="color: green; border-radius: 25px; width: 600px; ">
        <?php echo insertPost();  ?>
 
    	

      <?php get_posts(); ?>
    </div>
    </div>
   <!--Content_timeline Ends-->



<!--Container Ends-->


</body>
<footer style="background-color: #e3f2fd; min-height: 40px;">
 <div class="container-fluid" align="center">
    <span>&copy; 2018</span>
  </div>  
</footer>
</html>
<?php 
}

?>
