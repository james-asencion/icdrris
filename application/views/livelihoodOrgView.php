    </div>
</div>
<div class = "container-fluid">
<div class = "row-fluid">
<!--<div class = "row-fluid">-->
 <div class="well span3">
 <h3><?php echo $livelihood_org->livelihood_organization_name; ?></h3>
    <br>Address: <?php echo $livelihood_org->livelihood_organization_address; ?>
    <br>Members: <?php echo $livelihood_org->no_of_members; ?>
    <br>Initial Income: <?php echo $livelihood_org->initial_income;?>
    <br>Status: <?php echo $livelihood_org->livelihood_organization_status; ?>
    <br>Date Established: <?php echo $livelihood_org->date_established; ?>
    <br>Business Activity Type: <?php echo $livelihood_org->business_activity_type; ?>
    <br><br>
    <button class="btn btn-small btn-default showLivelihoodOrganizationMembers"><i class="icon-share"></i>View Members</button>
    <button class="btn btn-small btn-success sendLivelihoodProgramRequest"><i class="icon-share"></i>Send Request</button><br><br>
    <button class="btn btn-small btn-default showRequestHistory"><i class="icon-eye"></i>View Requests</button>
    <button class="btn btn-small btn-default showGrantsHistory"><i class="icon-eye"></i>View Grants</button>

</div>


<div id="livelihoodOrgMembersPanel">
<div class = "well offset1 span8">
    <h4>Livelihood Organization Members</h4>

            <div style="float: right; margin-bottom: 10px">
                <a class = "btn btn-primary addLivelihoodOrgMembers" data-toggle = "modal" data-org="<?php echo $livelihood_org->livelihood_organization_id; ?>">Add Members</a>
                <button class="btn edit"><i class="icon-pencil"></i>edit</button>
                <button class="btn btn-doneEdit btn-success btn-small hide">Done Editing</button> 
            </div>


    <div id="members">
    <table id="membersTable" class="table table-striped">
    <tr><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Sex</th><th>Birthday</th><th>Age</th><th>Monthly Income</th><th>Source of income</th><th>Civil Status</th><th>Number of Children</th><th>Actions</th></tr>
    <?php
        if(count($members)>0){
            foreach ($members as $member) {
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
            }
        } ?>  
    </table>
    </div>
</div>
</div>


<div id="availableProgramsPanel" style="display:none;">
<div class="well offset1 span8">
    <h4>Livelihood Programs</h4>
    <table class="table table-striped">
    <tr><th>Livelihood Program Type</th><th>Livelihood Program Description</th><th>Cost</th><th>Target Recipients</th><th>Status</th><th>Actions</th></tr>
    <?php 
        if(count($livelihood_programs)>0){
            foreach ($livelihood_programs as $livelihood_program) {
                echo "<tr><td>".$livelihood_program->livelihood_type.
                "</td><td>".$livelihood_program->livelihood_description."</td>
                <td>".$livelihood_program->livelihood_program_cost."</td>
                <td>".$livelihood_program->target_recipients."</td>
                <td>".$livelihood_program->livelihood_program_status."</td>
                <td><a class=\"btn btn-success send-request\" align=\"center\" data-id=".$livelihood_program->livelihood_program_id." data-program=\"".$livelihood_program->livelihood_description."\" data-organization=\"37\"><i class=\"icon-share-alt\"></i>request</a>
                </td></tr>";
            }
        } ?>  
    </table>
</div>
</div>

<div id="livelihoodOrganizationRequestsPanel" style="display:none;">
    <div class="well offset1 span8">
    <h4>Request History</h4>
        <table id="requestsHistoryTable" class="table table-striped">
        <tr><th>Request Status</th><th>Request Description</th><th>Date Requested</th><th>Date Granted</th><th>Livelihood Description</th><th>Livelihood Type</th><th>Actions</th></tr>
        <?php 
            if(count($requests)>0){
                foreach ($requests as $request) {
                    echo "<tr><td>".$request->request_status.
                    "</td><td>".$request->request_description."</td>
                    <td>".$request->date_requested."</td>
                    <td>".$request->date_granted."</td>
                    <td>".$request->livelihood_description."</td>
                    <td>".$request->livelihood_type."</td>
                    <td><a class=\"btn btn-danger cancel-request\" align=\"center\" data-id=".$request->livelihood_organization_program_request_id." data-org=".$org->livelihood_organization_id." data-program=\"".$request->livelihood_description."\"><i class=\"icon-trash\"></i>cancel</a>
                    </td></tr>";
                }
            } ?>  
        </table>
    </div>
</div>

<div id="livelihoodOrganizationGrantsPanel" style="display:none;">
    <div class="well offset1 span8">
    <h4>Grants History</h4>
        <table class="table table-striped">
        <tr><th>Livelihood Program Type</th><th>Livelihood Program Description</th><th>Cost</th><th>Date Granted</th>
        <?php if(count($grants)>0){
                foreach ($grants as $grant) {
                    echo "<tr><td>".$grant->livelihood_type.
                    "</td><td>".$grant->livelihood_description."</td>
                    <td>".$grant->livelihood_program_cost."</td>
                    <td>".$grant->date_granted."</td>
                    </tr>";
                }
            } ?>  
        </table>
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
<div id="modalChooseDeploymentType" class="modal hide">
    <div class="modal-body">
        <div name="message">
        </div>
    </div>
    <div class="modal-footer">
        <a href="Livelihood/deployLivelihoodProgramFromMap" data-dismiss="modal" id="btnChooseFromList" class="btn danger">Choose from List</a>
        <a href="Livelihood/deployLivelihoodProgramFromList" data-dismiss="modal" id="btnChooseFromMap" aria-hidden="true" class="btn secondary">Choose from Map</a>
    </div>
</div>
<div id="modalSendLivelihoodRequest" class="modal hide">
    <div class="modal-body">
        <div name="message">
        </div>
    </div>
    <div class="modal-footer">
        <a class="btn" id="confirmRequest">Send Request</a>
        <a href="javascript:$('#modalSendLivelihoodRequest').modal('hide')" class="btn secondary">Cancel</a>
    </div>
</div>
<div id="modalSendLivelihoodRequestSuccess" class="modal hide">
    <div class="modal-body">
        <div name="message">
            Request Successfully Sent
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:$('#modalSendLivelihoodRequestSuccess').modal('hide')" class="btn secondary">Okay</a>
    </div>
</div>
<div id="modalCancelLivelihoodRequest" class="modal hide">
    <div class="modal-body">
    </div>
    <div class="modal-footer">
        <a class="btn" id="cancelRequest">Yes</a>
        <a href="javascript:$('#modalCancelLivelihoodRequest').modal('hide')" class="btn secondary">No</a>
    </div>
</div>

<div id="cancelLivelihoodRequestSuccess" class="modal hide">
    <div class="modal-body">
        <div name="message">
            Request Successfully Cancelled
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:$('#cancelLivelihoodRequestSuccess').modal('hide')" class="btn secondary">Okay</a>
    </div>
</div>

<!--

-->