<?php 
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Login successful.";
        $_SESSION['username'] = $username;

        $row = mysqli_fetch_assoc($result);
        $_SESSION['profile'] = $row['profile'];

    } else {
        echo "Invalid username or password.";
    }

    mysqli_close($conn);
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Login and sign up page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- CDN for jQuery link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex my-2 my-lg-0">
                    <input class="form-control me-sm-2 spacing" type="text" placeholder="Search" />
                </form>

                <?php if (!isset($_SESSION['username'])) { ?>
    <!-- Login and Signup Buttons -->
    <button type="button" class="btn btn-primary spacing" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
    <button type="button" class="btn btn-secondary spacing fixed-size" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</button>
<?php } else { ?>
    <!-- Profile and Logout -->
    <div class="flex-shrink-0 dropdown">
        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="images/<?php echo $_SESSION['profile']; ?>" alt="Profile Image" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small shadow">
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
        </ul>
    </div>
<?php } ?>

                <!-- Login Modal -->
                <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title">Login</h1>
                            </div>
                            <div class="modal-body">
                                <div class="login-container">
                                    <form method='post' class="login-form" id="loginForm" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="input-container">
                                                <i class="fa-solid fa-user icon"></i>
                                                <input type="text" id="username" name="username"
                                                    placeholder="Enter your username" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-container">
                                                <i class="fa-solid fa-lock icon"></i>
                                                <input type="password" id="password" name="password"
                                                    placeholder="Enter your password" required>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck">
                                            <label class="form-check-label" for="gridCheck"> Remember me </label>
                                            <a href="#" class="forgot-password">Forgot Password?</a>
                                        </div>
                                        <button class="button" type="submit">Login</button>
                                        <div class="form-group">
                                            <p>Do you have an account? <a href="#" style="text-decoration: none;">Sign
                                                    up</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sign Up Modal -->
                <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title">Sign Up</h1>
                            </div>
                            <div class="modal-body">
                                <div class="signup-container">
                                    <form class="signup-form" method = "POST" action = "signup_process.php" enctype="multipart/form-data">
                                    <div class="image-container">
                                                <!-- Image Preview with Upload Icon -->
                                                <label for="profileImage" class="image-label">
                                                    <img id="profilePreview" src="default-profile.png"
                                                        alt="Profile Image" class="circular-image">
                                                    <i class="fa-solid fa-camera upload-icon"></i>
                                                </label>
                                                <!-- Hidden File Input -->
                                                <input type="file" id="profileImage" name="profileImage"
                                                    accept="image/*" onchange="previewProfileImage(event)">
                                            </div>
                                        <div class="form-group">
                                            <div class="input-container">
                                                <i class="fa-solid fa-user icon"></i>
                                                <input type="text" id="newUsername" name="newUsername"
                                                    placeholder="Enter your username" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-container">
                                                <i class="fa-solid fa-lock icon"></i>
                                                <input type="password" id="newPassword" name="newPassword"
                                                    placeholder="Enter your password" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-container">
                                                <i class="fa-solid fa-lock icon"></i>
                                                <input type="password" id="confirmPassword" name="confirmPassword"
                                                    placeholder="Confirm your password" required>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck" name="gridCheck">
                                            <label class="form-check-label" for="gridCheck">
                                                I agree to the <a href="#" class="terms"
                                                    style="text-decoration: none;">terms & conditions</a>
                                            </label>
                                            <button class="button" type="submit" style="width: 100%;">Sign Up</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        function previewProfileImage(event) {
            var preview = document.getElementById("profilePreview");
            var file = event.target.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
        /*
        document.addEventListener("DOMContentLoaded", function () {
            let profileImage = localStorage.getItem("userProfileImage"); // Retrieve from storage or backend

            if (profileImage) {
                document.getElementById("userProfileImage").src = profileImage; // Set profile image
            }
        });
*/
    </script>

</body> 

</html>