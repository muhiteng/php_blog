Show post details with it comments ========
<div class="col-lg-5 mr-auto">
    <?php // var_dump($data["post"]); ?>
    <form action="index.php?controller=posts&action=update" method="post">
        <h3>Post details</h3>
        <hr/>
        <input type="hidden" name="id" value="<?php echo $data["post"]->id ?>"/>
        ID: <input type="text" name="Name" value="<?php echo $data["post"]->id ?>" class="form-control"/><br>
        Title: <input type="text" name="Name" value="<?php echo $data["post"]->title ?>" class="form-control"/><br>
        Category : <input type="text" name="Name" value="<?php echo $data["post"]->category_name ?>" class="form-control"/><br>
        Text: <input type="text" name="Surname" value="<?php echo $data["post"]->text ?>" class="form-control"/><br>
        Status: <input type="text" name="email" value="<?php echo $data["post"]->status==1?'Active':'Inactive' ?>" class="form-control"/><br>
        date: <input type="text" name="phone" value="<?php echo $data["post"]->created_at ?>" class="form-control"/><br>
        <input type="submit" value="Send" class="btn btn-success"/>
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