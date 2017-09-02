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
                <th style="width: 53%">Nome</th>
                <th style="width: 20%">Preço</th>
                <th style="width: 15%">Quantidade</th>
                <th style="width: 15%">Quant.Min</th>
                <th style="width: 7%"></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <div id="pagination" class="pagination">

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