<?php

include_once 'LogApp.php';
include_once 'LoggedOffException.php';

class DataHelper {
    
    private $id;
    private $email;
    private $role;
    private $pgsql;
    
    
    function __construct()
    {
        $this->initMembers();
    } 
    
    function getAdminUsersInfo() {
        
        $stmt = '';
        $row = '';
        
        try {
            $stmt = $this->getStatement(self::getAdminUsersSql());
            $stmt->execute();
            print "<div class='boxes'>";
            while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                $id = $row[0];
                $email =  $row[1];
                $isRegularUser = ($row[2] != 0);
                $checked = (!((bool)$isRegularUser) ? 'checked' : '');
                $check = "<input class=admin disabled=true name=$id type='checkbox' $checked value=$isRegularUser>";
                print '<tr><td>' . $id . '<td>' . $email . '<td>' . $check . '<td> ' . '</tr>';
            }
            print "</div>";
        }
        catch (Exception $e) {
            print "<pre>DataHelper:__constructor(): " . $e->getMessage() . "</pre>";
            die();
        }
        
    }
    
    function getUserInfo($sentEmail) {
                
        try {
            
            $stmt = $this->getStatement(self::getLoginSql());
            
            $stmt->bindValue(1, $sentEmail, PDO::PARAM_STR);
            
            $stmt->execute();
            
            $row=$stmt->fetch(PDO::FETCH_NUM);
            
            if ($row == FALSE) {
                throw new LoggedOffException();
            }
            else {
                
                $this->id = $row[0];
                $this->email = $row[1];
                $this->role = $row[2];
            }
            
        } 
        catch (LoggedOffException $e) {
            throw $e;
        }
        catch (PDOException $e) {
            print "Error connecting to database";
            die();
        }
        catch (Exception $e) {
            print '<pre>DataHelper:__constructor($string): ' . $e->getMessage() . '</pre>';
            die();
        }
    }
    
    private function getDbConnectionString() {
        return 'pgsql:dbname=' . LogApp::$dbName . ';host=' . LogApp::$dbServer;
    }
    
    private function getLoginSql() {
        return 'SELECT id, email, role FROM users where email = ?;';
    }
    
    private function getAdminUsersSql() {
        return 'SELECT id, email, role FROM users;';
    }
    
    public function getEmail()  {
        return $this->email;
    }
    
    public function getRole() {
        return $this->role;
    }
    
    public function getId() {
        return $this->id;
    }
    
    private function setPDOObject() {
        if (empty($this->pgsql))
            $this->pgsql = new PDO( self::getDbConnectionString(),
            LogApp::$appUser, LogApp::$dbPW );
    }
    
    private function initMembers() {
        $pgsql = '';
        $email = '';
        $id = 0;
        $role = 1;
    }
    
    private function getStatement($statement) {
        // Must call getPDOObject before calling
        if ( empty($pgsql) ) 
            $this->setPDOObject();
        return $this->pgsql->prepare($statement);
    }
}
?>