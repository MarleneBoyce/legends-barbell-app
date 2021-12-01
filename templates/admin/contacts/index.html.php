<!--MBOYCE NEW 1L : Used bootstrap default container, this container is responsive, fixed-with, and it's max-width changes at each break point-->
<div class="container">

<!--MBOYCE 3L: Styling Header for webpage-->
<div class="d-flex justify-content-between">
<h2><b>Legends Barbell Messages</b></h2>
</div>

<!--MBOYCE 12L: Created table to display messages from "Contact Us" Page-->
<table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone Number </th>
      <th scope="col">Subject</th>
      <th scope="col">Message</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <!--MBOYCE NEW 1L: Created foreach to display contact information -->
  <?php foreach($contacts as $key => $contact): ?>
  <tr>
      <!--MBOYCE 6L: Displaying numbers correctly by adding 1, then displaying first name, last name, email, phone number, subject, and message-->
      <th scope="row"><?= $key + 1 ?></th>
      <td><?=$contact->first_name . " " . $contact->last_name;?></td>
	    <td><?=$contact->email;?></td>
      <td><?=$contact->phone_number;?></td>
      <td><?=$contact->subject;?></td>
      <td><?=$contact->message;?></td>	
      <td>
        <!--MBOYCE NEW 1L: Created button group to display delete button-->
        <div class="btn-group">

        <!--MBOYCE 5L: Prompting the user to confirm if they want to delete the message, and created delete button-->  
        <form action="index.php?admin/contact/delete" method="post" 
        onsubmit="if(!confirm('Are you sure you want to delete this message?') ) { event.preventDefault(); }">
          <input type="hidden" name="id" value="<?=$contact->id?>">
          <button class="btn btn-xs btn-danger"  type="submit">Delete</button>
        </form>
        </div>
      </td>
  </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>



