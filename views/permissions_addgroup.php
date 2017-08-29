<h1>Adicionar Grupo de Permissões</h1>

<form method="post">
    <div>
        <input type="text" name="nome" placeholder="Grupo de Permissão" required/>
    </div>

    <label>Permissões</label>

    <div class="Group_perm">
        <?php foreach ($permission_list as $p): ?>
            <div class="p_item">
                <input type="checkbox" name="permissions[]" value="<?php echo $p['id']; ?>" id="p_<?php echo $p['id']; ?>"/>
                <label for="p_<?php echo $p['id']; ?>"><?php echo $p['nome']; ?></label>
            </div>
        <?php endforeach; ?>
    </div>

    <div >
        <div><input type="submit" value="Adicionar"></div>
    </div>
</form>