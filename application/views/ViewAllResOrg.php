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
<div id="membersTable" class="container" >
    <h4>Response Organizations</h4>
    <table class="table table-striped">
    <tr><th>Response Organization Name</th><th>Phone Number</th><th>Email</th><th>Address</th><th>Contact Person</th><th>Members Count</th><th>Members Available</th><th>Actions</th></tr>
    <?php foreach ($organizations as $organization) {
                echo "<tr><td>".$organization->response_organization_name.
                "</td><td>".$organization->response_organization_phone_num."</td>
                <td>".$organization->response_organization_email."</td>
                <td>".$organization->response_organization_address."</td>
                <td>".$organization->response_organization_contact_person."</td>
                <td>".$organization->response_organization_members_count."</td>
                <td>".$organization->response_organization_members_available."</td>
                <td><a href=\"#\" class=\"confirm-deleteResOrg\" data-name=\"".$organization->response_organization_name."\" data-id=".$organization->response_organization_id."><i class=\"icon-trash\"></i></a><a class=\"confirm-edit\" align=\"center\" href=ViewResOrg/id/".$organization->response_organization_id."><i class=\"icon-search\"></i></a></td></tr>";
    } ?>  
    </table>
</div>
<div id="modalDeleteResOrg" class="modal hide">
    <div class="modal-body">
        <div name="message">
        </div>
    </div>
    <div class="modal-footer">
        <a id="btnYesDeleteResOrg" class="btn danger">Yes</a>
        <a data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
    </div>
</div>






<!--

--> 