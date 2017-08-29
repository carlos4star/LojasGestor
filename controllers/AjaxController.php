<?php

class ajaxController extends Controller
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

    }

    public function search_clients()
    {
        $data = array();

        $u = new Users();
        $u->setLoggedUser();
        $client = new Clients();

        if (isset($_POST['q']) && !empty($_POST['q']))
        {
            $name =addslashes($_POST['q']);
            $cl = $client->searchClientByName($name, $u->getCompany());

            foreach ($cl as $clitem)
            {
                $data[] = array(
                    'name' => $clitem['first_name'],
                    'link' => BASE_URL.'/clients/clients_edit/'.$clitem['id'],
                    'id' => $clitem['id']
                );
            }

        }


        echo json_encode($data);
    }
}