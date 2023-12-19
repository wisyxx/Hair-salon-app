<?php
namespace Model;

class ActiveRecord {

    // DB
    protected static $db;
    protected static $table = '';
    protected static $columnsDB = [];

    protected static $alerts = [];
    
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlert($type, $message) {
        static::$alerts[$type][] = $message;
    }

    /* VALIDATION */
    public static function getAlerts() {
        return static::$alerts;
    }

    public function validate() {
        static::$alerts = [];
        return static::$alerts;
    }

    public static function queryDB($query) {
        $result = self::$db->query($query);

        $array = [];
        while($record = $result->fetch_assoc()) {
            $array[] = static::createObject($record);
        }

        $result->free();

        return $array;
    }

    protected static function createObject($record) {
        $obj = new static;

        foreach($record as $key => $value ) {
            if(property_exists( $obj, $key  )) {
                $obj->$key = $value;
            }
        }

        return $obj;
    }

    public function atributes() {
        $atributes = [];
        foreach(static::$columnsDB as $column) {
            if($column === 'id') continue;
            $atributes[$column] = $this->$column;
        }
        return $atributes;
    }

    public function sanitizeAtributes() {
        $atributes = $this->atributes();
        $sanitized = [];
        foreach($atributes as $key => $value ) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    // Sync BD with objects in memory
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    /* Records - CRUD */
    public function save() {
        $result = '';

        if(!is_null($this->id)) {
            $result = $this->update();
        } else {
            $result = $this->create();
        }
        return $result;
    }

    public static function all() {
        $query = "SELECT * FROM " . static::$table;
        $result = self::queryDB($query);
        return $result;
    }

    public static function find($id) {
        $query = "SELECT * FROM " . static::$table  ." WHERE id = $id";
        $result = self::queryDB($query);
        return array_shift( $result ) ;
    }

    public static function get($limit) {
        $query = "SELECT * FROM " . static::$table . " LIMIT $limit";
        $result = self::queryDB($query);
        return array_shift( $result ) ;
    }

    // crea un nuevo registro
    public function create() {
        $atributes = $this->sanitizeAtributes();

        $query = " INSERT INTO " . static::$table . " ( ";
        $query .= join(', ', array_keys($atributes));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributes));
        $query .= " ') ";

        $result = self::$db->query($query);
        return [
           'result' =>  $result,
           'id' => self::$db->insert_id
        ];
    }

    public function update() {
        $atributes = $this->sanitizeAtributes();

        $values = [];
        foreach($atributes as $key => $value) {
            $values[] = "$key='$value'";
        }

        $query = "UPDATE " . static::$table ." SET ";
        $query .=  join(', ', $values );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        // update
        $result = self::$db->query($query);
        return $result;
    }

    public function delete() {
        $query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $result = self::$db->query($query);
        return $result;
    }

}