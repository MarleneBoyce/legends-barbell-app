<!--MBOYCE NEW 1L : Used bootstrap default container, this container is responsive, fixed-with, and it's max-width changes at each break point-->
<div class="container">

<!--MBOYCE 2L: Styling header for "Categories page-->
<div class="d-flex justify-content-between">
<h2><b>Categories</b></h2>

<!--MBOYCE 1L: Inserted "Create Category" button -->
<a href="index.php?admin/categories/edit"  class="btn btn-primary my-2">Create Category</a>
</div>

<!--MBOYCE 9L: Create table and table headings -->
<table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>

  <!--MBOYCE 1L: Creating a foreach statement to display categories -->
  <?php foreach($categories as $key => $category): ?>
  <tr>
      <!--MBOYCE 1L: Displaying the correct number by adding 1-->
      <th scope="row"><?= $key + 1 ?></th>
      <td><?=htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8')?></td>
      <td>
        <!--MBOYCE 1L: Creating a button group for "Edit and Delete"-->
        <div class="btn-group">

        <!--MBOYCE 1L: Created edit button-->  
        <a class="btn btn-xs btn-info" href="index.php?admin/categories/edit?id=<?=$category->id?>">Edit</a> 

        <!--MBOYCE NEW 5L: Prompting user to confirm they want to delete the category, created delete button-->
        <form action="index.php?admin/categories/delete" method="post" 
        onsubmit="if(!confirm('Are you sure you want to delete this category?') ) { event.preventDefault(); }">
          <input type="hidden" name="id" value="<?=$category->id?>">
          <button class="btn btn-xs btn-danger"  type="submit">Delete</button>
        </form>

        </div>
      </td>
  </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>



