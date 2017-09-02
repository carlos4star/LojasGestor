<h2>Clientes</h2>

<div class="tabbody">

    <div class="header_clients">
        <?php if ($edit_permission): ?>
            <div class='button'><a href="#openModal">+  Clientes</a></div>
        <?php endif; ?>

        <div class="search_text">
            <input type="text" id="busca" data-type="search_clients" placeholder="procurar" />
            <div class="searchresults"></div>
        </div>
    </div>

    <div class="box_table">
        <table>
            <thead>
            <tr>
                <th style="width: 38%">Nome</th>
                <th style="width: 15%">Telefone</th>
                <th style="width: 30%">Cidade</th>
                <th style="width: 10%">Estrelas</th>
                <th style="width: 7%"></th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div id="pagination" class="pagination">
    </div>

    </div>



    <!--Modal de Cadastro Cliente-->

    <div id="openModal" class="modal_Dialog">
        <div class="modal_title">
            <h2>Formulário de Cliente</h2>
            <a href="#close" title="Fechar" class="closeModal"></a>
        </div>
        <div class = "modal_container">
            <div id="message"></div>

            <form class="frm_clients" method="post">
                <div>
                    <input type="text" name="first_name" placeholder="Primeiro Nome" required/>
                </div>

                <div>
                    <input type="text" name="last_name" placeholder="Último Nome" required/>
                </div>

                <div>
                    <input type="email" name="email" placeholder="Email"/>
                </div>

                <div>
                    <input type="tel" name="phone" placeholder="Telefone" required/>
                </div>

                <div>
                    <select name="stars" id="stars">
                        <option value="1">1 Estrela</option>
                        <option value="2">2 Estrela</option>
                        <option value="3" selected="selected">3 Estrela</option>
                        <option value="4">4 Estrela</option>
                        <option value="5">5 Estrela</option>
                    </select>
                </div>

                <div>
                    <textarea name="internal_obs" id="internal_obs" placeholder="Observações Internas"></textarea>
                </div>

                <div>
                    <input type="text" name="address_zipcode" placeholder="Número Contribuinte / CEP"/>
                </div>

                <div>
                    <input type="text" name="address" placeholder="Rua"/>
                </div>

                <div>
                    <input type="text" name="address2" placeholder="Rua Opcional"/>
                </div>

                <div>
                    <input type="text" name="address_number" placeholder="Número"/>
                </div>

                <div>
                    <input type="text" name="address_neighb" placeholder="Bairro"/>
                </div>

                <div>
                    <input type="text" name="address_city" placeholder="Cidade"/>
                </div>

                <div>
                    <input type="text" name="address_state" placeholder="Estado"/>
                </div>

                <div>
                    <input type="text" name="address_country" placeholder="País"/>
                </div>

                <div>
                    <div class='button'><a id="btn_add_cli">Enviar</a></div>
                </div>
            </form>

        </div>
    </div>




<!-- Formulário para Editar Clientes -->
    <div id="openModalEditClients" class="modal_Dialog">
        <div class="modal_title">
            <h2>Formulário Editar Cliente</h2>
            <a href="#close" title="Fechar" class="closeModal"></a>
        </div>
        <div class = "modal_container">
            <div id="message"></div>

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
                    <input type="email" name="email""/>
                </div>

                <div>
                    <label for="phone">Telefone</label>
                    <input type="tel" name="phone"required/>
                </div>

                <div>
                    <label for="stars">Estrelas</label>
                    <select name="stars" id="stars">
                        <option value="1" >1 Estrela</option>
                        <option value="2" >2 Estrela</option>
                        <option value="3" >3 Estrela</option>
                        <option value="4" >4 Estrela</option>
                        <option value="5" >5 Estrela</option>
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
                    <label for="address2">Rua</label>
                    <input type="text" name="address2"/>
                </div>

                <div>
                    <label for="address_number">Número</label>
                    <input type="text" name="address_number"/>
                </div>

                <div>
                    <label for="address_neighb">Bairro</label>
                    <input type="text" name="address_neighb" />
                </div>

                <div>
                    <label for="address_city">Cidade</label>
                    <input type="text" name="address_city" />
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
                    <div class='button'><a id="btn_edit_cli">Enviar</a></div>
                </div>
            </form>

        </div>
    </div>


</div>

<script type="text/javascript" src="<?= BASE_URL; ?>/assets/js/clients.js"></script>