<?php include 'includes/header.php'; ?>
Update Category :<br>
<form action="index.php?controller=categories&action=update" method="post">
    <h3>Category details</h3>
    <hr/>
    <input type="hidden" name="id" value="<?php echo $data["category"]->id ?>"/>
    Title: <input type="text" name="title" value="<?php echo $data["category"]->title ?>" class="form-control"/><br>

    <br>
    Description: <textarea type="text" name="description"  class="form-control"><?php echo $data["category"]->description ?>
    </textarea><br>
    Status: <select name="status">
        <option value="1" <?php echo $data["category"]->status==1?'selected':'' ?>>Active</option>
        <option value="0" <?php echo $data["category"]->status==0?'selected':'' ?>>Inactive</option>
    </select>
    <br>
    Count posts: <input type="text" name="created_at" value="<?php echo $data["category"]->posts_count ?>" class="form-control"/><br>
    <input type="submit" value="Update" class="btn btn-success"/>
</form>
<br>
<a href="index.php" class="btn btn-info">Return</a>


<?php include 'includes/footer.php'; ?>