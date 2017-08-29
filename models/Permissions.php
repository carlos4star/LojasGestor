<?php

class Permissions extends Model
{

    private $group;
    private $permissions;

    public function setGroup($id, $id_company)
    {
        $this->group = $id;
        $this->permissions = array();

        $sql = $this->db->prepare("SELECT * FROM tbl_permission_groups WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            $row = $sql->fetch();

            if (empty($row['params']))
            {
                $row['params'] = '0';
            }

            $params = $row['params'];

            $sql = $this->db->prepare("SELECT nome FROM tbl_permission_params WHERE id IN ($params) AND id_company = :id_company");
            $sql->bindValue(':id_company', $id_company);
            $sql->execute();

            if ($sql->rowCount() > 0)
            {
                foreach ($sql->fetchAll() as $item)
                {
                    $this->permissions[] = $item['nome'];
                }
            }
        }
    }

    //Função pra verificar se tem permissão
    public function hasPermission($nome)
    {
        if (in_array($nome, $this->permissions))
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    //Pegar Lista de todas as permissões de acordo com a empresa
    public function getList($id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM tbl_permission_params WHERE id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            $array = $sql->fetchAll();
        }

        return json_encode($array);
    }

    public function getgroupList($id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM tbl_permission_groups WHERE id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            $array = $sql->fetchAll();
        }

        return json_encode($array);
    }


    public function getgroup($id, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM tbl_permission_groups WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            $array = $sql->fetch();
            $array['params'] = explode(',', $array['params']);
        }

        return $array;
    }


    //Adicionar permissões no banco de dados
    public function add($nome, $id_company)
    {
        $sql = $this->db->prepare("INSERT INTO tbl_permission_params(nome, id_company) VALUES(:nome, :id_company);");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        return 1;
    }

    public function addGruop($permname, $permlist, $id_company)
    {
        $params = implode(',', $permlist);
        $sql = $this->db->prepare("INSERT INTO tbl_permission_groups(name, params, id_company) VALUES(:name, :params, :id_company);");
        $sql->bindValue(':name', $permname);
        $sql->bindValue(':params', $params);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        return 1;
    }


    public function editGruop($permname, $permlist, $id, $id_company)
    {
        $params = implode(',', $permlist);

        $sql = $this->db->prepare("UPDATE tbl_permission_groups SET name = :name, params = :params, id_company = :id_company WHERE id = :id");
        $sql->bindValue(':name', $permname);
        $sql->bindValue(':params', $params);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }


    public function delet($id)
    {
        $sql = $this->db->prepare("DELETE FROM tbl_permission_params WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function delet_group($id)
    {
        $u = new Users();

        if ($u->findUserInGroup($id) == false)
        {
            $sql = $this->db->prepare("DELETE FROM tbl_permission_groups WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
        }
    }
}