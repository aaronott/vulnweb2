<?php
// Include the database connection file
require_once "config.php";

// Define variables and initialize with empty values
$first_name = $last_name = $email = $address = $city = $state = $zip = "";
$first_name_err = $last_name_err = $email_err = $address_err = $city_err = $state_err = $zip_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate first name
    if(empty(trim($_POST["first_name"]))){
        $first_name_err = "Please enter your first name.";
    } else{
        $first_name = trim($_POST["first_name"]);
    }

    // Validate last name
    if(empty(trim($_POST["last_name"]))){
        $last_name_err = "Please enter your last name.";
    } else{
        $last_name = trim($_POST["last_name"]);
    }

    // Validate email address
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email address.";
    } else{
        // Prepare a select statement to check if email already exists
        $sql = "SELECT id FROM users WHERE email = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();

                if($stmt->num_rows == 1){
                    $email_err = "This email address is already registered.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validate address
    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter your home address.";
    } else{
        $address = trim($_POST["address"]);
    }

    // Validate city
    if(empty(trim($_POST["city"]))){
        $city_err = "Please enter your city.";
    } else{
        $city = trim($_POST["city"]);
    }

    // Validate state
    if(empty(trim($_POST["state"]))){
        $state_err = "Please enter your state.";
    } else{
        $state = trim($_POST["state"]);
    }

    // Validate zip code
    if(empty(trim($_POST["zip"]))){
        $zip_err = "Please enter your zip code.";
    } else{
        $zip = trim($_POST["zip"]);
    }
    
    // Validate role
    if(empty(trim($_POST["role"]))){
        $role_err = "Please enter your role.";
    } else{
        $role = trim($_POST["role"]);
    }

    // Check input errors before inserting in database
    if(empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($address_err) && empty($city_err) && empty($state_err) && empty($zip_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (first_name, last_name, email, address, city, state, zip, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssss", $param_first_name, $param_last_name, $param_email, $param_address, $param_city, $param_state, $param_zip, $param_role);
        }
        // Set parameters
        $param_first_name = $first_name;
        $param_last_name = $last_name;
        $param_email = $email;
        $param_address = $address;
        $param_city = $city;
        $param_state = $state;
        $param_zip = $zip;
        $param_role = $role;

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Redirect to login page
            header("location: login.php");
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Register</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
                <span class="help-block"><?php echo $first_name_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
                <span class="help-block"><?php echo $last_name_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                <label>Home Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                <span class="help-block"><?php echo $address_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                <label>City</label>
                <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
                <span class="help-block"><?php echo $city_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($state_err)) ? 'has-error' : ''; ?>">
                <label>State</label>
                <input type="text" name="state" class="form-control" value="<?php echo $state; ?>">
                <span class="help-block"><?php echo $state_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($zip_err)) ? 'has-error' : ''; ?>">
                <label>Zip Code</label>
                <input type="text" name="zip" class="form-control" value="<?php echo $zip; ?>">
                <span class="help-block"><?php echo $zip_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($role_err)) ? 'has-error' : ''; ?>">
                <label>Role</label>
                <input type="text" name="role" class="form-control" value="<?php echo $role; ?>">
                <select name="role" class="form-control">
                    <option>Select one</option>
                    <option value="waterer">Plant Waterer</option>
                    <option value="owner">Plant Owner</option>
                </select>
                <span class="help-block"><?php echo $role_err; ?></span>
            </div> 
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>

