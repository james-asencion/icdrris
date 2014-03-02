    </div>
</div>
<div id="container" class="form-horizontal well span8 offset2">
<?php $attributes = array('method'=>'post');

      echo form_open("Livelihood/addLivelihoodProgram",$attributes); ?>
      
      <?php echo validation_errors('<p class="error">'); ?>
      <h1 class="text-center">Register Livelihood Program</h1>
      <div class = "control-group offset1"><label class = "control-label" for="livelihood_type">Livelihood Type:</label><div class = "controls"><input type="text" name="livelihood_type" id="livelihood_type" value="<?php echo set_value('livelihood_type'); ?>"/></div></div>
      <div class = "control-group offset1"><label class = "control-label" for="livelihood_description">Livelihood Description:</label><div class="controls"><input type="text" name="livelihood_description" id="address" value="<?php echo set_value('livelihood_description'); ?>"/></div></div>
      <div class = "control-group offset1"><label class = "control-label" for="livelihood_program_cost">Livelihood Program Cost:</label><div class="controls"><input type="text" name="livelihood_program_cost" id="livelihod_program_cost" value="<?php echo set_value('livelihod_program_cost'); ?>"/></div></div>
      <div class = "control-group offset1"><label class = "control-label" for="target_recipients">Target Recipients :</label><div class="controls"><input type="text" name="target_recipients" id="target_recipients" value="<?php echo set_value('target_recipients'); ?>"/></div></div>
       <div align = "center">
        <input class="btn btn-small btn-primary" type="submit" value="Register Now"/></div>
        
<?php echo form_close()?>

<div>
    
</div>
</div>
