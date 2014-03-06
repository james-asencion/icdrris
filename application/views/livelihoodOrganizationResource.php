    </div>
</div>
 <div class="well span 6">
 <h3>Livelihood Program</h3> 
        Livelihood Program Type: <?php echo $program->livelihood_type; ?><br>Description: &nbsp;&nbsp;<?php echo $program->livelihood_description; ?>
        <br>Cost: &nbsp;&nbsp;<?php echo $program->livelihood_program_cost; ?>&nbsp;&nbsp;&nbsp;&nbsp;<br>Target Recipients: &nbsp;&nbsp;<?php echo $program->target_recipients;?>
        <br>Livelihood Program Status: &nbsp;&nbsp;<?php echo $program->livelihood_program_status; ?>
        <br><br>
<a class="confirm-deploy btn btn-success" align="center" data-id="<?php echo $program->livelihood_program_id; ?>"><i class="icon-share"></i>deploy</a><br>
<a class="confirm-deploy btn btn-default" align="center" data-id="<?php echo $program->livelihood_program_id; ?>"><i class="icon-search"></i>show resources</a>
<h5>External Organization Provider/s: </h5><br>
<button class="btn btn-small showExternalOrganizationsList">show/hide external orgnizations</button>
<div id="externalOrganizationsList" style="display:none;">
<div style="float: left; margin-bottom: 10px">
                <a data-id="<?php echo $program->livelihood_program_id;?>" class="addExternalOrg"><i class="icon-plus"></i>Add New</a><br>
                <a data-id="<?php echo $program->livelihood_program_id;?>" class="chooseFromExistingOrg"><i class="icon-list"></i>Choose From Existing</a>
</div><br><br>
<div class="well well-small span 2">
        <?php foreach($external_organizations as $organization){ ?>
        <?php echo $organization->agency_name; ?>
        <br>
        <?php }?>

</div>
</div>
<div id="externalOrganizationsTable">
        
</div>
</div>
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
        <br><div id="btnSubmitNewResource" name="btnSubmitNewResource" data-id="<?php echo $program->livelihood_program_id;?>" class="btn btn-primary submitLivelihoodResource">Submit</div>
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
                    <a class=\"confirm-edit\" align=\"center\" href=viewLivelihooodProgram/id/".$resource->livelihood_program_resource_id."><i class=\"icon-search\"></i></a>
                    </td></tr>";
        } ?>  
        </table>
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



<!--

-->