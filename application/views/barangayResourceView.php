    </div>
</div>
 <div class="well span3">
 <h3>Barangay Profile</h3> 
        Location Address: <?php echo $barangay->location_address; ?><br>Location Type: &nbsp;&nbsp;<?php echo $barangay->location_type; ?>
        <br>
</div>
 <div class="well well-small span 3">
<h7>Add Resource</h7>
 <label for="target_recipients">Resources : </label><div class="span2"></div>
        <select name='resource_id' id='resource_id'>
            <option value="">   </option>
            <option value="1">Physical Resource</option>
            <option value="2">Natural Resource</option>
            <option value="3">Human Resource</option>
            <option value="4">Social Resource</option>
            <option value="5">Financial Resource</option>
        </select>
        <label for="target_recipients">Resource Description : </label><div class="span2"></div>
        <input type="text" name="resource_description" id="barangay_resource_description"/><span id="resource_quantity" class="verify"></span>
         <label for="target_recipients">Quantity : </label><div class="span2"></div>
        <input type="text" name="resource_quantity" id="barangay_resource_quantity"/><span id="resource_quantity" class="verify"></span>
        <br><div id="btnSubmitNewBarangayResource" name="btnSubmitNewBarangayResource" data-id="<?php echo $barangay->location_id;?>" class="btn btn-primary btnSubmitNewBarangayResource">Submit</div>
</div>

<div id="barangayResourcesTable" class = "well well-small span7">

<div class = "well well-small span6">
<div id="physicalResourceList">
    <h6>Physical Resources</h6>
    <table id="physicalResources" class="table table-striped" >
    <tr><th>Resource Description</th><th>Resource Quantity</th><th>Actions</th></tr>
    <?php foreach ($physicalResources as $physical) {
                echo "<tr>
                <td>".$physical->location_resource_description."</td>
                <td>".$physical->location_resource_quantity."</td>
                <td>
                <a href=\"#\" class=\"confirm-delete\" data-name=\"".$physical->location_resource."\" data-id=".$physical->location_resource.">
                <i class=\"icon-trash\"></i></a>
                </td></tr>";
    } ?>  
    </table>
</div>
</div>

<div class = "well well-small span6">
<div id="naturalResourceList">
    <h6>Natural Resources</h6>
    <table id="naturalResources" class="table table-striped" >
    <tr><th>Resource Description</th><th>Resource Quantity</th><th>Actions</th></tr>
    <?php foreach ($naturalResources as $natural) {
                echo "<tr>
                <td>".$natural->location_resource_description."</td>
                <td>".$natural->location_resource_quantity."</td>
                <td>
                <a href=\"#\" class=\"confirm-delete\" data-name=\"".$natural->location_resource."\" data-id=".$natural->location_resource.">
                <i class=\"icon-trash\"></i></a>
                </td></tr>";
    } ?>  
    </table>
</div>
</div>

<div class = "well well-small span6">
<div id="humanResourceList">
    <h6>Human Resources</h6>
    <table id="humanResources" class="table table-striped" >
    <tr><th>Resource Description</th><th>Resource Quantity</th><th>Actions</th></tr>
    <?php foreach ($humanResources as $human) {
                echo "<tr>
                <td>".$human->location_resource_description."</td>
                <td>".$human->location_resource_quantity."</td>
                <td>
                <a href=\"#\" class=\"confirm-delete\" data-name=\"".$human->location_resource."\" data-id=".$human->location_resource.">
                <i class=\"icon-trash\"></i></a>
                </td></tr>";
    } ?>  
    </table>
</div>
</div>

<div class = "well well-small span6">
<div id="socialResourceList">
    <h6>Social Resources</h6>
    <table id="socialResources" class="table table-striped" >
    <tr><th>Resource Description</th><th>Resource Quantity</th><th>Actions</th></tr>
    <?php foreach ($socialResources as $social) {
                echo "<tr>
                <td>".$social->location_resource_description."</td>
                <td>".$social->location_resource_quantity."</td>
                <td>
                <a href=\"#\" class=\"confirm-delete\" data-name=\"".$social->location_resource."\" data-id=".$social->location_resource.">
                <i class=\"icon-trash\"></i></a>
                </td></tr>";
    } ?>  
    </table>
</div>
</div>

<div class = "well well-small span6">
<div id="financialResourceList">
    <h6>Financial Resources</h6>
    <table id="financialResources" class="table table-striped" >
    <tr><th>Resource Description</th><th>Resource Quantity</th><th>Actions</th></tr>
    <?php foreach ($financialResources as $financial) {
                echo "<tr>
                <td>".$financial->location_resource_description."</td>
                <td>".$financial->location_resource_quantity."</td>
                <td>
                <a href=\"#\" class=\"confirm-delete\" data-name=\"".$financial->location_resource."\" data-id=".$financial->location_resource.">
                <i class=\"icon-trash\"></i></a>
                </td></tr>";
    } ?>  
    </table>
</div>
</div>

</div>

<!--

-->