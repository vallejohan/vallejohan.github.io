<?php
if(isset($_POST['email'])){
    
    // Here is the email to information
    $email_to = "cnsofficial14@gmail.com";
    $email_subject = "This is from your Website contact form";
    $email_from = "CnS official";
    
    //error code
    
    function died($error) {
        echo "We are sorry, but there were error(s) found with the form you submitted.";
        echo "These errors appear below.<br/><br/>";
        echo $error. "<br/><br/>";
        echo "Please go back and fix these errors.<br/>";
        die();
    }
    
    //validation
    
        if (!isset($_POST['name']) || 
            !isset($_POST['email']) || 
            !isset($_POST['comments'])){
            died('We are sorry but there appears to be a problem with the form you submitted.'); 
        }
            
            $name = $_POST['name'];
            $email = $_POST['email'];
            $comments = $_POST['comments'];
            
            $error_message = "";
            $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
            if(!preg_match($email_exp, $email)){
            $error_message .= 'The Email adress you entered does not appear to be valid<br/>';
        }
            $string_exp = "/^[A-Za-z.'-]+$/";
            if (!preg_match($string_exp, $name)){
            $error_message .= 'The Name you entered does not appear to be valid<br/>';
        }
            if(strlen($comments)  < 2){
            $error_message .= 'The Comments you entered do not appear to be valid.<br/>';
        }
            if(strlen($error_message) > 0) {
            died($error_message);
        }
            $email_message = "Form Details below. \n\n";
            
            function clean_string($string) {
            $bad = array("content-type", "bcc:". "to:", "cc:", "href");
            return str_replace($bad, "", $string);
        }
            $email_message .= "Name:" . clean_string($name) . "\n";
            $email_message .= "Email:" . clean_string($email) . "\n";
            $email_message .= "Comments:" . clean_string($comments) . "\n";
            
            
            // create email headers
            $headers = 'From: ' .$email_From . "\r\n". 'Reply-To:' . $email. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            @mail($email_to, $email_subject, $email_message, $headers);
?>
<!-- success message goes here -->
Thank you for contacting us. We will be in touch with you as soon as possible. <br/>
Please click<a href="index.html"> here</a> to go back to the form.
<?php
    }
?>