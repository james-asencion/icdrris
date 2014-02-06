    </div>
</div>
<div id="container">
 <div class="well offset5 span 6">
 <h3>Livelihood Organization</h3> 
	Name: &nbsp;&nbsp;<?php echo $livelihood_organization_name; ?><br>Address: &nbsp;&nbsp;<?php echo $livelihood_organization_address; ?>
        <br>Members: &nbsp;&nbsp;<?php echo $no_of_members; ?>&nbsp;&nbsp;&nbsp;&nbsp;<br>Initial Income: &nbsp;&nbsp;<?php echo $initial_income;?>
        <br>Status: &nbsp;&nbsp;<?php echo $livelihood_organization_status; ?>&nbsp;&nbsp;&nbsp;&nbsp;<br>Date Established: &nbsp;&nbsp;<?php echo $date_established; ?>
        <br>Business Activity Type: &nbsp;&nbsp;<?php echo $business_activity_type; ?>
        <br><br>
</div>

<div class = "well offset3 span12">
<form id="addMemberForm">
	<h4 class="text-center">Register Members</h4>
        <input type="hidden" name="org_id" id="org_id"  value="<?php echo $org_id; ?>" />
        <div class="row"><div class="span3"><label for="name">First Name: </label></div><div class="span9">
        <input type="text" name="first_name" id="first_name"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Last Name: </label></div><div class="span9"><input type="text" name="last_name" id="last_name"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Middle Name: </label></div><div class="span9"><input type="text" name="middle_name" id="middle_name"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Sex: </label></div><div class="span9"><input type="text" name="sex" id="sex"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Birthday: </label></div><div class="span9"><input type="date" name="birthday" id="birthday"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Age: </label></div><div class="span9"><input type="text" name="age" id="age"  /></div></div>
        <div class="row"><div class="span3"><label for="name">Monthly Income: </label></div><div class="span9"><input type="text" name="monthly_income" id="monthly_income" /></div></div>
        <div class="row"><div class="span3"><label for="name">Source of Income: </label></div><div class="span9"><input type="text" name="source_of_income" id="source_of_income" /></div></div>
        <div class="row"><div class="span3"><label for="name">Civil Status: </label></div><div class="span9"><input type="text" name="civil_status" id="civil_status"  /></div></div>
        
</form>
<div class="btn btn-small btn-primary" id="addMemberButton" align="center">Add Member</div>
</div>
<div></div>
<br></br>

<div class = "well offset3 span12">
<div id="membersTable">

</div>
</div>



<!--

-->