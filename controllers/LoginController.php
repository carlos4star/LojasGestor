<?php

class LoginController extends Controller
{
    public function index()
    {
        $data = array();

        if (isset($_POST['email']) && !empty($_POST['email']))
        {
            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);

            $u = new Users();

            if ($u->doLogin($email, $password))
            {
                header("Location: ".BASE_URL);
                exit;
            }
            else
            {
                $data['error'] = 'E-mail e/ou senha incorretas';
            }
        }

        $this->loadView('login', $data);
    }

    public function logout()
    {
        $u = new Users();
        $u->setLoggedUser();
        if ($u->hasPermissions('logout'))
        {
            $u->logout();
            header("Location: ".BASE_URL);
        }
        else
        {
            echo "Não tem permissão pra fazer logout.....";
            exit;
        }

    }
}