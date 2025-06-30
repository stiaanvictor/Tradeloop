<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Signup</title>
    <link rel="stylesheet" href="assets/css/login_signup_styles.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="?action=signup" method="post" autocomplete="off">
                <h1>Create Account</h1>
                <input type="text" placeholder="Name" name="username"/>
                <input type="email" placeholder="Email" name="email"/>
                <input type="password" placeholder="Password" name="password"/>
                <select name="province" id="province_select">
                    <option value="Eastern Cape">Eastern Cape</option>
                    <option value="Free State">Free State</option>
                    <option value="Gauteng">Gauteng</option>
                    <option value="KwaZulu-Natal">KwaZulu-Natal</option>
                    <option value="Limpopo">Limpopo</option>
                    <option value="Mpumalanga">Mpumalanga</option>
                    <option value="Northern Cape">Northern Cape</option>
                    <option value="North West">North West</option>
                    <option value="Western Cape">Western Cape</option>
                </select>
                <button>Sign Up</button>
                <?php if (!empty($error)): ?>
                <p style="color: red;"><?php echo $error ?></p>
                <?php endif; ?>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="?action=login" method="post" autocomplete="off">
                <h1>Sign in</h1>
                <input type="email" placeholder="Email" name="email"/>
                <input type="password" placeholder="Password" name="password"/>
                <button>Sign In</button>
                <?php if (!empty($error)): ?>
                <p style="color: red;"><?php echo $error ?></p>
                <?php endif; ?>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Already Have An Account?</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Don't Have An Account?</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="assets/js/login_signup.js"></script>
