<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <title>Register</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Register</h2>
        <form action="register_process.php" method="post">
            <div class="mb-3">
                <label for="registerEmail" class="form-label">Email</label>
                <input type="text" class="form-control" id="registerEmail" name="registerEmail" required>
            </div>
            <div class="mb-3">
                <label for="registerPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="registerPassword" name="registerPassword" required>
            </div>
            <button type="submit" class="btn btn-success">Register</button>
        </form>
        <p class="mt-3">Already have an account? <a href="login.php">Login here</a>.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
