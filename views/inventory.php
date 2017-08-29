<h2>Inventory</h2>


<div class="tabbody">

    <div class="header_clients">
        <?php if ($add_permission): ?>
            <div class='button'><a href="#openModal_Add_Inventory">+ Produto</a></div>
        <?php endif; ?>

        <div class="search_text">
            <input type="text" id="busca" data-type="search_inventory" placeholder="procurar" />
            <div class="searchresults"></div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 45%">Nome</th>
                <th style="width: 20%">Preço</th>
                <th style="width: 15%">Quantidade</th>
                <th style="width: 15%">Quant.Min</th>
                <th style="width: 15%">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inventory_list as $produt): ?>
            <tr>
                <td style="width: 45%"><?php echo $produt['name']; ?></td>
                <td style="width: 20%"><?php echo number_format($produt['price'], 2); ?></td>
                <td style="width: 15%"><?php echo $produt['quant']; ?></td>
                <td style="width: 15%"><?php
                        if ($produt['min_quant'] > $produt['quant'])
                        {
                            echo '<span style = "color: #D84315">'.($produt['min_quant']).'</span>';
                        }
                        else
                        {
                            echo $produt['min_quant'];
                        }
                    ?></td>
                <td style="width: 15%">
                    <?php if ($edit_permission): ?>
                        <div style="width: 50%" class="button_small"><a data-target="#openModalEditClients">Editar</a></div>
                        <div style="width: 50%" class="button_small"><a href="" onclick="return confirm('Tem Certeza que deseja Eliminar o Usuario ?')">Excluir</a></div>
                    <?php else: ?>
                        <div class="button_small"><a href="">Ver</a></div>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
            <div class="pag_item"><a href=""></a></div>
    </div>



    <!--Modal de Cadastro Cliente-->

    <div id="openModal_Add_Inventory" class="modal_Dialog">
        <div class="modal_title">
            <h2>Formulário de Produto</h2>
            <a href="#close" title="Fechar" class="closeModal"></a>
        </div>
        <div class = "modal_container">
            <div id="message"></div>

            <form class="" method="post">
                <div>
                    <input type="text" name="name" placeholder="Nome do Produto" required/>
                </div>
                <div>
                    <input type="text" name="price" placeholder="preço" required/>
                </div>
                <div>
                    <input type="number" name="quant" placeholder="Quantidade" required/>
                </div>
                <div>
                    <input type="number" name="min_quant" placeholder="Quantidade Miníma" required/>
                </div>
                <div>
                    <div class='button'><a id="btn_add_inv">Enviar</a></div>
                </div>
            </form>

        </div>
    </div>

</div>

<script type="text/javascript" src="<?= BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?= BASE_URL; ?>/assets/js/inventory.js"></script>