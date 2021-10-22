<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap-5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
      <form action="auth/login.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="txt" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">LOGIN</button>
      </form>
    </div>

    <script src="bootstrap-5.1.1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>