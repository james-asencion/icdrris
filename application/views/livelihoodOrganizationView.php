    </div>
</div>
<div id="container">
 <div class="well offset5 span 6">
 <h3>Livelihood Organization</h3> 
 <?php foreach ($livelihood_org as $org) { ?>

	Name: &nbsp;&nbsp;<?php echo $org->livelihood_organization_name; ?><br>Address: &nbsp;&nbsp;<?php echo $org->livelihood_organization_address; ?>
        <br>Members: &nbsp;&nbsp;<?php echo $org->no_of_members; ?>&nbsp;&nbsp;&nbsp;&nbsp;<br>Initial Income: &nbsp;&nbsp;<?php echo $org->initial_income;?>
        <br>Status: &nbsp;&nbsp;<?php echo $org->livelihood_organization_status; ?>&nbsp;&nbsp;&nbsp;&nbsp;<br>Date Established: &nbsp;&nbsp;<?php echo $org->date_established; ?>
        <br>Business Activity Type: &nbsp;&nbsp;<?php echo $org->business_activity_type; ?>
        <br><br>
<?php } ?>
</div>

<div class = "well offset3 span12">
<div class="btn btn-small btn-primary" id="addMemberButton" align="center">Add Member</div>
</div>
<div></div>
<br></br>

<div class = "well offset3 span12">
<div id="membersTable">
        <button class="btn btn-small btn-success" id="editMembersButton" align="center">Edit Members</button>
        <h4>Livelihood Organization Members</h4>
        <table class="table table-striped">
            <tr><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Sex</th><th>Birthday</th><th>Age</th><th>Monthly Income</th><th>Source of income</th><th>Civil Status</th><th>Number of Children</th><th>Actions</th></tr>
          <?php
           foreach ($members as $member) {
                echo "<tr><td><a href=\"#\" id=\"first_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-url=\"/post\" data-title=\"First Name:\">".$member->first_name."</a></td><td>".$member->middle_name."</td><td>".$member->last_name."</td><td>".$member->sex."</td><td>".$member->birthday."</td><td>".$member->age."</td><td>".$member->monthly_income."</td><td>".$member->source_of_income."</td><td>".$member->civil_status."</td><td>".$member->no_of_children."</td>
                <td><a href=\"#\" class=\"modify\" data-id=" . $member->member_id . "><i class=\"icon-edit\"></i></a></td></tr>";
           }  ?>
           </table>
</div>
</div>



<!--

-->