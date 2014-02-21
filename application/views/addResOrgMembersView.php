    </div>
</div>
<div id="container">
 <div class="well offset4 span 12">
 <h3>Response Organization</h3> 
	Name: <?php echo $response_organization_name; ?><br>
    Phone Number: <?php echo $response_organization_phone_num; ?><br>
    Email: <?php echo $response_organization_email; ?><br>
    Address: <?php echo $response_organization_address;?><br>
    Contact Person: <?php echo $response_organization_contact_person; ?><br>
    Members Count: <?php echo $response_organization_members_count; ?><br>
    Members Available: <?php echo $response_organization_members_available; ?>
        <br><br>
</div>

<div class = "well span12">
<form id="addMemberForm">
	<h4 class="text-center">Register Members</h4>
        <input type="hidden" name="ro_org_id" id="ro_org_id"  value="<?php echo $org_id; ?>" />
        <div class="row"><div class="span3"><label for="name">First Name: </label></div><div class="span9"><input type="text" name="ro_first_name" id="ro_first_name"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Last Name: </label></div><div class="span9"><input type="text" name="ro_last_name" id="ro_last_name"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Sex: </label></div><div class="span9"><input type="text" name="ro_sex" id="ro_sex"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Birthday: </label></div><div class="span9"><input type="date" name="ro_birthday" id="ro_birthday"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Civil Status: </label></div><div class="span9"><input type="text" name="ro_civil_status" id="ro_civil_status"  /></div></div>
        
        
        
</form><center>
<div class="btn btn-small btn-primary" id="addMemberButton1" align="center">Add Member</div></center>
</div>
<div></div>
<br></br>

<div class = "well span12">
<div id="membersTable">

</div>
</div>



<!--

-->