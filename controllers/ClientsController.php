<?php

class ClientsController extends Controller
{
    public function __construct() {
        parent::__construct();

        $u = new Users();
        if ($u->isLogged() == false)
        {
            header("Location: ".BASE_URL."/login");
        }

    }

    public function index()
    {
        $data = array();

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('clients_view')) {
            $cl = new Clients();
            $offset = 0;
            $data['p'] = 1;
            if (isset($_GET['p']) && !empty($_GET['p']))
            {
                $data['p'] = intval($_GET['p']);
                if ($data['p'] == 0)
                {
                    $data['p'] = 1;
                }
            }

            $offset = (5 * ($data['p']-1));

            $data['clients_list'] = $cl->getList($offset, $u->getCompany());
            $data['clients_count'] = $cl->getCount($u->getCompany());
            $data['p_count'] = ceil($data['clients_count'] / 5);
            $data['edit_permission'] = $u->hasPermissions('clients_edit');

            $this->loadTemplate('clients', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function dataTable()
    {
        $u = new Users();
        $u->setLoggedUser();

        $datactl = $u->getList($u->getCompany());

        die($datactl);
    }

    public function add()
    {
        $data = array();

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('clients_edit')) {
            $cl = new Clients();

            if (isset($_POST['first_name']) && !empty($_POST['first_name']) || isset($_POST['last_name']) && !empty($_POST['last_name']))
            {

                $c = json_encode($cl->add_clients($_POST['first_name'], $_POST['last_name'], $_POST['email'],
                    $_POST['phone'], $_POST['address'], $_POST['address_neighb'], $_POST['address_city'],
                    $_POST['address_state'], $_POST['address_country'], $_POST['address_zipcode'],
                    $_POST['stars'], $_POST['internal_obs'], $u->getCompany(),
                    $_POST['address_number'], $_POST['address2']));
                die($c);
            }

        } else {
            header("Location: " . BASE_URL."/clients");
        }
    }

    public function edit_clients($id)
    {
        $data = array();

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('clients_edit')) {
            $cl = new Clients();

            if (isset($_POST['first_name']) && !empty($_POST['first_name']) || isset($_POST['last_name']) && !empty($_POST['last_name']))
            {
                /*$first_name = addslashes($_POST['first_name']);
                $last_name = addslashes($_POST['last_name']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $stars = addslashes($_POST['stars']);
                $internal_obs = addslashes($_POST['internal_obs']);
                $address_zipcode = addslashes($_POST['address_zipcode']);
                $address = addslashes($_POST['address']);
                $address_neighb = addslashes($_POST['address_neighb']);
                $address_number = addslashes($_POST['address_number']);
                $address2 = addslashes($_POST['address2']);
                $address_city = addslashes($_POST['address_city']);
                $address_state = addslashes($_POST['address_state']);
                $address_country = addslashes($_POST['address_country']);*/

                $ed = json_encode($cl->edit_clients($id, $_POST['first_name'], $_POST['last_name'], $_POST['email'],
                    $_POST['phone'], $_POST['address'], $_POST['address_neighb'], $_POST['address_city'],
                    $_POST['address_state'], $_POST['address_country'], $_POST['address_zipcode'],
                    $_POST['stars'], $_POST['internal_obs'], $u->getCompany(),
                    $_POST['address_number'], $_POST['address2']));

                die($ed);

                //header("Location: ".BASE_URL."/clients");
            }

            //$data['client_info'] = $cl->getInfo($id, $u->getCompany());

            //$this->loadTemplate('#openModalEditClients', $data);
        } else {
            header("Location: " . BASE_URL."/clients");
        }
    }

    public function delet_clients()
    {

    }
}

$intencao["Add"] =  function ()
{
    $cli = new ClientsController();

    $cli->add();
};

$intencao["Edit"] =  function ()
{
    $cli = new ClientsController();

    $cli->edit_clients($_POST['id']);
};

$intencao["Delet"] =  function ()
{
    $cli = new ClientsController();

    $cli->delet_clients('id');
};

$intencao["tabela"] =  function ()
{
    $cli = new ClientsController();

    $cli->delet_clients('id');
};

if (isset($_POST['int']))
{
    $intencao[$_POST['int']]();
}