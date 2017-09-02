<?php

class PermissionsController extends Controller
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
        $permissions = new Permissions();

        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('permission_view'))
        {
            $data['permission_list'] = $permissions->getList($u->getCompany());
            $data['permission_groups_list'] = $permissions->getgroupList($u->getCompany());


            $this->loadTemplate('permissions', $data);
        }
        else
        {
            header("Location: ". BASE_URL);
        }
    }


    public function dataTablePerm()
    {
        $u = new Users();
        $u->setLoggedUser();
        $permissions = new Permissions();

        if ($u->hasPermissions('permission_view')) {

            $perm = $permissions->getList($u->getCompany());


            die($perm);
        }
        else
        {
            header("Location: " . BASE_URL);
        }
    }

    public function dataPerm()
    {
        $u = new Users();
        $u->setLoggedUser();
        $permissions = new Permissions();

        if ($u->hasPermissions('permission_view')) {

            $perm = $permissions->getList($u->getCompany());

            die($perm);
        }
        else
        {
            header("Location: " . BASE_URL);
        }
    }

    public function dataTableGroup()
    {
        $u = new Users();
        $u->setLoggedUser();
        $permissions = new Permissions();

        if ($u->hasPermissions('permission_view')) {

            $perm = $permissions->getgroupList($u->getCompany());

            die($perm);
        }
        else
        {
            header("Location: " . BASE_URL);
        }
    }

    public function chkPerm()
    {
        $u = new Users();
        $u->setLoggedUser();
        $perm = new Permissions();

        if ($u->hasPermissions('permission_view')) {

            $permission = $perm->getList($u->getCompany());

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

        if ($u->hasPermissions('permission_view'))
        {
            $permissions = new Permissions();

            if (isset($_POST['nome']) && !empty($_POST['nome']))
            {
                //$permname = addslashes($_POST['nome']);
                $p = json_encode($permissions->add($_POST['nome'], $u->getCompany()));

                die($p);
                //header("Location: ".BASE_URL."/permissions");
            }

            $this->loadTemplate('permissions', $data);
        }
        else
        {
            header("Location: ". BASE_URL);
        }
    }

    public function add_group()
    {
        $data = array();

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('permission_view'))
        {
            $permissions = new Permissions();

            if (isset($_POST['nome']) && !empty($_POST['nome']))
            {
                $permname = $_POST['nome'];
                $permlist = $_POST['permissions'];

                $perGroup = json_encode($permissions->addGruop($permname, $permlist, $u->getCompany()));

                die($perGroup);
                //header("Location: ".BASE_URL."/permissions");
            }

            //$data['permission_list'] = $permissions->getList($u->getCompany());

            //$this->loadTemplate('permissions_addgroup', $data);
        }
        else
        {
            header("Location: ". BASE_URL);
        }
    }


    public function edit_group($id)
    {
        $data = array();

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('permission_view'))
        {
            $permissions = new Permissions();

            if (isset($_POST['nome']) && !empty($_POST['nome']))
            {
                $permname = addslashes($_POST['nome']);
                $permlist = $_POST['permissions'];

                $permissions->editGruop($permname, $permlist, $id, $u->getCompany());
                header("Location: ".BASE_URL."/permissions");
            }

            $data['permission_list'] = $permissions->getList($u->getCompany());
            $data['group_info'] = $permissions->getgroup($id, $u->getCompany());

            $this->loadTemplate('permissions_editgroup', $data);
        }
        else
        {
            header("Location: ". BASE_URL);
        }
    }


    public function delet($id)
    {
        $u = new Users();
        $u->setLoggedUser();

        if ($u->hasPermissions('permission_view'))
        {
            $permissions = new Permissions();

            $perm = $permissions->delet($id, $u->getCompany());
            die($perm);
        }
        else
        {
            header("Location: ". BASE_URL);
        }
    }

    public function delet_group($id)
    {
        $u = new Users();
        $u->setLoggedUser();

        if ($u->hasPermissions('permission_view'))
        {
            $permissions = new Permissions();

            $permissions->delet_group($id, $u->getCompany());
        }
        else
        {
            header("Location: ". BASE_URL);
        }
    }
}


$intencao["Add"] =  function (){
    $perm = new PermissionsController();

    $perm->add();
};

$intencao["perm"] =  function (){
    $perm = new PermissionsController();

    $perm->dataPerm();
};

$intencao["AddGroup"] =  function (){
    $perm = new PermissionsController();

    $perm->add_group();
};

$intencao["tabelaPerm"] =  function (){
    $perm = new PermissionsController();

    $perm->dataTablePerm();
};

$intencao["tabelaGroup"] =  function (){
    $perm = new PermissionsController();

    $perm->dataTableGroup();
};

$intencao["chekPerm"] =  function (){
    $perm = new PermissionsController();

    $perm->chkPerm();
};

$intencao["delet_perm"] =  function (){
    $perm = new PermissionsController();

    $perm->delet($_POST['id']);
};

$intencao["delet_group"] =  function (){
    $perm = new PermissionsController();

    $perm->delet_group($_POST['id']);
};

if (isset($_POST['int']))
{
    $intencao[$_POST['int']]();
}