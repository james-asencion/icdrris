    </div>
</div>
<div id="container">
 <div class="well offset5 span 6">
 <h3>Livelihood Organization</h3> 
	Name: &nbsp;&nbsp;<?php echo $livelihood_org->livelihood_organization_name; ?><br>Address: &nbsp;&nbsp;<?php echo $livelihood_org->livelihood_organization_address; ?>
        <br>Members: &nbsp;&nbsp;<?php echo $livelihood_org->no_of_members; ?>&nbsp;&nbsp;&nbsp;&nbsp;<br>Initial Income: &nbsp;&nbsp;<?php echo $livelihood_org->initial_income;?>
        <br>Status: &nbsp;&nbsp;<?php echo $livelihood_org->livelihood_organization_status; ?>&nbsp;&nbsp;&nbsp;&nbsp;<br>Date Established: &nbsp;&nbsp;<?php echo $livelihood_org->date_established; ?>
        <br>Business Activity Type: &nbsp;&nbsp;<?php echo $livelihood_org->business_activity_type; ?>
        <br><br>
</div>

<div class = "well offset3 span12">
</div>
<div></div>
<br></br>

<div class = "well offset3 span12">
<div id="membersTable">
    <h4>Livelihood Organization Members</h4>;
    <table class="table table-striped">
    <tr><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Sex</th><th>Birthday</th><th>Age</th><th>Monthly Income</th><th>Source of income</th><th>Civil Status</th><th>Number of Children</th><th>Actions</th></tr>
    <? foreach ($members as $member) {
                echo "<tr><td>".$member->first_name."</td><td>".$member->middle_name."</td><td>".$member->last_name."</td><td>".$member->sex."</td><td>".$member->birthday."</td><td>".$member->age."</td><td>".$member->monthly_income."</td><td>".$member->source_of_income."</td><td>".$member->civil_status."</td><td>".$member->no_of_children."</td><td><a align=\"center\" href=localhost/icdrris/Livelihood/deleteMember?id=".$member->member_id."</a></td></tr>";
    } ?>  
    </table>;
</div>
</div>
<div id="modal-delete" class="modal hide fade">
    <div class="modal-body">
        <p>Are you sure want to delete this organization?</p>
    </div>
    <div class="modal-footer">
        <a href="deleteLivelihoodOrg?id=" class="btn danger">Yes</a>
        <a href="javascript:$('modal-delete').modal('hide')" class="btn secondary">No</a>
    </div>
</div>



<!--

-->