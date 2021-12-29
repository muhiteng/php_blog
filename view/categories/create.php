<?php include 'includes/header.php'; ?>
Add new  post :<br>
<form action="index.php?controller=categories&action=create" method="post">
    <h3>Post details</h3>


    Title: <input type="text" name="title"  class="form-control"/><br>

    <br>
    Description : <textarea type="text" name="description"  class="form-control"></textarea><br>
    Status: <select name="status">
        <option value="1" >Active</option>
        <option value="0" >Inactive</option>
    </select>
    <br>

    <input type="submit" value="Add Category" class="btn btn-success"/>
</form>
<br>
<a href="index.php" class="btn btn-info">Return</a>


<?php include 'includes/footer.php'; ?>