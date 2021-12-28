Show post details with it comments ========
<div class="col-lg-5 mr-auto">
    <?php // var_dump($data["post"]); ?>
    <form action="index.php?controller=posts&action=update" method="post">
        <h3>Post details</h3>
        <hr/>
        <input type="hidden" name="id" value="<?php echo $data["post"]->id ?>"/>


        ID: <label><?php echo $data["post"]->id ?></label><br>
        Title: <label><?php echo $data["post"]->title ?></label><br>
        Category: <label><?php echo $data["post"]->category_name ?></label><br>
        Text: <label><?php echo $data["post"]->text ?></label><br>
        Status: <label><?php echo $data["post"]->status==1?'Active':'Inactive' ?></label><br>
        Date: <label><?php echo $data["post"]->created_at ?></label><br>


        <a href="index.php?controller=posts&action=show_update&id=<?php echo $data["post"]->id; ?>" class="btn btn-info">Edit</a>
    </form>


    <?php if($data["comments"]){ ?>
  <h3>  Post comments  :</h3>
        <?php foreach($data["comments"] as $comment) {?>
            <?php echo $comment["contributor_name"]; ?> -
            <?php echo $comment["email"]; ?> -
            <?php echo $comment["created_at"]; ?><br>
            <?php echo $comment["text"]; ?>
            <hr/>
        <?php } ?>
    <?php } ?>
    <br>
    <form action="index.php?controller=posts&action=create_comment" method="post">
    Add comment to post :
        <input type="hidden" name="id" value="<?php echo $data["post"]->id ?>">
        <input type="hidden" name="post_id" value="<?php echo $data["post"]->id ?>">
    name : <input type="text" name="contributor_name" /><br>
    Email : <input type="text" name="email" /><br>
    Comment : <input type="text" name="text" /><br>
        <input type="submit" value="Add comment" class="btn btn-success"/>
    </form>
    <br>
  <h3>  May be you want to read other posts :</h3>

    <br>
    <?php foreach($data["other_posts"] as $post) {?>
        <?php echo $post["id"]; ?> -
        <?php echo $post["title"]; ?> -
        <?php echo $post["text"]; ?> -
        <div class="right">
            <a href="index.php?controller=posts&action=details&id=<?php echo $post["id"]; ?>" class="btn btn-info">Details</a>
        </div>

        <hr/>
    <?php } ?>
    <a href="index.php" class="btn btn-info">Return</a>
</div>