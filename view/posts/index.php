<?php include 'includes/header.php'; ?>
<?php
include 'includes/header.php';
session_start();
if(isset($_SESSION["user_id"]))
{

    name: echo $_SESSION["user_name"];
}

?>
    <br>
    <a href="index.php?controller=users&action=logout" class="btn btn-info">log out</a><br>
    <br>
    <a href="index.php?controller=categories&action=index" class="btn btn-info">categories</a>
    <br>
    List of posts here: <a href="index.php?controller=posts&action=create_page" class="btn btn-info">Add new post</a><br>
<?php foreach($data["posts"] as $post) {?>
    <?php echo $post["id"]; ?> -
    <?php echo $post["title"]; ?> -
    <?php echo $post["text"]; ?> -
    <div class="right">
        <a href="index.php?controller=posts&action=details&id=<?php echo $post["id"]; ?>" class="btn btn-info">Details</a>
    </div>
    <div class="right">
        <a href="index.php?controller=posts&action=show_update&id=<?php echo $post["id"]; ?>" class="btn btn-info">Edit</a>
    </div>
    <div class="right">
        <a href="index.php?controller=posts&action=delete&id=<?php echo $post["id"]; ?>" class="btn btn-info">Delete</a>
    </div>
    <hr/>
<?php } ?>

<?php include 'includes/footer.php'; ?>