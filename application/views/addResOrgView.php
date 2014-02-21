    </div>
</div>

<div id="container">
<?php $attributes = array('class' => 'form-horizontal well span9 offset3', 'method'=>'post');

      echo form_open("ResponseOrg/addResOrg",$attributes); ?>
      
      <?php echo validation_errors('<p class="error">'); ?>
      <h1 class="text-center">Register Response Organization</h1>
        <label for="name">Response Organization Name: </label><input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>"/><div id="name_verify" class="verify"></div>
        <label for="phone_num">Phone Number: </label><input type="text" name="phone_num" id="phone_num" value="<?php echo set_value('phone_num'); ?>"/><span id="address_verify" class="verify"></span>
        <label for="email">Email: </label><input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>"/><span id="members_verify" class="verify"></span>
        <label for="address">Address: </label><input type="text" name="address" id="address" value="<?php echo set_value('address'); ?>"/><span id="income_verify" class="verify"></span>
        <label for="contact_person">Contact Person: </label><input type="text" name="contact_person" id="contact_person" value="<?php echo set_value('contact_person'); ?>"/><span id="status_verify" class="verify"></span>
        <label for="members_count">Members Count: </label><input type="text" name="members_count" id="members_count" value="<?php echo set_value('members_count'); ?>"/><span id="date_verify" class="verify"></span>
        <label for="members_available">Members Available: </label><input type="text" name="members_available" id="members_available" value="<?php echo set_value('members_available'); ?>"/><span id="business_type_verify" class="verify"></span>
        <br><br>
        <input class="btn btn-small btn-primary offset3" type="submit" value="Register Now" align="center"/></div>
<?php echo form_close()?>
</div>