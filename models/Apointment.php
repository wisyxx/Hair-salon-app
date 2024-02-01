<?php

namespace Model;

class Apointment extends ActiveRecord
{
    protected static $table = 'apointments';
    protected static $DBColumns = ['id', 'date', 'hour', 'userId'];

    public $id;
    public $date;
    public $hour;
    public $userId;

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? null;
        $this->date = $args['date'] ?? '';
        $this->hour = $args['hour'] ?? '';
        $this->userId = $args['userId'] ?? '';
    }
}