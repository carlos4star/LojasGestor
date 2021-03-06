<h2>Permissões</h2>

<div class="tabarea">
    <label id="tabitemGroup" class="tabitem activetab">Grupos de Permissões</label>
    <label id="tabitemPerm" class="tabitem">Permissões</label>
</div>

<div class="tabcontent">
    <div class="tabbody">
        <div class='button'><a href="#modalAddGroup">+ Grupo Permissões</a></div>

        <table id="tbl_perm">
            <thead>
                <tr>
                    <th style="width: 93%">Grupo de Permissão</th>
                    <th style="width: 7%"></th>
                </tr>
            </thead>
            <tbody id="tabbodyGroup">

            </tbody>
        </table>

        <div id="paginationGroup" class="pagination"></div>
    </div>

    <div class="tabbody">

        <div class='button'><a href="#modalAddPermission">+ Permissões</a></div>

        <table>
            <thead>
                <tr>
                    <th style="width: 93%">Permissão</th>
                    <th style="width: 7%">Ação</th>
                </tr>
            </thead>
            <tbody id="tabbodyPerm">

            </tbody>
        </table>
        <div id="pagination" class="pagination"></div>
    </div>
</div>



<!--Modal de Add Permission-->

<div id="modalAddPermission" class="modal_Dialog">
    <div class="modal_title">
        <h2>Formulário Adicionar Permissões</h2>
        <a href="#close" title="Fechar" class="closeModal"></a>
    </div>
    <div class = "modal_container">
        <div class="message"></div>

        <form method="post">
            <div>
                <input type="text" name="nome" placeholder="Permissão" required/>
            </div>

            <div>
                <div class='button'><a id="btn_add_perm">Enviar</a></div>
            </div>
        </form>
    </div>
</div>


<!--Modal de Add Group-->

<div id="modalAddGroup" class="modal_Dialog">
    <div class="modal_title">
        <h2>Formulário Adicionar Permissões</h2>
        <a href="#close" title="Fechar" class="closeModal"></a>
    </div>
    <div class = "modal_container">
        <div class="message"></div>

        <form method="post">
            <div>
                <input type="text" name="nome_group" placeholder="Grupo de Permissão" required/>
            </div>

            <label>Permissões</label>

            <div id="Group_perm">

            </div>

            <div>
                <div class='button'><a id="btn_add_group">Enviar</a></div>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript" src="<?= BASE_URL; ?>/assets/js/permissions.js"></script>