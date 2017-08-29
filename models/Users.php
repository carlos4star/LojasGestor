<?php

class Users extends Model
{
    private $userInfo;
    private $permissions;

    public function isLogged()
    {
        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function doLogin($email, $password)
    {
        $sql = $this->db->prepare("SELECT * FROM tbl_users WHERE email = :email AND password = :password");
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', md5($password));
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            $row = $sql->fetch();
            $_SESSION['ccUser'] = $row['id'];

            return true;
        }
        else
        {
            return false;
        }

    }

    public function setLoggedUser()
    {
        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser']))
        {
            $id = $_SESSION['ccUser'];

            $sql = $this->db->prepare("SELECT * FROM tbl_users WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            if ($sql->rowCount() > 0)
            {
                $this->userInfo = $sql->fetch();
                $this->permissions = new Permissions();
                $this->permissions->setGroup($this->userInfo['groups'], $this->userInfo['id_company']);
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['ccUser']);
    }


    public function hasPermissions($name)
    {
        return $this->permissions->hasPermission($name);
    }


    public function getCompany()
    {
        if (isset($this->userInfo['id_company']))
        {

            return $this->userInfo['id_company'];
        }
        else
        {
            return 0;
        }
    }


    public function getEmail()
    {
        if (isset($this->userInfo['email']))
        {

            return $this->userInfo['email'];
        }
        else
        {
            return '';
        }
    }

    public function getId()
    {
        if (isset($this->userInfo['id']))
        {

            return $this->userInfo['id'];
        }
        else
        {
            return '';
        }
    }


    public function getInfo($id, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM tbl_users WHERE id = :id and id_company = :id_company");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            $array = $sql->fetch();
        }

        return $array;
    }


    //Procurar pelos usuários que estão associados ao grupo que vai ser deletado
    public function findUserInGroup($id)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM tbl_users WHERE groups = :groups");
        $sql->bindValue(':groups', $id);
        $sql->execute();
        $row = $sql->fetch();
        if ($row['c'] == '0')
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function getList($id_company)
    {
        $array = array();
        $sql = $this->db->prepare("SELECT 
                                            tbl_users.id, 
                                            tbl_users.email, 
                                            tbl_permission_groups.name 
                                            FROM tbl_users INNER JOIN tbl_permission_groups on tbl_permission_groups.id = tbl_users.groups
                                            WHERE tbl_users.id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            $array = $sql->fetchAll();
        }

        return json_encode($array);
    }

    public function add($email, $password, $groups, $id_company)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM tbl_users WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();
        $row = $sql->fetch();

        if ($row['c'] == '0')
        {
            $sql = $this->db->prepare("INSERT INTO tbl_users(email, password, groups, id_company) VALUES (:email, :password, :groups, :id_company);");
            $sql->bindValue(':email', $email);
            $sql->bindValue(':password', md5($password));
            $sql->bindValue(':groups', $groups);
            $sql->bindValue('id_company', $id_company);
            $sql->execute();

            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function edit($password, $groups, $id, $id_company)
    {
        $sql = $this->db->prepare("UPDATE tbl_users SET groups = :groups WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(':groups', $groups);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        if (!empty($password))
        {
            $sql = $this->db->prepare("UPDATE tbl_users SET password = :password WHERE id = :id AND id_company = :id_company");
            $sql->bindValue(':password', md5($password));
            $sql->bindValue(':id', $id);
            $sql->bindValue(':id_company', $id_company);
            $sql->execute();
        }

        return 1;
    }

    public function delet_user($id, $id_company)
    {
        $sql = $this->db->prepare("DELETE FROM tbl_users WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        return 1;
    }


}
