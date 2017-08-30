<?php

class Clients extends Model
{
    public function getList($id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM tbl_clients WHERE id_company = :id_company");
        $sql->bindValue('id_company', $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            $array = $sql->fetchAll();
        }

        return json_encode($array);
    }

    public function add_clients($first_name, $last_name, $email, $phone, $address, $address_neighb, $address_city, $address_state, $address_country, $address_zipcode, $stars, $internal_obs, $id_company, $address_number, $address2)
    {
        $sql = $this->db->prepare("INSERT INTO 
                                            tbl_clients(first_name, last_name, email, phone, address, address_neighb, address_city, 
                                            address_state, address_country, address_zipcode, stars, internal_obs, id_company, 
                                            address_number, address2) 
                                            VALUES 
                                            (:first_name, :last_name, :email, :phone, :address, :address_neighb, :address_city, 
                                            :address_state, :address_country, :address_zipcode, :stars, :internal_obs, :id_company, 
                                            :address_number, :address2);");
        $sql->bindValue(':first_name', $first_name);
        $sql->bindValue(':last_name', $last_name);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':phone', $phone);
        $sql->bindValue(':address', $address);
        $sql->bindValue(':address_neighb', $address_neighb);
        $sql->bindValue(':address_city', $address_city);
        $sql->bindValue(':address_state', $address_state);
        $sql->bindValue(':address_country', $address_country);
        $sql->bindValue(':address_zipcode', $address_zipcode);
        $sql->bindValue(':stars', $stars);
        $sql->bindValue(':internal_obs', $internal_obs);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':address_number', $address_number);
        $sql->bindValue(':address2', $address2);
        $sql->execute();

        return 1;

    }

    public function getInfo($id, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM tbl_clients WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            $array = $sql->fetch();
        }


        return $array;
    }

    public function edit_clients($id, $first_name, $last_name, $email, $phone, $address, $address_neighb, $address_city, $address_state, $address_country, $address_zipcode, $stars, $internal_obs, $id_company, $address_number, $address2)
    {
        $sql = $this->db->prepare("UPDATE tbl_clients SET first_name = :first_name, 
                                            last_name = :last_name, email = :email, phone = :phone, address = :address, address_neighb = :address_neighb, 
                                            address_city = :address_city, address_state = :address_state, address_country = :address_country, 
                                            address_zipcode = :address_zipcode, stars = :stars, internal_obs = :internal_obs,
                                            id_company = :id_company, address_number = :address_number, address2 = :address2
                                            WHERE id = :id AND id_company = :id_company2");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company2', $id_company);
        $sql->bindValue(':first_name', $first_name);
        $sql->bindValue(':last_name', $last_name);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':phone', $phone);
        $sql->bindValue(':address', $address);
        $sql->bindValue(':address_neighb', $address_neighb);
        $sql->bindValue(':address_city', $address_city);
        $sql->bindValue(':address_state', $address_state);
        $sql->bindValue(':address_country', $address_country);
        $sql->bindValue(':address_zipcode', $address_zipcode);
        $sql->bindValue(':stars', $stars);
        $sql->bindValue(':internal_obs', $internal_obs);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':address_number', $address_number);
        $sql->bindValue(':address2', $address2);
        $sql->execute();

        return 1;
    }

    public function getCount($id_company)
    {
        $result = 0;

        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM tbl_clients WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        $row = $sql->fetch();
        $result = $row['c'];

        return $result;
    }

    public function searchClientByName($first_name, $id_company)
    {
        $array = array();

        $sql = "SELECT first_name, id FROM tbl_clients WHERE first_name LIKE :first_name LIMIT 10";
        $stmt = $this->db->prepare($sql);
        $name = '%'.$first_name.'%';
        $stmt->bindParam(':first_name', $name);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            $array = $stmt->fetchAll();
        }

        return $array;
    }
}

