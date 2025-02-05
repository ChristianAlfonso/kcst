
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="login-page p-3 vh-100 d-flex justify-content-center align-items-center">
        <div class="login-form shadow bg-light rounded-3 p-4">
            <div class="login-header">
                <div class="login-title h2 d-flex justify-content-center align-items-center">
                    <img src="./asset/img/kcst1.png" alt="" class="img-fluid">
                    Welcome to KCST
                </div>
                <div class="login-label text-center label-group">A good education is a foundation for a better future</div>
            </div>
            <div class="login-body p-2">
                <form action="#">
                    <div class="form-group mt-3">
                        <label for="username">Username:</label>
                        <input type="text" name="username" class="form-control">
                    </div>

                    <div class="form-group mt-3">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control">
                        
                    </div>
                    <div class="form-group mt-3">
                        <input type="checkbox" id="show-password"> Show Password
                    </div>

                    <div class="form-group text-center">
                    
                        <input type="submit" id="login-btn" value="Login" class="btn form-control mt-3 text-white" style="background-color: #808131;">

                        <a href="#" class="label-group">Forgot your password?</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        document.getElementById('show-password').addEventListener('change', function() {
            var passwordInput = document.getElementById('password');
            if (this.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
</body>
</html>