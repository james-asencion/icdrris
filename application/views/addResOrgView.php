    </div>
</div>

<div id="container-fluid">
<?php $attributes = array('class' => 'form-horizontal well span10 offset1', 'method'=>'post');

      echo form_open("ResponseOrg/addResOrg",$attributes); ?>
      
      <?php echo validation_errors('<p class="error">'); ?>
      <h1 class="text-center">Register Response Organization</h1>
        <div class = "control-group offset2"><label class = "control-label" for="name">Response Organization Name: </label><div class = "controls"><input type="text" name="ro_name" id="ro_name" value="<?php echo set_value('ro_name'); ?>"/></div></div>
        <div class = "control-group offset2"><label class = "control-label" for="phone_num">Phone Number: </label><div class = "controls"><input type="text" name="ro_phone_num" id="ro_phone_num" value="<?php echo set_value('ro_phone_num'); ?>"/></div></div>
        <div class = "control-group offset2"><label class = "control-label" for="email">Email: </label><div class = "controls"><input type="text" name="ro_email" id="ro_email" value="<?php echo set_value('ro_email'); ?>"/></div></div>
        <div class = "control-group offset2"><label class = "control-label" for="address">Address: </label><div class = "controls"><input type="text" name="ro_address" id="ro_address" value="<?php echo set_value('ro_address'); ?>"/></div></div>
        <div class = "control-group offset2"><label class = "control-label" for="contact_person">Contact Person: </label><div class = "controls"><input type="text" name="ro_contact_person" id="ro_contact_person" value="<?php echo set_value('ro_contact_person'); ?>"/></div></div>
        <div class = "control-group offset2"><label class = "control-label" for="members_count">Members Count: </label><div class = "controls"><input type="text" name="ro_members_count" id="ro_members_count" value="<?php echo set_value('ro_members_count'); ?>"/></div></div>
        <div class = "control-group offset2"><label class = "control-label" for="members_available">Members Available: </label><div class = "controls"><input type="text" name="ro_members_available" id="ro_members_available" value="<?php echo set_value('ro_members_available'); ?>"/></div></div>  


          <div align = "center"><input class="btn btn-small btn-primary" type="submit" value="Register Now"/></div>
<?php echo form_close()?>
</div>