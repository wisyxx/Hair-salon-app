<?php

namespace Model;

class ApointmentsServices extends ActiveRecord {
    protected static $table = 'apointmentsservices';
    protected static $DBColumns = ['id', 'apointmentId', 'serviceId'];

    public $id;
    public $apointmentId;
    public $serviceId;

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? null;
        $this->apointmentId = $args['apointmentId'] ?? '';
        $this->serviceId = $args['serviceId'] ?? '';   
    }
}