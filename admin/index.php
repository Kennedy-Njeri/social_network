<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Admin Panel</title>
<link rel="stylesheet" type="text/css" href="admin_style.css">
</head>
<body>

	<div class="container">
		 <div id="head">
		 </div>

		 



        <div id="sidebar">
        	<h2>Manage Content: </h2>

              <ul id="menu">
              	<li><a href="index.php?view_users">View Users</a></li>
                <li><a href="index.php?view_posts">View Posts</a></li>
                <li><a href="index.php?view_comments">View Comments</a></li>
                <li><a href="index.php?view_topics">View Topics</a></li>
               <li><a href="index.php?add_topic">Add New Topic</a></li>
               <li><a href="index.php?admin_logout">Admin Logout</a></li>

              </ul>

        </div>


          <div id="content">
          	<?php 
          
          if(isset($_GET['view_users'])) {

          include("includes/view_users.php");


          }


          	?>

          </div>

          
          <div id="foot">
          	<h2 style="color: white; padding: 10px; text-align: center;">Copyrights 2018</h2>
          </div>

	</div>

</body>
</html>