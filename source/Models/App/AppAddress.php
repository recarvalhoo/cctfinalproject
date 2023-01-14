<?php


namespace Source\Models\App;


use Source\Core\Model;

class AppAddress extends Model
{
    public function __construct()
    {
        parent::__construct("user_address", ["id"], ["user_id"]);
    }
}
