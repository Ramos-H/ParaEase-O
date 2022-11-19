<!DOCTYPE html>
<html>
<head>
<title>Change Credentials</title>
</head>
<body>

<h2>Current credentials</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Old Username: <input type="text" name="oldName">
  
  <br><br>
  Old Password: <input type="text" name="oldPass">
  
  <br><br>
  New Username: <input type="text" name="newName">
  
  <br><br>
  New Password: <input type="text" name="newPass">
  
  <br><br>
  Confirm Password: <input type="text" name="newPassTwo">
  
  <br><br>

  <input type="submit" name="submit" value="Submit">  

</form>


<?php
$errors = array('oldNameErr' => '', 'oldPassErr' => '', 'newNameErr' => '' , 'newPassErr' => '' , 'confirm' => '');

if(isset($_POST['submit'])){  // when user submit POST request

    $errors = errCheck();
    if(!empty($errors['oldNameErr'])) {phpAlert($errors['oldNameErr']);}; // check if errors exist
    if(!empty($errors['oldPassErr'])) {phpAlert($errors['oldPassErr']);};
    if(!empty($errors['newNameErr'])) {phpAlert($errors['newNameErr']);};
    if(!empty($errors['newPassErr'])) {phpAlert($errors['newPassErr']);};
    if(!empty($errors['confirm'])) {phpAlert($errors['confirm']);};
}

function errCheck() {               // validate user input. Throw errors into errors array
    //Define the array of error within this function 
    $errors = array('oldNameErr' => '', 'oldPassErr' => '', 'newNameErr' => '' , 'newPassErr' => '' , 'confirm' => ''); // array containing errors

    if(empty($_POST['oldName'])) {
        $errors['oldNameErr'] = 'Username cannot be empty'; // old name req *
    }

    if(empty($_POST['oldPass'])) {
        $errors['oldPassErr'] = 'Password cannot be empty'; // old pass req *
    }

    if(strlen($_POST['newName']) > 30) {
        $errors['oldPassErr'] = 'Error! Username too long'; // more than 30 chars not allowed *
    }

    if(strlen($_POST['newPass']) < 8) { 
        $errors['newPassErr'] = 'Error! Password too long'; // min 8 chars allowed *
    }
    
    if(empty($_POST['newName']) && !empty($_POST['newPass'])) {
        $errors['newPassErr'] = 'New Username is required before entering a new password'; //  cannot enter new password if new username is empty
    }

    if(!empty($_POST['newPass']) && empty($_POST['newPassTwo'])) {
        $errors['confirm'] = 'Confirm cannot be empty'; //  confirm pass req if new pass is existing *
    }

    if ($_POST["newPass"] !== $_POST["newPassTwo"]) { 
        $errors['confirm'] = 'New Password and Confirm does not match'; // new password and confirm match *
    }
    //Return the errors
    return $errors;
}

function phpAlert($msg){    // in case errors exist
    echo $msg;
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
};
?>
</body>