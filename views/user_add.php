<h1>Adicionar Usuário</h1>

<div id="message"></div>

<form method="post">
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" required/>
    </div>

    <div>
        <label for="password">Senha</label>
        <input type="password" name="password" required/>
    </div>

    <div>
        <label for="groups">Grupo de Permissão</label>
        <select name="groups" id="groups" required>
            <?php foreach ($group_list as $g): ?>
                <option value="<?php echo $g['id']; ?>"><?php echo $g['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <div class='button'><a id="btn_add_usr">Salvar</a></div>
    </div>
</form>