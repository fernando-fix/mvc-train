<?php
namespace src\models;
use \core\Model;

class User extends Model {
    public $id;
    public $name;
    public $email;
    public $token;
}