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

#msg {
padding: 10px;
line-height: 20px;
background: pink;
margin:0 auto;

}

#msg th {
  border:3px solid green;
  background: white;
}

#msg table, td {
  padding: 10px;
}

#msg a {
  color:blue;
  text-decoration: none;
  font-size: 18px;
}

#msg a:hover {
  color:brown;
  font-weight: bolder;
  text-decoration: underline;
}



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
    <div id="msg"><!--msg Starts-->
<p align="center">
  <a href="my_messages.php?inbox">My Inbox</a> ||
  <a href="my_messages.php?sent">Sent Items</a>
</p>

<?php if(isset($_GET['sent'])) {

include("sent.php");

} 
?>

<?php //if(isset($_GET['inbox'])) { ?>
       
<table width="700">

 
  
<?php 

global $con;


$sel_msg = "select * from messages where receiver='$user_id'";

$run_msg = mysqli_query($con,$sel_msg) or die("Error: ".mysqli_error($con));

$count_msg = mysqli_num_rows($run_msg);

while($row_msg=mysqli_fetch_array($run_msg))

{


$msg_id = $row_msg['msg_id'];
$msg_sender = $row_msg['sender'];
$msg_receiver = $row_msg['receiver'];
$msg_sub = $row_msg['msg_sub'];
$msg_topic = $row_msg['msg_topic'];
$msg_date = $row_msg['msg_date'];



$get_sender = "select * from users where user_id='$msg_sender'";
$run_sender = mysqli_query($con,$get_sender);
$row=mysqli_fetch_array($run_sender);


$sender_name = $row['user_name'];



?>


<tr align="center">
  
  <td>
    <a href="user_profile.php?u_id=<?php echo $msg_sender;?>" target="blank">
    <?php echo $sender_name; ?>
  </a>
  </td>
  <td><a href="my_messages.php?msg_id=<?php echo $msg_id; ?>"><?php echo $msg_sub; ?></a></td>
  <td><?php echo $msg_date; ?></td>
  <td><a href="my_messages.php?msg_id=<?php echo $msg_id; ?>">Reply</a></td>


</tr>


<?php } ?>

</table>

<?php 

if(isset($_GET['msg_id'])) {

global $con;

$get_id = $_GET['msg_id'];




$sel_message = "select * from messages where msg_id='$get_id'";
$run_message = mysqli_query($con,$sel_message);

$row_message = mysqli_fetch_array($run_message);


$msg_sub = $row_message['msg_sub'];
$msg_topic = $row_message['msg_topic'];
$reply_content = $row_message['reply'];


//Updating the unread message to read
$update_unread = "update messages set status='read' where msg_id='$get_id'";
$run_unread = mysqli_query($con,$update_unread);




echo "<center><br/><hr>

<h2><b>Subject:</b>$msg_sub</h2>
<p><b>Reply:$reply_content</b></p>
<p><b>Message:</b> $msg_topic</p>

<form action='' method='post'>
   <textarea cols='40' rows='10' name='reply'></textarea></br>
   <input type='submit' name='msg_reply' value='Reply To This'/>
   </form>
</center>
";
    
if(isset($_POST['msg_reply'])) {

global $con;

 $user_reply = $_POST['reply'];


 if($reply_content!='no_reply'){

  echo "<h2 align='center'>This Message was already replied!</h2>";
  exit();

 } else {

 $update_msg = "update messages set reply='$user_reply' where msg_id='$get_id' AND reply='no_reply'";

 $run_update = mysqli_query($con,$update_msg);

 echo "<h2 align='center'>Message was replied!</h2>";


     } 

   }

}
  





?>

</div> <!--Content Area Ends-->

</div>
<!--Container Ends-->


</body>
</html>
<?php 

}

?>