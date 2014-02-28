    </div>
</div>
<div></div>
<br></br>
<div id="membersTable" class="container" >
    <h4>External Organizations</h4>
    <table class="table table-striped">
    <tr><th>External Organization Name</th><th>External Organization Address</th><th>Contact Details</th><th>Actions</th></tr>
    <?php foreach ($external_organizations as $organization) {
                echo "<tr><td>".$organization->agency_name.
                "</td><td>".$organization->agency_address."</td>
                <td>".$organization->contact_number."</td>
                <td><a href=\"#\" class=\"confirm-delete\" data-name=\"".$organization->agency_name."\" data-id=".$organization->external_organization_id."><i class=\"icon-trash\"></i></a>
                <a href=\"#\" class=\"confirm-edit\" data-name=\"".$organization->agency_name."\" data-id=".$organization->external_organization_id."><i class=\"icon-edit\"></i></a></td>
                </tr>";
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