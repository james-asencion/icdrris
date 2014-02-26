    </div>
</div>
<div class = "container-fluid">
<div class = "row-fluid">
 <div class="well span4">
 <h3>Response Organization</h3> 
	   Name: <?php echo $org->response_organization_name; ?>
        <br>Phone Number: <?php echo $org->response_organization_phone_num; ?>
        <br>Email: <?php echo $org->response_organization_email; ?>
        <br>Address: <?php echo $org->response_organization_address;?>
        <br>Contact Person: <?php echo $org->response_organization_contact_person; ?>
        <br>Members Count: <?php echo $org->response_organization_members_count; ?>
        <br>Members Available: <?php echo $org->response_organization_members_available; ?>
        <br><br>
</div>

<div></div>
<div class = "well span8">
<div id="membersTable">
    <h4>Response Organization Members</h4>
            
            <div style="float: right; margin-bottom: 10px">
                <a href = "#modalAddResOrgMembers" class = "btn btn-primary" data-toggle = "modal" data-org="<?php echo $org->response_organization_id; ?>">Add Members</a>
                <button class="btn edit"><i class="icon-pencil"></i>edit</button>
                <button class="btn btn-success btn-small hide">Done Editing</button> 
            </div>


    <table id="members" class="table table-striped">
    <tr><th>First Name</th><th>Last Name</th><th>Sex</th><th>Birthday</th><th>Civil Status</th><th>Actions</th></tr>
    <?php foreach ($members as $member) {
                echo "<tr>
                <td><span href=\"#\" id=\"response_organization_member_first_name\" data-name\"response_organization_member_first_name\" data-type=\"text\" data-pk=\"".$member->response_organization_member_id."\" data-title=\"Enter First Name\">".$member->response_organization_member_first_name."</span></td>
                <td><span href=\"#\" id=\"response_organization_member_last_name\" data-name\"response_organization_member_last_name\" data-type=\"text\" data-pk=\"".$member->response_organization_member_id."\" data-title=\"Enter Last Name\">".$member->response_organization_member_last_name."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_sex\" data-name\"response_organization_member_sex\" data-type=\"text\" data-pk=\"".$member->response_organization_member_id."\" data-title=\"Enter Sex\">".$member->response_organization_member_sex."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_birthday\" data-name\"response_organization_member_birthday\" data-type=\"text\" data-pk=\"".$member->response_organization_member_id."\" data-title=\"Enter Birthday\">".$member->response_organization_member_birthday."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_civil_status\" data-name\"response_organization_member_civil_status\" data-type=\"text\" data-pk=\"".$member->response_organization_member_id."\" data-title=\"Enter Civil Status\">".$member->response_organization_member_civil_status."</a></td>
                <td><a href=\"#\" class=\"confirm-deleteResOrgMember\" data-orgid=".$org->response_organization_id." data-lastname=\"".$member->response_organization_member_last_name."\" data-id=".$member->response_organization_member_id."><i class=\"icon-trash\"></i></a></td></tr>";
            
    } ?>  
    </table>
</div>
</div></div></div>

<div id = "modalAddResOrgMembers"  class = "modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class = "container-fluid"><div class = "modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4>Register Response Organization</h4>
    </div>
    <div class = "modal-body">
        <form id="addMemberForm" class = "form-horizontal">
        <div class="control-group"><label class = "label-control" for="ro_first_name">First Name: </label><div class="controls"><input type="text" name="ro_first_name" id="ro_first_name"  /></div></div>
        <div class="control-group"><label class = "label-control" for="ro_last_name">Last Name: </label><div class="controls"><input type="text" name="ro_last_name" id="ro_last_name"  /></div></div>
        <div class="control-group"><label class = "label-control" for="ro_sex">Sex: </label><div class="controls"><input type="text" name="ro_sex" id="ro_sex"  /></div></div>
        <div class="control-group"><label class = "label-control" for="ro_birthday">Birthday: </label><div class="controls"><input type="date" name="ro_birthday" id="ro_birthday"  /></div></div>
        <div class="control-group"><label class = "label-control" for="ro_civil_status">Civil Status: </label><div class="controls"><input type="text" name="ro_civil_status" id="ro_civil_status"  /></div></div> 
</form></div>
    <div class = "modal-footer">
        <div class="btn btn-primary" id="addMemberButton2" data-org="<?php echo $org->response_organization_id; ?>">Add Member</div>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button></center>
    </div></div>
</div>

<!--
<div class = "row-fluid">
    <div class = "well span4">
    <legend>Add Members</legend>
    <label>First Name</label>
    <input type='text' class = 'span12' placeholder='Type something..' id='activity_description'><br>
    <label>Last Name</label>
    <input type='text' class = 'span12' placeholder='Type something..' id='activity_description'><br>
    <label>Sex</label>
    <input type='text' class = 'span12' placeholder='Type something..' id='activity_description'><br>
    <label>Birthday</label>
    <input type='text' class = 'span12' placeholder='Type something..' id='activity_description'><br>
    <label>Civil Status</label>
    <input type='text' class = 'span12' placeholder='Type something..' id='activity_description'><br>
</div>
    
</div>-->
  
<div id="modalDeleteResOrgMember" class="modal hide fade">
    <div class="modal-body">
        <div name="message">
        </div>
    </div>
    <div class="modal-footer">
        <a id="btnYesDeleteResOrgMember" class="btn danger">Yes</a>
        <a data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
    </div>
</div>