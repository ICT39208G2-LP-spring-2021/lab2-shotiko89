<!DOCTYPE html>
<html lang="ka">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>რეგისტრაცია</title>
</head>
<style>
  input {
    display: block;
  }

  input + input, 
  button {
    margin: 20px 0 0;
  }
</style>

<body>
<h1>რეგისტრაცია</h1>
    <?php if (!isset($submissionSuccess)) { ?>
        <form action="add-user.php" class="form" method="post">
                <input type="text" name="FirstName" placeholder="Name" value = "<?php echo (isset($FirstName)) ? $FirstName : ''; ?>">
                <?php if (isset($FirstNameError)) { ?>
                    <span class="error"><?php echo $FirstNameError ?></span>
                <?php } ?>
                <input type="text" name="LastName" placeholder="Surname" value = "<?php echo (isset($LastName)) ? $LastName : ''; ?>">
                <?php if (isset($LastNameError)) { ?>
                    <span class="error"><?php echo $LastNameError ?></span>
                <?php } ?>
                <input type="text" name="PersonalNumber" placeholder="Personal Number" value = "<?php echo (isset($PersonalNumber)) ? $PersonalNumber : ''; ?>">
                <?php if (isset($PersonalNumberError)) { ?>
                    <span class="error"><?php echo $PersonalNumberError ?></span>
                <?php } ?>
                <input type="text" name="Email" placeholder="Email" value = "<?php echo (isset($Email)) ? $Email : ''; ?>">
                <?php if (isset($EmailError)) { ?>
                    <span class="error"><?php echo $EmailError ?></span>
                <?php } ?>
        
                <input type="password" name="Password" placeholder="Password">
                <?php if (isset($PasswordError)) { ?>
                    <span class="error"><?php echo $PasswordError ?></span>
                <?php } ?>
      
                <input type="text" name="StatusId" placeholder="Status ID" value = "<?php echo (isset($StatusId)) ? $StatusId : ''; ?>">
                <?php if (isset($StatusIdError)) { ?>
                    <span class="error"><?php echo $StatusIdError ?></span>
                <?php } ?>
            <button type="submit">რეგისტრაცია</button>
        </form>
    <?php } else { ?>
        <a><b>მომხმარებელი დარეგისტრირდა</b></a>
    <?php } ?>
</body>
</html>