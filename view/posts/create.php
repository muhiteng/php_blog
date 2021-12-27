
Add new  post :<br>
<form action="index.php?controller=posts&action=create" method="post">
    <h3>Post details</h3>


    Title: <input type="text" name="title"  class="form-control"/><br>
    Category :
    <select name="category_id">
        <?php foreach($data["categories"] as $category) {?>
            <option value="<?php echo $category["id"] ?>" ><?php echo $category["title"] ?></option>
        <?php } ?>

    </select>
    <br>
    Text: <textarea type="text" name="text"  class="form-control"></textarea><br>
    Status: <select name="status">
        <option value="1" >Active</option>
        <option value="0" >Inactive</option>
    </select>
    <br>

    <input type="submit" value="Add post" class="btn btn-success"/>
</form>
<br>
<a href="index.php" class="btn btn-info">Return</a>
