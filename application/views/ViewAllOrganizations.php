    </div>
</div>
<div id="container">
<div></div>
<br></br>

<div class = "well offset3 span12">
<div id="membersTable">
    <h4>Livelihood Organizations</h4>;
    <table class="table table-striped">
    <tr><th>Organization Name</th><th>Address</th><th>No of members</th><th>Initial Income</th><th>Status</th><th>Age</th><th>Date Established</th><th>Business Activity Type</th><th>Actions</th></tr>
    <?php foreach ($organizations as $organization) {
                echo "<tr><td>".$organization->livelihood_organization_name."</td><td>".$organization->livelihood_organization_address."</td><td>".$organization->no_of_members."</td><td>".$member->sex."</td><td>".$organization->initial_income."</td><td>".$member->age."</td><td>".$organization->livelihood_organization_status."</td><td>".$organization->date_established."</td><td>".$organization->business_activity_type."</td><td><a align=\"center\" href=localhost/icdrris/Livelihood/deleteMember?id=".$member->member_id."</a></td></tr>";
    } ?>  
    </table>;
</div>
</div>



<!--

-->