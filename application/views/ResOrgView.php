    </div>
</div>
<div class = "container-fluid">
<div class = "row-fluid">
 <div class="well span3">
 <h4><?php echo $org->response_organization_name; ?></h4> 
        <br>Phone Number: <?php echo $org->response_organization_phone_num; ?>
        <br>Email: <?php echo $org->response_organization_email; ?>
        <br>Address: <?php echo $org->response_organization_address;?>
        <br>Contact Person: <?php echo $org->response_organization_contact_person; ?>
        <br>Members Count: <?php echo $org->response_organization_members_count; ?>
        <br>Members Available: <?php echo $org->response_organization_members_available; ?>
        <br><br>
</div>

<div></div>
<div class = "well span9">
<div id="membersTable">
    <h4>Response Organization Members</h4>
            
            <div style="float: right; margin-bottom: 10px">
                <a href = "#modalAddResOrgMembers" class = "btn btn-primary" data-toggle = "modal" data-org="<?php echo $org->response_organization_id; ?>">Add Members</a>
                <button class="btn edit"><i class="icon-pencil"></i>edit</button>
                <button class="btn btn-doneEdit btn-success btn-small hide">Done Editing</button> 
            </div>


    <table id="members" class="table table-striped">
    <tr><th>First Name</th><th>Last Name</th><th>Sex</th><th>Birthday</th><th>Civil Status</th><th>Availability</th><th>Skills</th><th>Actions</th></tr>
    <?php foreach ($members as $member) {

        $memberSkills = $this->ResOrgModel->getSkillsByMember($member->member_id);
        $skillsString = "";
        foreach ($memberSkills as $s) {
            $skillsString .= $s->skillset_description.", ";
        } 
                echo "<tr>
                <td><span href=\"#\" id=\"response_organization_member_first_name\" data-name\"response_organization_member_first_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter First Name\">".$member->member_first_name."</span></td>
                <td><span href=\"#\" id=\"response_organization_member_last_name\" data-name\"response_organization_member_last_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Last Name\">".$member->member_last_name."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_sex\" data-name\"response_organization_member_sex\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Sex\">".$member->member_sex."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_birthday\" data-name\"response_organization_member_birthday\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Birthday\">".$member->member_birthday."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_civil_status\" data-name\"response_organization_member_civil_status\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Civil Status\">".$member->member_civil_status."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_status\" data-name\"response_organization_member_civil_status\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Member Status\">".$member->member_status."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_civil_status\" data-name\"response_organization_member_civil_status\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Skills\">".$skillsString."</a></td>
                <td><a href=\"#\" class=\"confirm-deleteResOrgMember\" data-orgid=".$org->response_organization_id." data-lastname=\"".$member->member_last_name."\" data-id=".$member->member_id."><i class=\"icon-trash\"></i></a></td></tr>";
            
    } ?>  
    </table>
</div>
</div></div></div>

<div id = "modalAddResOrgMembers"  class = "modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class = "container-fluid"><div class = "modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4>Register Response Organization <?php echo count($skills);?></h4>
    </div>
    <div class = "modal-body">
        <form id="addMemberForm" class = "form-horizontal">
        <div class="control-group"><label class = "control-label" for="ro_first_name">First Name: </label><div class="controls"><input type="text" name="ro_first_name" id="ro_first_name"  /></div></div>
        <div class="control-group"><label class = "control-label" for="ro_last_name">Last Name: </label><div class="controls"><input type="text" name="ro_last_name" id="ro_last_name"  /></div></div>
        <div class="control-group"><label class = "control-label" for="ro_sex">Sex: </label><div class="controls"><input type="text" name="ro_sex" id="ro_sex"  /></div></div>
        <div class="control-group"><label class = "control-label" for="ro_birthday">Birthday: </label><div class="controls"><input type="date" name="ro_birthday" id="ro_birthday"  /></div></div>
        <div class="control-group"><label class = "control-label" for="ro_civil_status">Civil Status: </label><div class="controls"><input type="text" name="ro_civil_status" id="ro_civil_status"  /></div></div>
        <div id="skillsList"><div class="control-group"><label class = "control-label" for="ro_skill">Skill: </label>
    <div class="controls"><div class="dropdown">
    <a class="dropdown-toggle btn" data-toggle="dropdown" href="#">
        Select
        <b class="caret"></b>
    </a>&nbsp;<button type="button" id="btnAddNewSkillTrigger" class="btn btn-small btn-default"><i class="icon-plus"></i></button>
    
    
    <ul class="skillsetDropdown dropdown-menu dropdown-menu-form" role="menu">
        <div id="skillsetCheckboxList">
       <?php 
        foreach($skills as $skill) {
          echo "<li><label class = \"checkbox\"><input type = \"checkbox\" data-id =".$skill->skillset_id.">".$skill->skillset_description."</input></label></li>";
        }
       ?>
        </div>
    </ul></div>
</div></div></div>
    <div class="control-group">
    
    <div id="addNewSkillField" style="display:none;" class="control-group"><label class = "control-label" for="ro_first_name">New Skill: </label><div class="controls"><input type="text" name="newSkill" id="newSkill"  />
    <button type="button" id="btnSubmitNewSkill" class="btn btn-small btn-success btn-submitNewSkill" style="display:none;"><i class="icon-plus" ></i></button>
<button type="button" id="cancelNewSkill" class="btn btn-small btn-danger btn-submitNewSkill" style="display:none;"><i class="icon-plus" ></i></button></div></div>
</div>
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