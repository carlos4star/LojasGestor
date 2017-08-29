<h1>Modificar Grupo de Permissões</h1>

<form method="post">
    <div>
        <label for="nome">Grupo de Permissão</label>
        <input type="text" name="nome" value="<?php echo $group_info['name']; ?>" required/>
    </div>

    <div>
        <label>Permissões</label>
        <?php foreach ($permission_list as $p): ?>
            <div class="p_item">
                <input type="checkbox" name="permissions[]" value="<?php echo $p['id']; ?>" id="p_<?php echo $p['id']; ?>" <?php echo (in_array($p['id'], $group_info['params']))?'checked="checked"':''; ?>/>
                <label for="p_<?php echo $p['id']; ?>"><?php echo $p['nome']; ?></label>
            </div>
        <?php endforeach; ?>
    </div>

    <div>
        <input type="submit" value="Editar">
    </div>
</form>