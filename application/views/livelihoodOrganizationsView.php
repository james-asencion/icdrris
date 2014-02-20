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
    <h4>Livelihood Organizations</h4>
    <table class="table table-striped">
    <tr><th>Organization Name</th><th>Address</th><th>No of members</th><th>Initial Income</th><th>Status</th><th>Date Established</th><th>Business Activity Type</th><th>Actions</th></tr>
    <?php foreach ($organizations as $organization) {
                echo "<tr><td>".$organization->livelihood_organization_name.
                "</td><td>".$organization->livelihood_organization_address."</td>
                <td>".$organization->no_of_members."</td>
                <td>".$organization->initial_income."</td>
                <td>".$organization->livelihood_organization_status."</td>
                <td>".$organization->date_established."</td>
                <td>".$organization->business_activity_type."</td>
                <td><a href=\"#\" class=\"confirm-delete\" data-name=\"".$organization->livelihood_organization_name."\" data-id=".$organization->livelihood_organization_id."><i class=\"icon-trash\"></i></a><a class=\"confirm-edit\" align=\"center\" href=viewLivelihoodOrganization/id/".$organization->livelihood_organization_id."><i class=\"icon-search\"></i></a></td></tr>";
    } ?>  
    </table>
</div>
<div id="modalDelete" class="modal hide">
    <div class="modal-body">
        <div name="message">
        </div>
    </div>
    <div class="modal-footer">
        <a id="btnYes" class="btn danger">Yes</a>
        <a data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
    </div>
</div>






<!--

--> 