    </div>
</div>
<div class = "container-fluid">
<div class = "row-fluid">
<!--<div class = "row-fluid">-->
 <div class="well span3">
 <h3><?php foreach($livelihood_org as $org){ echo $org->livelihood_organization_name; ?></h3>
    <br>Address: <?php echo $org->livelihood_organization_address; ?>
    <br>Members: <?php echo $org->no_of_members; ?>
    <br>Initial Income: <?php echo $org->initial_income;?>
    <br>Status: <?php echo $org->livelihood_organization_status; ?>
    <br>Date Established: <?php echo $org->date_established; ?>
    <br>Business Activity Type: <?php echo $org->business_activity_type; }?>
    
</div>



<div class = "well span9">
<div id="membersTable">
    <h4>Livelihood Organization Members</h4>

            <div style="float: right; margin-bottom: 10px">
                <button class="btn edit"><i class="icon-pencil"></i>edit</button>
                <button class="btn btn-success btn-small hide">Done Editing</button> 
            </div>



    <table id="members" class="table table-striped">
    <tr><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Sex</th><th>Birthday</th><th>Age</th><th>Monthly Income</th><th>Source of income</th><th>Civil Status</th><th>Number of Children</th><th>Actions</th></tr>
    <?php foreach ($members as $member) {
                echo "<tr>
                <td><a href=\"#\" id=\"first_name\" data-name\"first_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter First Name\">".$member->first_name."</a></td>
                <td><a href=\"#\" id=\"middle_name\" data-name\"middle_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Middle Name\">".$member->middle_name."</a></td>
                <td><a href=\"#\" id=\"last_name\" data-name\"last_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Last Name\">".$member->last_name."</a></td>
                <td><a href=\"#\" id=\"sex\" data-name\"sex\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Sex\">".$member->sex."</a></td>
                <td><a href=\"#\" id=\"birthday\" data-name\"birthday\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Birthday\">".$member->birthday."</a></td>
                <td><a href=\"#\" id=\"age\" data-name\"age\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Age\">".$member->age."</a></td>
                <td><a href=\"#\" id=\"monthly_income\" data-name\"monthly_income\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Monthly Income\">".$member->monthly_income."</a></td>
                <td><a href=\"#\" id=\"source_of_income\" data-name\"source_of_income\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Source of Income\">".$member->source_of_income."</a></td>
                <td><a href=\"#\" id=\"civil_status\" data-name\"civil_status\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Civil Status\">".$member->civil_status."</a></td>
                <td><a href=\"#\" id=\"no_of_children\" data-name\"no_of_children\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter No of children\">".$member->no_of_children."</a></td>
                <td><a align=\"center\" href=localhost/icdrris/Livelihood/deleteMember?id=".$member->member_id."</a></td></tr>";
    } ?>  
    </table>
</div>
</div>
<!--</div>-->
</div>
<div id="modal-delete" class="modal hide fade">
    <div class="modal-body">
        <p>Are you sure want to delete this organization?</p>
    </div>
    <div class="modal-footer">
        <a href="deleteResOrg?id=" class="btn danger">Yes</a>
        <a href="javascript:$('modal-delete').modal('hide')" class="btn secondary">No</a>
    </div>
</div>



<!--

-->