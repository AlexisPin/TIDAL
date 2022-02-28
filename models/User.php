<?php

class User
{
    private $conn;
    private $table = 'users';

    public $userid;
    public $username;
    public $email;
    public $useruniqueid;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table;

        $sql = $this->conn->prepare($query);

        $sql->execute();

        $sql->setFetchMode(PDO::FETCH_CLASS, 'User');

        return $sql;
    }

    public function read_single()
    {
        $query = 'SELECT * FROM ' . $this->table . ' u WHERE u.userid = :id';

        $sql = $this->conn->prepare($query);

        $sql->bindParam(':id', $this->userid);

        $sql->execute();

        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->userid = $row['userid'];
            $this->username = $row['username'];
            $this->email = $row['email'];
            $this->useruniqueid = $row['useruniqueid'];
            $this->password = $row['password'];
        }

        return $row;
    }

    public function create()
    {

        $query = "SELECT * FROM users WHERE email=:email";
        $sql = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $sql->bindParam(':email', $this->email);
        $sql->execute();

        $userIsExist = $sql->fetch();
        if ($userIsExist) {
            return false;
        } else {

            $query = 'INSERT INTO ' . $this->table . ' SET username = :username, email = :email, useruniqueid = :useruniqueid, password = :password';
            $sql = $this->conn->prepare($query);

            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->useruniqueid = htmlspecialchars(strip_tags($this->useruniqueid));
            $this->password = htmlspecialchars(strip_tags($this->password));

            $sql->bindParam(':username', $this->username);
            $sql->bindParam(':email', $this->email);
            $sql->bindParam(':useruniqueid', $this->useruniqueid);
            $sql->bindParam(':password', $this->password);


            if ($sql->execute()) {
                return true;
            };

            printf("Error : %s \n", $sql->error);
            return false;
        }
    }

    public function update()
    {
        $query = 'UPDATE ' . $this->table . '
                              SET username = :username, email = :email, password = :password
                              WHERE userid = :id';

        $sql = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->useruniqueid = htmlspecialchars(strip_tags($this->useruniqueid));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->userid = htmlspecialchars(strip_tags($this->userid));

        $sql->bindParam(':username', $this->username);
        $sql->bindParam(':email', $this->email);
        $sql->bindParam(':password', $this->password);
        $sql->bindParam(':id', $this->userid);

        if ($sql->execute()) {
            return true;
        };

        printf("Error : %s \n", $sql->error);
        return false;
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE userid = :id';
        $sql = $this->conn->prepare($query);
        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $sql->bindParam(':id', $this->userid);

        if ($sql->execute()) {
            return true;
        };

        printf("Error : %s \n", $sql->error);
        return false;
    }
}
