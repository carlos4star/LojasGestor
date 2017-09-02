<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painél - <?php echo $viewData['company_name']; ?></title>
    <link href="<?php echo BASE_URL; ?>/assets/css/template.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200" rel="stylesheet">
    <script type="text/javascript" src="<?= BASE_URL; ?>/assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        var BASE_URL = "<?php echo BASE_URL; ?>";
    </script>
    <script type="text/javascript" src="<?= BASE_URL; ?>/assets/js/template.js"></script>
</head>
<body>

<div class="body_int">
    <div class="box_left">
        <div class="logotipo">
            <div class="logo"></div>
            <div class="nameCompany">
                <?php echo $viewData['company_name']; ?>
            </div>
        </div>
        <div class="menu_lateral">
            <ul>
                <li class="menu_ativo"><a href="<?php echo BASE_URL; ?>">Home</a></li>
                <li><a href="<?php echo BASE_URL; ?>/Permissions">Permissões</a></li>
                <li><a href="<?php echo BASE_URL; ?>/Users">Usuários</a></li>
                <li><a href="<?php echo BASE_URL; ?>/Clients">Clientes</a></li>
                <li><a href="<?php echo BASE_URL; ?>/Inventory">Estoque</a></li>
                <li><a href="">Contato</a></li>
            </ul>
        </div>
    </div>
    <div class="box_right">
        <div class="top_not">
            <div class="top_not_left">

            </div>
            <div class="top_not_right">
                <div class="user_email"><?php echo $viewData['user_email']; ?></div>
                <div class="button"><a href="<?php echo BASE_URL.'/login/logout'; ?>">Sair</a></div>
            </div>
        </div>
        <div class="container">

            <div class="box_menu">

                <div class="menu_box_item"></div>
                <div class="menu_box_item"></div>
                <div class="menu_box_item"></div>
                <div class="menu_box_item"></div>

            </div>
            <div class="body_container">
                <?php $this->loadViewInTemplate($viewName, $viewData) ?>
            </div>

        </div>
    </div>
</div>

</body>
</html>
