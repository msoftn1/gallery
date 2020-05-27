<?php

class Db
{
    private static ?Db $db = null;

    private PDO $dbh;

    public static function getInstance()
    {
        if(!self::$db) {
            self::$db = new static();
            self::$db->connect();
        }

        return self::$db;
    }

    private function connect()
    {
        $this->dbh = new PDO(Config::DB_DSN, Config::DB_USER, Config::DB_PASSWORD);
    }

    public function select(string $sql)
    {
        $list = [];

        foreach ($this->dbh->query($sql) as $row) {
            $list[] = $row;
        }

        return $list;
    }

    public function selectWithParameters(string $sql, array $parameters)
    {
        $list = [];

        $sth = $this->dbh->prepare($sql);
        $sth->execute($parameters);

        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            $list[] = $row;
        }

        return $list;
    }
}
