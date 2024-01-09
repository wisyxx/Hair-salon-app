<?php

namespace Model;

class User extends ActiveRecord
{
    protected static $table = 'users';
    protected static $DBColumns = [
        'id', 'name',
        'surname', 'email',
        'phone', 'password',
        'admin', 'confirmed',
        'token'
    ];

    public $id;
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $password;
    public $admin;
    public $confirmed;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->surname = $args['surname'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->admin = $args['admin'] ?? null;
        $this->confirmed = $args['confirmed'] ?? null;
        $this->token = $args['token'] ?? '';
    }
}
