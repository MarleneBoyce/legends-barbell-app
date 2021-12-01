<!--MBOYCE NEW 1L : Used bootstrap default container, this container is responsive, fixed-with, and it's max-width changes at each break point-->
<div class="container">

<!--MBOYCE 2L: Styled and created header for page-->
<div class="d-flex justify-content-between">
<h2><b>Manage Users</b></h2>

<!--MBOYCE 4L: Within the 'Manger Users' header, I added a 'Add User' button --> 
<div>
<a class="btn btn-primary" href="index.php?admin/user/edit">Add User</a>
</div>
</div>

<!--MBOYCE 10L: Created table and assigned table headings -->
<table class="table table-hover" >
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">User Name</th>
	  <th scope="col">Email</th>
	  <th scope="col">Role</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <!--MBOYCE 9L: Created foreach to display user's information and also inserted an edit button-->
  <?php foreach($users as $key => $user): ?>
  <tr>
      <th scope="row"><?= $key + 1 ?></th>
      <td><?=$user->first_name . " " . $user->last_name;?></td>
	    <td><?=$user->email;?></td>
		  <td><?=ucfirst($user->getRole()[0]->name);?></td>	
      <td>
        <div class="btn-group">
        <a class="btn btn-xs btn-info" href="index.php?admin/user/edit?id=<?=$user->id?>">Edit</a> 
        
        <!--MBOYCE 2L: If the user selects 'delete' a prompt will appear asking them to confirm their decision-->
        <form action="index.php?admin/user/delete" method="post" 
        onsubmit="if(!confirm('Are you sure you want to delete this user?') ) { event.preventDefault(); }">
        
        <!--MBOYCE 2L: If the user confirms the user will be deleted through the delete button-->
        <input type="hidden" name="id" value="<?=$user->id?>">
        <button class="btn btn-xs btn-danger"  type="submit">Delete</button>
        </form>

        </div>
      </td>
  </tr>
  <?php endforeach; ?>

  </tbody>
</table>
</div>


