    </div>
</div>
 <div class="well span 5">
 <h3>Livelihood Program</h3> 
        Livelihood Program Type: <?php echo $livelihood_program->livelihood_type; ?><br>Description: &nbsp;&nbsp;<?php echo $livelihood_program->livelihood_description; ?>
        <br>Cost: &nbsp;&nbsp;<?php echo $livelihood_program->livelihood_program_cost; ?>&nbsp;&nbsp;&nbsp;&nbsp;<br>Target Recipients: &nbsp;&nbsp;<?php echo $livelihood_program->target_recipients;?>
        <br>Livelihood Program Status: &nbsp;&nbsp;<?php echo $livelihood_program->livelihood_program_status; ?>
        <br><br>
<button class="showDeploymentPanel btn btn-small btn-success" align="center" data-id="<?php echo $livelihood_program->livelihood_program_id; ?>"><i class="icon-share"></i>deploy</button>
<button class="showResourcesPanel btn btn-small btn-default" align="center" data-id="<?php echo $livelihood_program->livelihood_program_id; ?>"><i class="icon-search"></i>show resources</button><br><br>
<button class="showDeploymentHistory btn-small btn btn-default" align="center" data-id="<?php echo $livelihood_program->livelihood_program_id; ?>"><i class="icon-eye-inverse"></i>show deployments</button>

<h5>External Organization Provider/s: </h5><br>
<button class="btn btn-small showExternalOrganizationsList">show/hide external orgnizations</button>
<div id="externalOrganizationsList" style="display:none;">
<div style="float: left; margin-bottom: 10px">
                <a data-id="<?php echo $livelihood_program->livelihood_program_id;?>" class="addExternalOrg"><i class="icon-plus"></i>Add New</a><br>
                <a data-id="<?php echo $livelihood_program->livelihood_program_id;?>" class="chooseFromExistingOrg"><i class="icon-list"></i>Choose From Existing</a>
</div><br><br>
<div class="well well-small span 2">
    <table class="table table-striped">
        <th>Name</th><th>Actions</th>
        
            <?php foreach($external_organizations as $organization){
             echo "<tr><td>".$organization->agency_name."</td><td><i class=\"icon-trash\"></i></td></tr>";
             }?>
        
    </table>
</div>
</div>
<div id="externalOrganizationsTable">
        
</div>
</div>
<div id="resourcesPanel">
 <div class="well well-small span 3">
<h7>Add Livelihood Resource</h7>
 <label for="target_recipients">Resources : </label><div class="span2"></div>
        <div id="resourceDropdown" >
        <?php 
        echo "<select name=\"resource_id\" id=\"resource_id\">";
        echo "<option value=\"\">   </option>";
        foreach($resources as $resource){
          echo "<option value=\"".$resource->livelihood_resource_id."\">".$resource->livelihood_resource_description."</option>";
        }
        echo "</select>";
        ?>
        </div>
        <label for="target_recipients">Quantity : </label><div class="span2"></div><input type="text" name="resource_quantity" id="resource_quantity"/><span id="resource_quantity" class="verify"></span>
        <br><div id="btnSubmitNewResource" name="btnSubmitNewResource" data-id="<?php echo $livelihood_program->livelihood_program_id;?>" class="btn btn-primary submitLivelihoodResource">Submit</div>
</div>

<div class="well span 5" >
    <h5>List of Livelihood Resources</h5>
    <div id="livelihoodResourcesTable">
        <table class="table table-striped">
        <tr><th>Resource Description</th><th>Quantity Available</th><th>Actions</th></tr>
        <?php foreach ($program_resources as $resource) {
                    echo 
                    "<tr><td>".$resource->livelihood_resource_description.
                    "</td><td>".$resource->quantity_available."</td>
                    <td><a href=\"#\" class=\"confirm-delete\" data-name=\"".$resource->livelihood_program_resource_id."\" data-id=".$resource->livelihood_program_resource_id."><i class=\"icon-trash\"></i></a>
                    <a class=\"confirm-edit\" align=\"center\" ><i class=\"icon-search\"></i></a>
                    </td></tr>";
        } ?>  
        </table>
    </div>
</div>


</div>


<div id="deploymentPanel" style="display:none;">

<div class = "well well-small span9">
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
                <a class=\"confirm-edit\" align=\"center\" href=http://localhost/icdrris/Livelihood/viewLivelihoodOrganization/id/".$request->livelihood_organization_id."><i class=\"icon-search\"></i></a>
                <a href=\"#\" class=\"confirm-delete\" data-name=\"".$request->request_description."\" data-id=".$request->livelihood_organization_program_request_id.">
                <i class=\"icon-trash\"></i></a>
                <a href=\"#\" class=\"approveProgramRequest\" data-name=\"".$request->livelihood_organization_name."\" data-program =\"".$livelihood_program->livelihood_program_id."\" data-organization=\"".$request->livelihood_organization_id."\" data-request=\"".$request->livelihood_organization_program_request_id."\">
                <i class=\"icon-share\"></i></a>
                </td></tr>";
    } ?>  
    </table>
</div>
</div>

<div class = "well well-small span9">
<div id="livelihoodOrganizationsList">
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
                <a class=\"confirm-edit\" align=\"center\" href=http://localhost/icdrris/Livelihood/viewLivelihoodOrganization/id/".$organization->livelihood_organization_id."><i class=\"icon-search\"></i></a>
                <a href=\"#\" class=\"deployLivelihoodProgram\" data-name=\"".$organization->livelihood_organization_name."\" data-program =\"".$livelihood_program->livelihood_program_id."\" data-organization=\"".$organization->livelihood_organization_id."\"><i class=\"icon-share\"></i></a>
                </td></tr>";
    } ?>  
    </table>
</div>
</div>

</div>

<div id="deploymentHistory" style="display:none;">
<div class = "well span9">
<div id="grantedLivelihoodOrganizations">
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
</div>

<br></br>

<div id="modalAddExternalOrg" class="modal hide fade">
    <div class="modal-body">
    </div>
    <div class="modal-footer">
        <a class="btn danger btnSubmit" id="btnSubmit" >Submit</a>
        <a href="javascript:$('#modalAddExternalOrg').modal('hide')" class="btn secondary">Cancel</a>
    </div>
</div>

<div id="modalChooseFromExistingOrg" class="modal hide fade">
    <div id="externalOrgsBoxes" class="modal-body">
        <h5>Existing External Organizations<h5>
        <?php
            foreach($external_organizations as $organization){
                echo "<label class='checkbox'><input type='checkbox' data-id=".$organization->external_organization_id.">".$organization->agency_name."</input></label>"; 
            } ?>

        
    </div>
    <div class="modal-footer">
        <a class="btn danger btnSubmit" id="btnConfirmSelected" >Confirm Selection</a>
        <a href="javascript:$('#modalChooseFromExistingOrg').modal('hide')" class="btn secondary">Cancel</a>
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