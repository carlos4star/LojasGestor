<h2>usuario</h2>

<div class="tabbody">

        <div class='button' id="btnOpenModal"><a>+ Usuário</a></div>
        <h2></h2>
        <table id="tab_usr">
            <thead>
                <tr>
                    <th style="width: 48%">USUÁRIO</th>
                    <th style="width: 45%">GRUPO</th>
                    <th style="width: 7%; text-align: center"></th>
                </tr>
            </thead>

            <tbody>

            </tbody>

        </table>

    <div id="pagination" class="pagination">

    </div>


    <!--Modal de Cadastro Usuário-->

        <div id="openModal" class="modal_Dialog">
            <div class="modal_title">
                <h2>Formulário de Usuário</h2>
                <a title="Fechar" class="closeModal"></a>
            </div>
            <div class = "modal_container">
                <div class="message"></div>

                <form method="post">
                    <div>
                        <input type="email" name="email" placeholder="Email" required/>
                    </div>

                    <div>
                        <input type="password" name="password" placeholder="PassWord" required/>
                    </div>

                    <div>
                        <select name="groups" class="groupsPerm" required>
                            <option value="">Selecione um Grupo de Permissão</option>

                        </select>
                    </div>

                    <div>
                        <div class='button'><a id="btn_add_usr">Enviar</a></div>
                    </div>
                </form>
            </div>
        </div>


        <!--Modal de Editar Usuário-->

        <div id="openModalEdit" class="modal_Dialog">
            <div class="modal_title">
                <h2>Formulário Alterar Usuário</h2>
                <a href="#close" id="btn_close" title="Fechar" class="closeModal"></a>
            </div>
            <div class = "modal_container">
                <div class="message"></div>

                <form method="post">
                    <div>
                        <label for="email">Email</label>
                    </div>

                    <div>
                        <input type="password" name="passwordEdit" placeholder="PassWord" required/>
                    </div>

                    <div>
                        <select name="groupsEdit" class="groupsPerm" required>
                            <option value="">Selecione um Grupo de Permissão</option>
                        </select>
                    </div>

                    <div>
                        <div class='button'><a id="btn_update_usr">Enviar</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script type="text/javascript" src="<?= BASE_URL; ?>/assets/js/users.js"></script>