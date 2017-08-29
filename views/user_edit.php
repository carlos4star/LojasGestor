<h1>Editar Usuário</h1>

<?php if (isset($error_msg) && !empty($error_msg)): ?>
    <div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="post">
    <div>
        <label for="email">Email</label>
        <div><?php echo $user_info['email']; ?></div>
    </div>

    <div>
        <label for="password">Senha</label>
        <input type="password" name="password"/>
    </div>

    <div>
        <label for="groups">Grupo de Permissão</label>
        <select name="groups" id="groups" required>
            <?php foreach ($group_list as $g): ?>
                <option value="<?php echo $g['id']; ?>" <?php echo ($g['id'] == $user_info['groups'])?'selected ="selected"':''; ?>><?php echo $g['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <input type="submit" value="Editar">
    </div>
</form>