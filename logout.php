<?php
include ('./inc/connect.inc.php');
include ('./checkcookie.php');
if(!Login::isloggedIn())
{
  die("Not Logged in");
}

if(isset($_POST['confirm']))
{
  if(isset($_POST['alldevices']))
  {
    DB::query('DELETE FROM login_tokens WHERE user_id=:userid', array(':userid'=>Login::isloggedIn()));
  }
  else {
    if(isset($_COOKIE['SNID']))
    {
      DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
    }
    setcookie('SNID', 1, time()-3600);
    setcookie('SNID_', 1, time()-3600);
  }
  header("Location: index.php");
}
 ?>
 <h1>Logout of your account?</h1>
 <p>Are you sure you'd like to logout?</p>
<form action="logout.php" method="post">
  <input type="checkbox" name="alldevices" value="alldevices">Logout of all devices?<br />
  <input type="submit" name="confirm" value="Confirm">
</form>
