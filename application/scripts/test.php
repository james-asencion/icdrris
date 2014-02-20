<?php
    /*
    Script for update record from X-editable.
    */

    //delay (for debug only)
    //sleep(1); 

    /*
    You will get 'pk', 'name' and 'value' in $_POST array.
    */
    //$pk = $_POST['pk'];
    //$name = $_POST['name'];
    //$value = $_POST['value'];

    /*
     Check submitted value
    */

        /* 
        In case of incorrect value or error you should return HTTP status != 200. 
        Response body will be shown as error message in editable form.
        */

        //print_r($_POST);
        //header('HTTP 400 Bad Request', true, 400);
        header('HTTP 400 Bad Request', true, 400);
        echo "This field is required!";
        //echo "{\"errors\": {\"username\": \"username already exist\"} }";
        //$responseData = json_encode("{success:false, message:'server error'}");
        //echo $responseData;

?>