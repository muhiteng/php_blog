<?php include 'includes/header.php'; ?>
<a href="index.php?controller=posts&action=index" class="btn btn-info">posts</a>
<br>
List of Categories here: <a href="index.php?controller=categories&action=create_page" class="btn btn-info">Add new Category</a><br>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>title</th>

        <th>Description</th>
        <th>Operations</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($data["categories"] as $category) {?>
    <tr>
       <td><?php echo $category["id"]; ?></td>
       <td width="200"><?php echo $category["title"]; ?></td>
       <td width="200"><?php echo $category["description"]; ?></td>
       <td width="300">
           <div class="right">
               <a href="index.php?controller=categories&action=all_posts&id=<?php echo $category["id"]; ?>" class="btn btn-info">Posts</a>
           </div>
           <div class="right">
               <a href="index.php?controller=categories&action=details&id=<?php echo $category["id"]; ?>" class="btn btn-info">Details</a>
           </div>
           <div class="right">
               <a href="index.php?controller=categories&action=show_update&id=<?php echo $category["id"]; ?>" class="btn btn-info">Edit</a>
           </div>
           <div class="right">
               <a href="index.php?controller=categories&action=delete&id=<?php echo $category["id"]; ?>" class="btn btn-info">Delete</a>
           </div>
       </td>
    </tr>
    <?php } ?>
    </tbody>
</table>



<?php include 'includes/footer.php'; ?>