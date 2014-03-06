    </div>
</div>
 <div class="well offset2 span 8">
 <h3>Livelihood Program</h3> 
     &nbsp;&nbsp; 
        Livelihood Program Type: <?php echo $livelihood_program->livelihood_type; ?><br>Description: &nbsp;&nbsp;<?php echo $livelihood_program->livelihood_description; ?>
        <br>Cost: &nbsp;&nbsp;<?php echo $livelihood_program->livelihood_program_cost; ?>&nbsp;&nbsp;&nbsp;&nbsp;<br>Target Recipients: &nbsp;&nbsp;<?php echo $livelihood_program->target_recipients;?>
        <br>Livelihood Program Status: &nbsp;&nbsp;<?php echo $livelihood_program->livelihood_program_status; ?>

        <br>
        <button id="showDeployments" class="btn btn-small btn-inverse showRecipients">Show/Hide Deployments</button>
<div id="grantedLivelihoodOrganizations" style="display:none;">
        <h5>Deployment Recipients: </h5>
        
        <table class="table table-striped">
        <tr><th>Livelihood Organization Name</th><th>Business Activity Type</th><th>Date Granted</th><th>Actions</th></tr>
        <?php foreach ($recipients as $recipient) {
                    echo "<tr>
                    <td>".$recipient->livelihood_organization_name."</td>
                    <td>".$recipient->business_activity_type."</td>
                    <td>".$recipient->date_granted."</td>
                    <td>
                    <a href=\"#\" class=\"confirm-removeRecipient\" data-programId =\"".$livelihood_program->livelihood_program_id."\" data-name=\"".$recipient->livelihood_organization_name."\" data-id=".$recipient->livelihood_organization_id.">
                    <i class=\"icon-trash\"></i></a>
                    </td></tr>";
        } ?>  
    </table>
</div>

</div>

  


<br></br>
<div class = "well offset1 span12">
<div id="pendingRequestList">
    <h5>Pending Livelihood Program Requests</h5>
    <div style="float: right; margin-bottom: 5px">
                    <button id="showRequests" class="btn btn-default showRequests">Show/Hide</button>
    </div>
    <table id="pendingRequests" class="table table-striped" style="display:none;">
    <tr><th>Livelihood Organization Name</th><th>Business Activity Type</th><th>Request Status</th><th>Request Description</th><th>Date Requested</th><th>Actions</th></tr>
    <?php foreach ($pending_requests as $request) {
                echo "<tr>
                <td>".$request->livelihood_organization_name."</td>
                <td>".$request->business_activity_type."</td>
                <td>".$request->request_status."</td>
                <td>".$request->request_description."</td>
                <td>".$request->date_requested."</td>
                <td>
                <a href=\"#\" class=\"confirm-delete\" data-name=\"".$request->request_description."\" data-id=".$request->livelihood_organization_program_request_id.">
                <i class=\"icon-trash\"></i></a>
                <a href=\"#\" class=\"approveProgramRequest\" data-name=\"".$request->livelihood_organization_name."\" data-program =\"".$livelihood_program->livelihood_program_id."\" data-organization=\"".$request->livelihood_organization_id."\" data-request=\"".$request->livelihood_organization_program_request_id."\">
                <i class=\"icon-share\"></i></a>
                </td></tr>";
    } ?>  
    </table>
</div>
</div>

<div class = "well offset1 span12">
<div id="livelihoodOrganizationsList" class="container" >
    <h5>Livelihood Organizations</h5>
    <div style="float: right; margin-bottom: 5px">
                    <button id="showOrganizations" class="btn btn-default showOrganizations">Show/Hide</button>
    </div>
    <table id="livelihoodOrganizationsTable" class="table table-striped" style="display:none;">
    <tr><th>Organization Name</th><th>Address</th><th>No of members</th><th>Initial Income</th><th>Status</th><th>Date Established</th><th>Business Activity Type</th><th>Actions</th></tr>
    <?php foreach ($livelihood_organizations_not_requested as $organization) {
                echo "<tr><td>".$organization->livelihood_organization_name.
                "</td><td>".$organization->livelihood_organization_address."</td>
                <td>".$organization->no_of_members."</td>
                <td>".$organization->initial_income."</td>
                <td>".$organization->livelihood_organization_status."</td>
                <td>".$organization->date_established."</td>
                <td>".$organization->business_activity_type."</td>
                <td>
                <a href=\"#\" class=\"deployLivelihoodProgram\" data-name=\"".$organization->livelihood_organization_name."\" data-program =\"".$livelihood_program->livelihood_program_id."\" data-organization=\"".$organization->livelihood_organization_id."\"><i class=\"icon-share\"></i></a>
                <a class=\"confirm-edit\" align=\"center\" href=viewLivelihoodOrganization/id/".$organization->livelihood_organization_id."><i class=\"icon-search\"></i></a>
                </td></tr>";
    } ?>  
    </table>
</div>
</div>



</div>
<div id="modal-deployLivelihoodProgram" class="modal hide fade">
    <div class="modal-body" id="deployLivelihoodProgramModalBody">
        <form class="form-horizontal">
        <?php foreach ($program_resources as $resource) {
            echo "  <label class=\"control-label\">".$resource->livelihood_resource_description."   (".$resource->quantity_available.")</label>
                        <div class=\"controls resourceInput\">
                            <input type=\"text\" data-id=\"".$resource->livelihood_resource_id."\" data-resource=\"".$resource->livelihood_program_resource_id."\">
                        </div><br>";

        }?>
        
        </form>            
    </div>
    <div class="modal-footer">
        <a class="btn" id="confirmDeployment">Confirm Deployment</a>
        <a href="javascript:$('#modal-deployLivelihoodProgram').modal('hide')" class="btn secondary">Cancel</a>
    </div>
</div>

<div id="modal-approveRequest" class="modal hide fade">
    <div class="modal-body" id="approveRequestModalBody">
        <form class="form-horizontal">
        <?php foreach ($program_resources as $resource) {
            echo "  <label class=\"control-label\">".$resource->livelihood_resource_description."   (".$resource->quantity_available.")</label>
                        <div class=\"controls resourceInput\">
                            <input type=\"text\" data-id=\"".$resource->livelihood_resource_id."\" data-resource=\"".$resource->livelihood_program_resource_id."\">
                        </div><br>";

        }?>
        
        </form>            
    </div>
    <div class="modal-footer">
        <a class="btn" id="confirmApproval">Confirm Approval</a>
        <a href="javascript:$('#modal-approveRequest').modal('hide')" class="btn secondary">Cancel</a>
    </div>
</div>



<!--

-->