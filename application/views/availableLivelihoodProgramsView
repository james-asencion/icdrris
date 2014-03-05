    </div>
</div>
<div></div>
<br></br>
<div id="membersTable" class="container" >
    <h4>Livelihood Programs</h4>
    <table class="table table-striped">
    <tr><th>Livelihood Program Type</th><th>Livelihood Program Description</th><th>Livelihood Program Cost</th><th>Target Recipients</th><th>Livelihood Program Cost</th><th>External Organization Provider</th><th>Actions</th></tr>
    <?php foreach ($livelihood_programs as $livelihood_program) {
                echo "<tr><td>".$livelihood_program->livelihood_type.
                "</td><td>".$livelihood_program->livelihood_description."</td>
                <td>".$livelihood_program->livelihood_program_cost."</td>
                <td>".$livelihood_program->target_recipients."</td>
                <td>".$livelihood_program->livelihood_program_status."</td>
                <td></td>
                <td><a href=\"#\" class=\"confirm-delete\" data-name=\"".$livelihood_program->livelihood_description."\" data-id=".$livelihood_program->livelihood_program_id."><i class=\"icon-trash\"></i></a>
                <a class=\"confirm-edit\" align=\"center\" href=viewLivelihooodProgram/id/".$livelihood_program->livelihood_program_id."><i class=\"icon-search\"></i></a>
                <a class=\"confirm-deploy\" align=\"center\" data-id=".$livelihood_program->livelihood_program_id."><i class=\"icon-share\"></i></a>
                <a class=\"send-request\" align=\"center\" data-id=".$livelihood_program->livelihood_program_id." data-program=\"".$livelihood_program->livelihood_description."\" data-organization=\"37\"><i class=\"icon-share-alt\"></i></a>
                </td></tr>";
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






<!--

--> 