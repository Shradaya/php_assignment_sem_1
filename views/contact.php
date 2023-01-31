Hey, <?php 
$url= $_SERVER['REQUEST_URI']; 
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
echo $params['user_name']; ?>. You are logged in. <br>
<a href="index.php">Home</a>
<a href="index.php?logout">Logout</a>
<a href="contact.php?user_name=<?php echo $_SESSION['user_name']; ?>">contact</a>
<hr>
<form method="post" action="contact.php" name="contactform">
    <input type="hidden" name="user_name" value="<?php echo $params['user_name'] ?>" />
    <textarea name="message"  style="width:500">Enter your message here...</textarea><br>

    <input type="submit"  name="register" value="Send" />
</form>

