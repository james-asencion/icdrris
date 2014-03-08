    </div>
</div>
<div id="container">
<?php $attributes = array('class' => 'form-horizontal well span10 offset1', 'method'=>'post');

      echo form_open("livelihood/addLivelihoodOrg",$attributes); ?>
      
      <?php echo validation_errors('<p class="error">'); ?>
      <h1 class="text-center">Register Livelihood Organization</h1>
        <div class = "control-group offset2"><label class = "control-label" for="name">Livelihood Organization Name:</label><div class = "controls"><input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>" required/></div></div>
        <div class = "control-group offset2"><label class = "control-label" for="address">Address:</label><div class = "controls"><input type="text" name="address" id="address" value="<?php echo set_value('address'); ?>" required/></div></div>
        <div class = "control-group offset2"><label class = "control-label" for="members">Number of members:</label><div class = "controls"><input type="number" min="0" name="members" id="members" value="<?php echo set_value('members'); ?>"/></div></div>
        <div class = "control-group offset2"><label class = "control-label" for="initial_income">Initial Income:</label><div class = "controls"><input type="number" min="0" name="initial_income" id="initial_income" /></div></div>
        <div class = "control-group offset2"><label class = "control-label" for="status">Status:</label><div class = "controls"><select name="status" id="status" value="<?php echo set_value('status'); ?>"><option value=""> -Select- </option><option value="active">Active</option><option value="inactive">Inactive</option></select></div></div>
        <div class = "control-group offset2"><label class = "control-label" for="date_formed">Date Formed:</label><div class = "controls"><input type="date" name="date_formed" id="date_formed" value="<?php echo date('Y-m-d'); ?>" required/></div></div>
        <div class = "control-group offset2"><label class = "control-label" for="business_type">Business Activity Type:</label><div class = "controls"><input type="text" name="business_type" id="business_type" value="<?php echo set_value('business_type'); ?>" required/></div></div>

        <div align = "center"><input class="btn btn-small btn-primary" type="submit" value="Register Now"/></div>
<?php echo form_close()?>
</div>
