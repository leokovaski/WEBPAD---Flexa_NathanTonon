<?php

class Banco
{
    private static $DB_NAME = 'webpad';
    private static $DB_SERVER = 'localhost';
    private static $DB_USERNAME = 'webpad';
    private static $DB_PASSWORD = '123';
    
    private static $cont = null;
    private $result;

    public function __construct() 
    {
        die('A função Init nao é permitido!');
    }
    
    public static function conectar()
    {
        if(null == self::$cont)
        {
            try
            {
                self::$cont =  new PDO( "mysql:host=".self::$DB_SERVER.";"."dbname=".self::$DB_NAME, self::$DB_USERNAME, self::$DB_PASSWORD); 
            }
            catch(PDOException $exception)
            {
                die($exception->getMessage());
            }
        }
        return self::$cont;
    }
    public static function query($sql){
        $conn = mysql_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD);
        mysql_select_db($DB_NAME,$conn);
        $this->result = mysql_query($sql,$conn);
        mysql_close($conn);
    }

    public function getResult(){
        return $this->result;
    }

    public static function desconectar()
    {
        self::$cont = null;
    }
}
?>
