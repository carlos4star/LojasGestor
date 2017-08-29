<h1>Alterar Informações do Cliente</h1>

<?php if (isset($error_msg) && !empty($error_msg)): ?>
    <div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form class="frm_permiss" method="post">
    <div>
        <label for="first_name">Primeiro Nome</label>
        <input type="text" name="first_name" value="<?php echo $client_info['first_name']; ?>" required/>
    </div>

    <div>
        <label for="last_name">Último Nome</label>
        <input type="text" name="last_name" value="<?php echo $client_info['last_name']; ?>" required/>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo $client_info['email']; ?>"/>
    </div>

    <div>
        <label for="phone">Telefone</label>
        <input type="tel" name="phone" value="<?php echo $client_info['phone']; ?>" required/>
    </div>

    <div>
        <label for="stars">Estrelas</label>
        <select name="stars" id="stars">
            <option value="1" <?php echo ($client_info['stars'] =='1')?'selected="selected"':''; ?>>1 Estrela</option>
            <option value="2" <?php echo ($client_info['stars'] =='2')?'selected="selected"':''; ?>>2 Estrela</option>
            <option value="3" <?php echo ($client_info['stars'] =='3')?'selected="selected"':''; ?>>3 Estrela</option>
            <option value="4" <?php echo ($client_info['stars'] =='4')?'selected="selected"':''; ?>>4 Estrela</option>
            <option value="5" <?php echo ($client_info['stars'] =='5')?'selected="selected"':''; ?>>5 Estrela</option>
        </select>
    </div>

    <div>
        <label for="internal_obs">Observações Internas</label>
        <textarea name="internal_obs" id="internal_obs"><?php echo $client_info['internal_obs']; ?></textarea>
    </div>

    <div>
        <label for="address_zipcode">Número Contribuinte / CEP</label>
        <input type="text" name="address_zipcode" value="<?php echo $client_info['address_zipcode']; ?>"/>
    </div>

    <div>
        <label for="address">Rua</label>
        <input type="text" name="address" value="<?php echo $client_info['address']; ?>"/>
    </div>

    <div>
        <label for="address2">Rua</label>
        <input type="text" name="address2" value="<?php echo $client_info['address2']; ?>"/>
    </div>

    <div>
        <label for="address_number">Número</label>
        <input type="text" name="address_number" value="<?php echo $client_info['address_number']; ?>"/>
    </div>

    <div>
        <label for="address_neighb">Bairro</label>
        <input type="text" name="address_neighb" value="<?php echo $client_info['address_neighb']; ?>"/>
    </div>

    <div>
        <label for="address_city">Cidade</label>
        <input type="text" name="address_city" value="<?php echo $client_info['address_city']; ?>"/>
    </div>

    <div>
        <label for="address_state">Estado</label>
        <input type="text" name="address_state" value="<?php echo $client_info['address_state']; ?>"/>
    </div>

    <div>
        <label for="address_country">País</label>
        <input type="text" name="address_country" value="<?php echo $client_info['address_country']; ?>"/>
    </div>

    <div>
        <input type="submit" value="Adicionar">
    </div>
</form>