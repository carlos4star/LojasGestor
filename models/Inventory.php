<?php

class Inventory extends Model
{
    public function getList($offset, $id_Company)
    {
        $array = array();

        $sql = "SELECT * FROM tbl_inventory WHERE id_company = :id_company OFFSET :offset LIMIT 5";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_company", $id_Company);
        $stmt->bindParam(":offset", $offset);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }
        return $array;
    }

    public function getInfo($id, $idCompany) {
        $sql = "SELECT * FROM inventory WHERE id = :id AND id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        }
        return null;
    }

    public function add($name, $price, $quant, $min_quant, $id_company, $id_user)
    {

        $sql = "INSERT INTO tbl_inventory(name, price, quant, min_quant, id_company) VALUES (:name, :price, :quant, :min_quant, :id_company)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":quant", $quant);
        $stmt->bindParam(":min_quant", $min_quant);
        $stmt->bindParam(":id_company", $id_company);
        $stmt->execute();

        // pegando o id do produto inserido no inventory
        $id_product = $this->db->lastInsertId();
        $action = 'add';
        $date_action = date('d/m/y/ H:i:s');

        // como se fosse um log de uso
        // já persiste no inventory_history
        //$this->setLog($idProduct, $id_company, $idUser, 'add');
        $sql = "INSERT INTO tbl_inventory_history(id_product, id_user, action, date_action, id_company) VALUES (:id_product, :id_user, :action, :date_action, :id_company)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_product", $id_product);
        $stmt->bindParam(":id_user", $id_user);
        $stmt->bindParam(":action", $action);
        $stmt->bindParam(":date_action", $date_action);
        $stmt->bindParam(":id_company", $id_company);
        $stmt->execute();

        return 1;
    }

    public function edit($id, $name, $price, $quant, $min_quant, $idCompany, $idUser) {
        $sql = "UPDATE inventory "
            . "SET name = :name, price = :price, quant = :quant, min_quant = :min_quant "
            . "WHERE id = :id AND id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":quant", $quant);
        $stmt->bindParam(":min_quant", $min_quant);
        $stmt->bindParam(":id_company", $idCompany);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        // como se fosse um log de uso
        // já persiste no inventory_history
        $this->setLog($id, $idCompany, $idUser, 'edt');
    }

    public function delete($id, $idCompany, $idUser) {
        $sql = "DELETE FROM inventory WHERE id = :id AND id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();

        // como se fosse um log de uso
        // já persiste no inventory_history
        //$this->setLog($id, $idCompany, $idUser, 'del');
    }

    public function searchInventoryByName($name, $idCompany) {
        $sql = "SELECT * FROM inventory WHERE name LIKE :name AND id_company = :id_company LIMIT 10";
        $stmt = $this->db->prepare($sql);
        $name = '%' . $name . '%';
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":id_company", $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }

        return null;
    }

    private function setLog($idProduct, $idCompany, $idUser, $action) {
        $sql = "INSERT INTO inventory_history SET id_company = :id_company, "
            . "id_product = :id_product, id_user = :id_user, action = :action, date_action = NOW()";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_company", $idCompany);
        $stmt->bindParam(":id_product", $idProduct);
        $stmt->bindParam(":id_user", $idUser);
        $stmt->bindParam(":action", $action);
        $stmt->execute();
    }

    public function serchProductsByName($name, $idCompany) {

        $sql = "SELECT name, price, id FROM inventory WHERE name LIKE :name AND id_company = :id_company LIMIT 10";
        $stmt = $this->db->prepare($sql);
        $name = '%' . $name . '%';
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }

        return null;
    }

    public function decrease($idProd, $idCompany, $quantProd, $idUser) {
        $sql = "UPDATE inventory SET quant = quant - $quantProd WHERE id = :id AND id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $idProd);
        $stmt->bindParam(":id_company", $idCompany);
        $stmt->execute();

        $this->setLog($idProd, $idCompany, $idUser, 'dwn');
    }

    public function getInventoryFiltered($idCompany) {
        $sql = "SELECT *, (min_quant - quant) as dif FROM inventory "
            . "WHERE quant <= min_quant AND id_company = :id_company "
            . "ORDER BY dif DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_company", $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }

        return null;
    }
}