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

    // Validation messages
    public function validateNewAccount() {
        if (!$this->name) {
            self::$alerts['error'][] = 'You must write your name';
        }
        if (!$this->surname) {
            self::$alerts['error'][] = 'You must write your surname';
        }
        if (!$this->phone) {
            self::$alerts['error'][] = 'You must write your phone number';
        }
        if (!$this->email) {
            self::$alerts['error'][] = 'You must write your email';
        }
        if (!$this->password || strlen($this->password) < 8) {
            self::$alerts['error'][] = 'Enter a strong password with at least 6 characters';
        }
        return self::$alerts;
    }

    public function userExists() {
        $query = "SELECT * FROM " . self::$table;
        $query .= " WHERE email = '";
        $query .= $this->email . "' LIMIT 1";
        
        $result = self::$db->query($query);

        if ($result->num_rows) {
            self::$alerts['error'][] = 'User already exists';
        }

        return $result;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function createToken() {
        $this->token = uniqid();
    }
}
