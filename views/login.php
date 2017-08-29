<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="./assets/css/login.css" rel="stylesheet">
</head>
<body>
    <div class="body_container">

        <div class="container_left">

        </div>
        <div class="container_right">

            <div class="img_logo">
                <div class="img"></div>
            </div>
            <div class="body_logo">
                <form id="form_login" method="post">
                    <div class="group">
                        <input type="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" maxlength="37" name="email" required>
                        <label>E-mail</label>
                        <span class="bar"></span>
                    </div>

                    <div class="group">
                        <input type="password" id="password" maxlength="20" name="password" required>
                        <label>PassWord</label>
                        <span class="bar"></span>
                    </div>

                    <?php if (isset($error) && !empty($error)): ?>
                        <div class="warning"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <div class="group">
                        <input type="submit" value="Entrar">
                    </div>

                </form>
            </div>

        </div>

    </div>
</body>

<script src="./assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="./assets/js/login.js" type="text/javascript"></script>

</html>