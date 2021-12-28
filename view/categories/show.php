Show category details :
<?php // var_dump($data["post"]); ?>
<form action="index.php?controller=categories&action=update" method="post">
    <h3>Post details</h3>
    <hr/>
    <input type="hidden" name="id" value="<?php echo $data["category"]->id ?>"/>


    ID: <label><?php echo $data["category"]->id ?></label><br>
    Title: <label><?php echo $data["category"]->title ?></label><br>
    Category: <label><?php echo $data["category"]->description ?></label><br>

    Status: <label><?php echo $data["category"]->status==1?'Active':'Inactive' ?></label><br>
    Count posts: <label><?php echo $data["category"]->posts_count ?></label><br>


    <a href="index.php?controller=categories&action=show_update&id=<?php echo $data["category"]->id; ?>" class="btn btn-info">Edit</a>
</form>