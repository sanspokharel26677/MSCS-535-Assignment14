<?php
/*
  File: login.php
  Purpose: Handles user login logic securely
  Features:
    - Connects to MySQL using PDO
    - Prevents SQL injection using prepared statements
    - Verifies hashed passwords securely
    - Sanitizes input to avoid XSS and other injection attacks
    - Uses error logging instead of exposing raw messages
*/

// STEP 1: Define database connection variables
$host = "localhost";
$dbname = "secure_login_db";
$dbuser = "root"; // use your DB user
$dbpass = "sandesh";     // use your DB password

try {
    // STEP 2: Create a secure PDO connection to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // STEP 3: Check that the form was submitted via POST
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // STEP 4: Sanitize and trim user inputs to avoid XSS and injection
        $username = htmlspecialchars(trim($_POST['username']));
        $password = htmlspecialchars(trim($_POST['password'])); // although password is hashed, good to sanitize

        // STEP 5: Reject empty input (redundant if JS already validates, but still important here)
        if (empty($username) || empty($password)) {
            die("Invalid input. Username or password cannot be empty.");
        }

        // STEP 6: Prepare and execute secure SQL query using placeholders
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        // STEP 7: Fetch the user record as associative array
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // STEP 8: Verify password using password_verify()
        if ($user && password_verify($password, $user['password'])) {
            // STEP 9: Successful login – output sanitized username
            echo "<div style='text-align:center;margin-top:50px'>
                    <h2>Login successful. Welcome, " . htmlspecialchars($user['username']) . "!</h2>
                  </div>";
        } else {
            // STEP 10: Invalid credentials
            echo "<div style='text-align:center;margin-top:50px'>
                    <h2>Invalid username or password.</h2>
                  </div>";
        }
    }
} catch (PDOException $e) {
    // STEP 11: Log DB errors privately, don't expose them to the user
    error_log("Database error: " . $e->getMessage());
    echo "<div style='text-align:center;margin-top:50px'>
            <h2>An error occurred. Please try again later.</h2>
          </div>";
}
?>