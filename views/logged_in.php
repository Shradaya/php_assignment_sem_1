
Hey, <?php echo $_SESSION['user_name']; ?>. You are logged in. <br>
<a href="index.php">Home</a>
<a href="index.php?logout">Logout</a>
<a href="contact.php?user_name=<?php echo $_SESSION['user_name']; ?>">contact</a>
<hr>
<div>
    <centre><img src="image/image.png" width="400" height="300"></centre>
    <p>
    Hadoop is a framework written in Java that utilizes a large cluster of commodity hardware to maintain and store big size data. Hadoop works on MapReduce Programming Algorithm that was introduced by Google. Today lots of Big Brand Companies are using Hadoop in their Organization to deal with big data, eg. Facebook, Yahoo, Netflix, eBay, etc. The Hadoop Architecture Mainly consists of 4 components. 
        <ol>
            <li>MapReduce</li>
            <li>HDFS(Hadoop Distributed File System)</li>
            <li>YARN(Yet Another Resource Negotiator)</li>
            <li>Common Utilities or Hadoop Common</li>
        </ol>
    </p>
</div>
<div>
    <form method="post" action="comment.php" name="registerform">
        <input type="hidden" name="user_name" value="<?php echo $_SESSION['user_name'] ?>" />
        <input id="comment" class="input" type="text" name="comment" required />
        <input type="submit"  name="register" value="Comment" />
    </form>
</div>
<table>
<?php
    require('config/db.php');
    if (!$db_connection) {
        echo 'An error occurred.\n';
        exit;
        }
    $sql = "SELECT user_name, comment, time from comments ORDER BY time DESC;";
    $comments_list = pg_fetch_all(pg_query($db_connection, $sql));

    if(is_array($comments_list)){      
        $sn=1;
        foreach($comments_list as $data){
?>
    <tr>
        <td style="background:grey" width=10%><b><?php 
        echo($data['user_name']); 
        ?>
        </b></td>
        <td style="background:grey" width=100%>
        <?php 
        echo $data['comment']; 
        ?>
        </td>
        <td style="background:grey" >
        <?php 
        echo $data['time']; 
        ?>
        </td>
    </tr>
    <?php
    $sn++;}}
        ?>
</table>