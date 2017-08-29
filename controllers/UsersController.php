<?php

class UsersController extends Controller {

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
        $permiss = new Permissions();

        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('users_view')) {
            $data['users_list'] = $u->getList($u->getCompany());
            $data['select_group'] = $permiss->getgroupList($u->getCompany());
            $data['group_list'] = $permiss->getgroupList($u->getCompany());

            $this->loadTemplate('users', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function dataTable()
    {
        $u = new Users();
        $u->setLoggedUser();

        if ($u->hasPermissions('users_view')) {

            $usr = $u->getList($u->getCompany());

            die($usr);
        }
        else
        {
            header("Location: " . BASE_URL);
        }
    }

    public function dataGroup()
    {
        $u = new Users();
        $g = new Permissions();
        $u->setLoggedUser();

        if ($u->hasPermissions('users_view')) {

            $usr = $g->getgroupList($u->getCompany());

            die($usr);
        }
        else
        {
            header("Location: " . BASE_URL);
        }
    }

    public function option()
    {
        $u = new Users();
        $u->setLoggedUser();
        $perm = new Permissions();

        if ($u->hasPermissions('users_view')) {

            $permission = $perm->getgroupList($u->getCompany());

            die($permission);
        }
        else
        {
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

        if ($u->hasPermissions('users_view')) {
            $p = new Permissions();

            if (isset($_POST['email']) && !empty($_POST['email']))
            {

                $a = json_encode($u->add($_POST['email'], $_POST['password'], $_POST['groups'], $u->getCompany()));

                die($a);
            }

        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function edit_user($id)
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('users_view')) {
            $p = new Permissions();

            if (isset($_POST['groups']) && !empty($_POST['groups']))
            {
                /*$password = addslashes($_POST['password']);
                $groups = addslashes($_POST['groups']);*/

                $usr = json_encode($u->edit($_POST['password'], $_POST['groups'], $id, $u->getCompany()));

                die(json_encode($usr));
                //header("Location: ".BASE_URL."/users");
            }

            $data['user_info'] = $u->getInfo($id, $u->getCompany());
            $data['group_list'] = $p->getgroupList($u->getCompany());

            $this->loadTemplate('users', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function delet_user($id)
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('users_view')) {
            $p = new Permissions();
            $usr = $u->delet_user($id, $u->getCompany());
            die (json_encode($usr));
        }
        else
        {
            header("Location: " . BASE_URL);
        }
    }

}

$intencao["Add"] =  function (){
    $usr = new UsersController();

    $usr->add();
};

$intencao["Update"] =  function (){
    $usr = new UsersController();

    $usr->edit_user($_POST['id']);
};

$intencao["Delet"] =  function (){
    $usr = new UsersController();

    $usr->delet_user($_POST['id']);
};

$intencao["tabela"] =  function (){
    $usr = new UsersController();

    $usr->dataTable();
};

$intencao["carregarGroup"] =  function (){
    $usr = new UsersController();

    $usr->dataGroup();
};

$intencao["option"] =  function (){
    $usr = new UsersController();

    $usr->option();
};

if (isset($_POST['int']))
{
    $intencao[$_POST['int']]();
}
