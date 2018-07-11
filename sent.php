

<table width="700">

 
  <tr>

     <th>Receiver:</th>
     <th>Subject</th>
     <th>Date</th>
     <th>Reply</th>
 </tr>

<?php 

global $con;

$sel_msg = "select * from messages where sender='$user_id'";

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



$get_receiver = "select * from users where user_id='$msg_receiver'";
$run_receiver = mysqli_query($con,$get_receiver);
$row=mysqli_fetch_array($run_receiver);


$receiver_name = $row['user_name'];



?>


<tr align="center">
  
  <td>
    <a href="user_profile.php?u_id=<?php echo $msg_receiver;?>" target="blank">
    <?php echo $receiver_name; ?>
  </a>
  </td>
  <td><a href="my_messages.php?msg_id=<?php echo $msg_id; ?>"><?php echo $msg_sub; ?></a></td>
  <td><?php echo $msg_date; ?></td>
  <td><a href="my_messages.php?msg_id=<?php echo $msg_id; ?>">View Reply</a></td>


</tr>


<?php } ?>

</table>

<?php 

if(isset($_GET['msg_id'])) {



$get_id = $_GET['msg_id'];


$sel_message = "select * from messages where msg_id='$get_id'";
$run_message = mysqli_query($con,$sel_message);

$row_message = mysqli_fetch_array($run_message);


$msg_sub = $row_message['msg_sub'];
$msg_topic = $row_message['msg_topic'];
$reply_content = $row_message['reply'];

echo "<center><br/><hr>

<h2><b>Subject:</b>$msg_sub</h2>

<p><b>Message:</b> $msg_topic</p>
<p><b>Reply:</b>$reply_content</p>


<form action='' method='post'>
   <textarea cols='40' rows='10' name='reply'></textarea></br>
   <input type='submit' name='msg_reply' value='Reply To This'/>
   </form>
</center>
";



if(isset($_POST['msg_reply'])) {



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