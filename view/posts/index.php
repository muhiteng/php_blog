List of posts here: <br>
<?php foreach($data["posts"] as $post) {?>
    <?php echo $post["id"]; ?> -
    <?php echo $post["title"]; ?> -
    <?php echo $post["text"]; ?> -


    <hr/>
<?php } ?>