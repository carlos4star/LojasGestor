<?php

class InventoryController extends Controller
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

        if ($u->hasPermissions('inventory_view'))
        {

            $inv = new Inventory();
            $offset = 0;

            $data['inventory_list'] = $inv->getList($offset, $u->getCompany());


            $data['add_permission'] = $u->hasPermissions('inventory_add_view');
            $data['edit_permission'] = $u->hasPermissions('inventory_edit_view');

            $this->loadTemplate('inventory', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }


    public function add()
    {
        $data = array();

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('inventory_add_view')) {
            $invent = new Inventory();

            if (isset($_POST['name']) && !empty($_POST['name']) || isset($_POST['quant']) && !empty($_POST['quant']))
            {

              $price = addslashes($_POST['price']);
              $price = str_replace(',','.', $price);


              $i = json_encode($invent->add($_POST['name'], $price, $_POST['quant'], $_POST['min_quant'], $u->getCompany(), $u->getId()));

              die($i);
            }

        } else {
            header("Location: " . BASE_URL."/inventory");
        }
    }
}


$intencao["Add"] =  function (){
    $inven = new InventoryController();

    $inven->add();
};

if (isset($_POST['int']))
{
    $intencao[$_POST['int']]();
}