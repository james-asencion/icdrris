    </div>
</div>
<div id="container" class="form-horizontal well span9 offset3">
<?php $attributes = array('method'=>'post');

      echo form_open("Livelihood/addLivelihoodProgram",$attributes); ?>
      
      <?php echo validation_errors('<p class="error">'); ?>
      <h1 class="text-center">Register Livelihood Program</h1>
        <label for="livelihood_type"><div class="span2"></div>Livelihood Type: </label><div class="span2"></div><input type="text" name="livelihood_type" id="livelihood_type" value="<?php echo set_value('livelihood_type'); ?>"/><div id="name_verify" class="verify"></div>
        <label for="livelihood_description"><div class="span2"></div>Livelihood Description: </label><div class="span2"></div><input type="text" name="livelihood_description" id="address" value="<?php echo set_value('livelihood_description'); ?>"/><span id="address_verify" class="verify"></span>
        <label for="livelihood_program_cost"><div class="span2"></div>Livelihood Program Cost: </label><div class="span2"></div><input type="text" name="livelihood_program_cost" id="livelihod_program_cost" value="<?php echo set_value('livelihod_program_cost'); ?>"/><span id="members_verify" class="verify"></span>
        <label for="target_recipients"><div class="span2"></div>Target Recipients : </label><div class="span2"></div><input type="text" name="target_recipients" id="target_recipients" value="<?php echo set_value('target_recipients'); ?>"/><span id="income_verify" class="verify"></span>
       <br><br>
        <input class="btn btn-small btn-primary offset3" type="submit" value="Register Now" align="center"/>
        <br><br>
        
<?php echo form_close()?>

<div>
    
</div>
</div>
