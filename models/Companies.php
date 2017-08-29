<?php

class Companies extends Model
{
    private $companyInfor;

    public function  __construct($id)
    {
        parent::__construct();

        $sql = $this->db->prepare("SELECT * FROM tbl_companies WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            $this->companyInfor = $sql->fetch();
        }
    }

    public function getName()
    {
        if (isset($this->companyInfor['name']))
        {
            return $this->companyInfor['name'];
        }
        else
        {
            return '';
        }
    }
}