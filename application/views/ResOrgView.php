    </div>
</div>
<div class = "container-fluid">
<div class = "row-fluid">
 <div class="well span4">
 <h3>Response Organization</h3> 
	   Name: <?php foreach($response_org as $org){ echo $org->response_organization_name; ?>
        <br>Phone Number: <?php echo $org->response_organization_phone_num; ?>
        <br>Email: <?php echo $org->response_organization_email; ?>
        <br>Address: <?php echo $org->response_organization_address;?>
        <br>Contact Person: <?php echo $org->response_organization_contact_person; ?>
        <br>Members Count: <?php echo $org->response_organization_members_count; ?>
        <br>Members Available: <?php echo $org->response_organization_members_available; }?>
        <br><br>
</div>

<div></div>
<div class = "well span8">
<div id="membersTable">
    <h4>Response Organization Members</h4>

            <div style="float: right; margin-bottom: 10px">
                <button class="btn edit"><i class="icon-pencil"></i>edit</button>
                <button class="btn btn-success btn-small hide">Done Editing</button> 
            </div>



    <table id="members" class="table table-striped">
    <tr><th>First Name</th><th>Last Name</th><th>Sex</th><th>Birthday</th><th>Civil Status</th><th>Actions</th></tr>
    <?php foreach ($members as $member) {
                echo "<tr>
                <td><a href=\"#\" id=\"ro_first_name\" data-name\"ro_first_name\" data-type=\"text\" data-pk=\"".$member->response_organization_member_id."\" data-title=\"Enter First Name\">".$member->response_organization_member_first_name."</a></td>
                <td><a href=\"#\" id=\"ro_last_name\" data-name\"ro_last_name\" data-type=\"text\" data-pk=\"".$member->response_organization_member_id."\" data-title=\"Enter Last Name\">".$member->response_organization_members_last_name."</a></td>
                <td><a href=\"#\" id=\"ro_sex\" data-name\"ro_sex\" data-type=\"text\" data-pk=\"".$member->response_organization_member_id."\" data-title=\"Enter Sex\">".$member->response_organization_members_sex."</a></td>
                <td><a href=\"#\" id=\"ro_birthday\" data-name\"ro_birthday\" data-type=\"text\" data-pk=\"".$member->response_organization_member_id."\" data-title=\"Enter Birthday\">".$member->response_organization_members_birthday."</a></td>
                <td><a href=\"#\" id=\"ro_civil_status\" data-name\"ro_civil_status\" data-type=\"text\" data-pk=\"".$member->response_organization_member_id."\" data-title=\"Enter Civil Status\">".$member->response_organization_members_civil_status."</a></td>
                <td><a align=\"center\" href=localhost/icdrris/Livelihood/deleteMember?id=".$member->response_organization_member_id."</a></td></tr>";
    } ?>  
    </table>
</div>
</div></div>

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