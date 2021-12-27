Update post :<br>
<form action="index.php?controller=posts&action=update" method="post">
    <h3>Post details</h3>
    <hr/>
    <input type="hidden" name="id" value="<?php echo $data["post"]->id ?>"/>
    Title: <input type="text" name="title" value="<?php echo $data["post"]->title ?>" class="form-control"/><br>
    Category :
    <select name="category_id">
        <?php foreach($data["categories"] as $category) {?>
            <option value="<?php echo $category["id"] ?>" <?php echo $category["id"]==$data["post"]->category_id?'selected':'' ?>><?php echo $category["title"] ?></option>
        <?php } ?>

        </select>
   <br>
    Text: <textarea type="text" name="text"  class="form-control"><?php echo $data["post"]->text ?>
    </textarea><br>
    Status: <select name="status">
        <option value="1" <?php echo $data["post"]->status==1?'selected':'' ?>>Active</option>
        <option value="0" <?php echo $data["post"]->status==0?'selected':'' ?>>Inactive</option>
    </select>
    <br>
    date: <input type="text" name="created_at" value="<?php echo $data["post"]->created_at ?>" class="form-control"/><br>
    <input type="submit" value="Update" class="btn btn-success"/>
</form>
<br>
<a href="index.php" class="btn btn-info">Return</a>
