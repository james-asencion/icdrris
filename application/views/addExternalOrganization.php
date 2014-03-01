    </div>
</div>
<div id="container">
<?php $attributes = array('class' => 'form-horizontal well span9 offset3', 'method'=>'post');

      echo form_open("Livelihood/addExternalOrganization",$attributes); ?>
      
      <?php echo validation_errors('<p class="error">'); ?>
      <h1 class="text-center">Register External Organization</h1>
        <label for="agency_name"><div class="span2"></div>Agency Name: </label><div class="span2"></div><input type="text" name="agency_name" id="agency_name" value="<?php echo set_value('agency_name'); ?>"/><div id="agency_name_verify" class="verify"></div>
        <label for="agency_address"><div class="span2"></div>Agency Address: </label><div class="span2"></div><input type="text" name="agency_address" id="agency_address" value="<?php echo set_value('agency_address'); ?>"/><span id="agency_address_verify" class="verify"></span>
        <label for="contact_number"><div class="span2"></div>Contact Details(Contact Number): </label><div class="span2"></div><input type="text" name="contact_number" id="contact_number" value="<?php echo set_value('contact_number'); ?>"/><span id="contact_number_verify" class="verify"></span> 
        <br><br>
        
        <input class="btn btn-small btn-primary offset3" type="submit" value="Register Now" align="center"/></div>
<?php echo form_close()?>
</div>
