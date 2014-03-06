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
    <br><br>
    <a href="http://localhost/icdrris/Livelihood/viewAvailableLivelihoodPrograms/<?php echo $org->livelihood_organization_id; ?>" class="btn btn-success"><i class="icon-share"></i>Send Livelihood Program Request</a>
</div>



<div class = "well span9">
<div id="membersPanel">
    <h4>Livelihood Organization Members</h4>

            <div style="float: right; margin-bottom: 10px">
                <a class = "btn btn-primary addLivelihoodOrgMembers" data-toggle = "modal" data-org="<?php echo $org->livelihood_organization_id; ?>">Add Members</a>
                <button class="btn edit"><i class="icon-pencil"></i>edit</button>
                <button class="btn btn-doneEdit btn-success btn-small hide">Done Editing</button> 
            </div>


    <div id="members">
    <table id="membersTable" class="table table-striped">
    <tr><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Sex</th><th>Birthday</th><th>Age</th><th>Monthly Income</th><th>Source of income</th><th>Civil Status</th><th>Number of Children</th><th>Actions</th></tr>
    <?php foreach ($members as $member) {
                echo "<tr>
                <td><span href=\"#\" id=\"first_name\" data-name\"member_first_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter First Name\">".$member->first_name."</span></td>
                <td><span href=\"#\" id=\"middle_name\" data-name\"member_middle_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Middle Name\">".$member->middle_name."</span></td>
                <td><span href=\"#\" id=\"last_name\" data-name\"member_last_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Last Name\">".$member->last_name."</span></td>
                <td><span href=\"#\" id=\"sex\" data-name\"member_sex\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Sex\">".$member->sex."</span></td>
                <td><span href=\"#\" id=\"birthday\" data-name\"member_birthday\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Birthday\">".$member->birthday."</span></td>
                <td><span href=\"#\" id=\"age\" data-name\"member_age\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Age\">".$member->age."</span></td>
                <td><span href=\"#\" id=\"monthly_income\" data-name\"member_monthly_income\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Monthly Income\">".$member->monthly_income."</span></td>
                <td><span href=\"#\" id=\"source_of_income\" data-name\"member_source_of_income\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Source of Income\">".$member->source_of_income."</span></td>
                <td><span href=\"#\" id=\"civil_status\" data-name\"member_civil_status\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Civil Status\">".$member->civil_status."</span></td>
                <td><span href=\"#\" id=\"no_of_children\" data-name\"member_no_of_children\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter No of children\">".$member->no_of_children."</span></td>
                <td><a align=\"center\" href=localhost/icdrris/Livelihood/deleteMember?id=".$member->member_id."</a></td></tr>";
    } ?>  
    </table>
    </div>
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

<div id = "modalAddLivelihoodOrgMembers"  class = "modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class = "container-fluid"><div class = "modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4>Register Members</h4>
    </div>
    <div class = "modal-body">
        <form id="addMemberForm">
        <div class="row"><div class="span3"><label for="name">First Name: </label></div><div class="span9"><input type="text" name="member_first_name" id="member_first_name"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Last Name: </label></div><div class="span9"><input type="text" name="member_last_name" id="member_last_name"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Middle Name: </label></div><div class="span9"><input type="text" name="member_middle_name" id="member_middle_name"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Sex: </label></div>
            <div class="span3">
            <select class="span2" name="member_sex" id="member_sex">
                <option value=''></option>
                <option value='Male'>Male</option>
                <option value='Female'>Female</option>
            </select>
            </div>
        </div>
        <div class="row"><div class="span3"><label for="name">Birthday: </label></div><div class="span9"><input type="date" name="member_birthday" id="member_birthday"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Age: </label></div><div class="span9"><input type="text" name="member_age" id="member_age"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Monthly Income: </label></div><div class="span9"><input type="text" name="member_monthly_income" id="member_monthly_income" /></div></div>
        <div class="row"><div class="span3"><label for="name">Source of Income: </label></div>
            <div class="span3">
            <select class="span2" name="member_source_of_income" id="member_source_of_income">
                <option value=''>Select</option>
                <option value='Entrepreneurship'>Entrepreneurship</option>
                <option value='Manufacturing'>Manufacturing</option>
                <option value='Farming'>Farming</option>
                <option value='Fishing'>Fishing</option>
            </select>
            </div>
        </div>
        <div class="row"><div class="span3"><label for="name">Civil Status: </label></div>
            <div class="span3">
            <select class="span2" name="member_civil_status" id="member_civil_status">
                <option value=''></option>
                <option value='Single'>Single</option>
                <option value='Married'>Married</option>
            </select>
            </div>
        </div>
        <div class="row"><div class="span3"><label for="name">No of children: </label></div><div class="span9"><input type="text" name="member_no_of_children" id="member_no_of_children"  /></div></div>
        
</form></div>
    <div class = "modal-footer">
        <div class="btn btn-primary" id="addLivelihoodMemberButton" data-org="<?php echo $org->livelihood_organization_id; ?>">Add Member</div>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button></center>
    </div></div>
</div>



<!--

-->