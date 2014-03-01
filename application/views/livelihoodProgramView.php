    </div>
</div>
 <div class="well offset5 span 6">
 <h3>Livelihood Program</h3> 
	 &nbsp;&nbsp; 
        Livelihood Program Type: <?php echo $livelihood_program->livelihood_type; ?><br>Description: &nbsp;&nbsp;<?php echo $livelihood_program->livelihood_description; ?>
        <br>Cost: &nbsp;&nbsp;<?php echo $livelihood_program->livelihood_program_cost; ?>&nbsp;&nbsp;&nbsp;&nbsp;<br>Target Recipients: &nbsp;&nbsp;<?php echo $livelihood_program->target_recipients;?>
        <br>Livelihood Program Status: &nbsp;&nbsp;<?php echo $livelihood_program->livelihood_program_status; ?>
        
<h5>External Organization Provider/s: </h5>
        <?php foreach($external_organizations as $organization){ ?>
        <?php echo $organization->agency_name; ?>
        <br>
        <?php }?>

</div>

<div></div>
<br></br>
<div class = "well offset1 span11">
<div id="membersTable">
    <h5>Approved Livelihood Program Requests</h5>


    <table id="members" class="table table-striped">
    <tr><th>Livelihood Organization Name</th><th>Business Activity Type</th><th>Request Status</th><th>Request Description</th><th>Date Requested</th><th>Date Granted</th><th>Actions</th></tr>
    <?php foreach ($approved_requests as $request) {
                echo "<tr>
                <td>".$request->livelihood_organization_name."</td>
                <td>".$request->business_activity_type."</td>
                <td>".$request->request_status."</td>
                <td>".$request->request_description."</td>
                <td>".$request->date_requested."</td>
                <td>".$request->date_granted."</td>
                <td>
                <a href=\"#\" class=\"confirm-delete\" data-name=\"".$request->request_description."\" data-id=".$request->livelihood_organization_program_request_id.">
                <i class=\"icon-trash\"></i></a>
                </td></tr>";
    } ?>  
    </table>
</div>

<div class = "well offset1 span11">
<div id="membersTable">
    <h5>Pending Livelihood Program Requests</h5>


    <table id="members" class="table table-striped">
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
                </td></tr>";
    } ?>  
    </table>
</div>
</div>
<div id="modal-delete" class="modal hide fade">
    <div class="modal-body">
        <p>Are you sure want to delete this organization?</p>
    </div>
    <div class="modal-footer">
        <a href="deleteLivelihoodOrg?id=" class="btn danger">Yes</a>
        <a href="javascript:$('modal-delete').modal('hide')" class="btn secondary">No</a>
    </div>
</div>



<!--

-->