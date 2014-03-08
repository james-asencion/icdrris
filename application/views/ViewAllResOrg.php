    </div>
</div>
<div></div>
<br></br>
  <div class = "modal hide fade" id="instructionModal">
    <div class = "modal-header">
        <a class="close" data-dismiss="modal">x</a>
        <h3>Click on a point in the map to create a marker</h3>
    </div>
    <div class="modal-body">
        <p>Drag the marker to the desired location and click on the marker to view the form for incident reporting</p>
    </div>
    <div class="modal-footer">
        <a data-dismiss="modal" class="btn btn-primary">Okay Got it</a>
    </div>
  </div>
<div id="membersTable" class = "container-fluid">
    <div class = "container-fluid"><div class = "row-fluid">
    </div></div>
   <div class = "container-fluid"><div class = "container-fluid"><div class = "container-fluid"><div class = "container-fluid"><div class = "container-fluid">
    <table id = "members1" class="table table-striped">
        <h3>Response Organizations</h3>
        <div style="float: right; margin-bottom: 10px">
            <a href = "#modalAddResOrg" class = "btn btn-primary" data-toggle = "modal">Add Organization</a>
                <button class="btn edit"><i class="icon-pencil"></i>edit</button>
                <button class="btn btn-success btn-small hide">Done Editing</button> 
            </div>
    <tr><th>Response Organization Name</th><th>Phone Number</th><th>Email</th><th>Address</th><th>Contact Person</th><th>Members Count</th><th>Members Available</th><th>Actions</th></tr>
    <div id="responseOrganizations" name="responseOrganizations">
    <?php foreach ($organizations as $organization) {
                echo "<tr><td><span href=\"#\" id=\"response_organization_name\" data-name\"response_organization_name\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Name\">".$organization->response_organization_name.
                "</span></td><td><span href=\"#\" id=\"response_organization_phone_num\" data-name\"response_organization_phone_num\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Phone Number\">".$organization->response_organization_phone_num."</span></td>
                <td><span href=\"#\" id=\"response_organization_email\" data-name\"response_organization_email\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Email\">".$organization->response_organization_email."</span></td>
                <td><span href=\"#\" id=\"response_organization_address\" data-name\"response_organization_address\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Address\">".$organization->response_organization_address."</span></td>
                <td><span href=\"#\" id=\"response_organization_contact_person\" data-name\"response_organization_contact_person\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Contact Person\">".$organization->response_organization_contact_person."</span></td>
                <td><span href=\"#\" id=\"response_organization_members_count\" data-name\"response_organization_members_count\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Members Count\">".$organization->response_organization_members_count."</span></td>
                <td><span href=\"#\" id=\"response_organization_members_available\" data-name\"response_organization_members_available\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Members Available\">".$organization->response_organization_members_available."</span></td>
                <td><a href=\"#\" class=\"confirm-deleteResOrg\" data-name=\"".$organization->response_organization_name."\" data-id=".$organization->response_organization_id."><i class=\"icon-trash\"></i></a><a class=\"confirm-edit\" align=\"center\" href=ViewResOrg/id/".$organization->response_organization_id."><i class=\"icon-search\"></i></a><a align=\"center\" href=deployResponseOrganization/".base_convert($organization->response_organization_id,10,36)."><i class=\"icon-share-alt\"></i></a></td></tr>";
    } ?>
    </div>  
    </table></div></div></div></div></div>
</div>

<div id="modalDeleteResOrg" class="modal hide fade">
    <div class="modal-body">
        <div name="message">
        </div>
    </div>
    <div class="modal-footer">
        <a id="btnYesDeleteResOrg" class="btn danger">Yes</a>
        <a data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
    </div>
</div>

<div id = "modalAddResOrg" class = "modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class = "container-fluid"><div class = "modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4>Register Response Organization</h4>
    </div>
    <div class = "modal-body">
        <form id="addMemberForm" class = "form-horizontal">
        <div class = "control-group"><label class = "control-label" for="name">Response Organization Name: </label><div class = "controls"><input type="text" name="ro_name" id="ro_name" value="<?php echo set_value('ro_name'); ?>"/></div></div>
        <div class = "control-group"><label class = "control-label" for="phone_num">Phone Number: </label><div class = "controls"><input type="text" name="ro_phone_num" id="ro_phone_num" value="<?php echo set_value('ro_phone_num'); ?>"/></div></div>
        <div class = "control-group"><label class = "control-label" for="email">Email: </label><div class = "controls"><input type="text" name="ro_email" id="ro_email" value="<?php echo set_value('ro_email'); ?>"/></div></div>
        <div class = "control-group"><label class = "control-label" for="address">Address: </label><div class = "controls"><input type="text" name="ro_address" id="ro_address" value="<?php echo set_value('ro_address'); ?>"/></div></div>
        <div class = "control-group"><label class = "control-label" for="contact_person">Contact Person: </label><div class = "controls"><input type="text" name="ro_contact_person" id="ro_contact_person" value="<?php echo set_value('ro_contact_person'); ?>"/></div></div>
        <div class = "control-group"><label class = "control-label" for="members_count">Members Count: </label><div class = "controls"><input type="text" name="ro_members_count" id="ro_members_count" value="<?php echo set_value('ro_members_count'); ?>"/></div></div>
        <div class = "control-group"><label class = "control-label" for="members_available">Members Available: </label><div class = "controls"><input type="text" name="ro_members_available" id="ro_members_available" value="<?php echo set_value('ro_members_available'); ?>"/></div></div>  
</form></div>
    <div class = "modal-footer">
        <div class="btn btn-primary" id="addResOrgButton1">Add Organization</div>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button></center>
    </div></div>
</div>






<!--

--> 