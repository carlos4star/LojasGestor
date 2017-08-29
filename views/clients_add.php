<h1>Adicionar Clientes</h1>

<?php if (isset($error_msg) && !empty($error_msg)): ?>
    <div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form class="frm_clients" method="post">
    <div>
        <label for="first_name">Primeiro Nome</label>
        <input type="text" name="first_name" required/>
    </div>

    <div>
        <label for="last_name">Último Nome</label>
        <input type="text" name="last_name" required/>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email"/>
    </div>

    <div>
        <label for="phone">Telefone</label>
        <input type="tel" name="phone" required/>
    </div>

    <div>
        <label for="stars">Estrelas</label>
        <select name="stars" id="stars">
            <option value="1">1 Estrela</option>
            <option value="2">2 Estrela</option>
            <option value="3" selected="selected">3 Estrela</option>
            <option value="4">4 Estrela</option>
            <option value="5">5 Estrela</option>
        </select>
    </div>

    <div>
        <label for="internal_obs">Observações Internas</label>
        <textarea name="internal_obs" id="internal_obs"></textarea>
    </div>

    <div>
        <label for="address_zipcode">Número Contribuinte / CEP</label>
        <input type="text" name="address_zipcode"/>
    </div>

    <div>
        <label for="address">Rua</label>
        <input type="text" name="address"/>
    </div>

    <div>
        <label for="address2">Rua Opcional</label>
        <input type="text" name="address2"/>
    </div>

    <div>
        <label for="address_number">Número</label>
        <input type="text" name="address_number"/>
    </div>

    <div>
        <label for="address_neighb">Bairro</label>
        <input type="text" name="address_neighb"/>
    </div>

    <div>
        <label for="address_city">Cidade</label>
        <input type="text" name="address_city"/>
    </div>

    <div>
        <label for="address_state">Estado</label>
        <input type="text" name="address_state"/>
    </div>

    <div>
        <label for="address_country">País</label>
        <input type="text" name="address_country"/>
    </div>

    <div>
        <div class='button'><a id="btn_add_cli">Salvar</a></div>
    </div>
</form>