<?php

namespace App\Models;

use Core\Storage\BaseModel;
use Exception;

/**
 * user model
 */
class User extends BaseModel
{
    protected $_username;
    protected $_email;
    protected $_salt;
    protected $_password;
    protected $_active;
    
    
    /**
          * 
          * @param string $string
          * @return type
          */
    public function generateRandomHash(string $string)
    {
        return md5(time() . rand(1000, 10000) . $this->_salt . $string);
    }
    
    
    /**
          * find item by id
          * 
          * @param int $id
          */
    public function find(int $id)
    {
        $sql = 'SELECT id, username, email, salt, password, active FROM users WHERE id = :id';
        
        $stmt = $this->_conn->prepare($sql);
        $stmt->bindValue(':id', $id, SQLITE3_TEXT);
        $result = $stmt->execute();

        $userData = $result->fetchArray(SQLITE3_ASSOC);
        
        if (!empty($userData)) {
            $this->_id       = $userData['id'];
            $this->_username = $userData['username'];
            $this->_email    = $userData['email'];
            $this->_salt     = $userData['salt'];
            $this->_password = $userData['password'];
            $this->_active   = $userData['active'];
        } else {
            return false;
        }
        
        return true;
    }
    
    
    /**
          * find item by id
          * 
          * @param string $email
          */
    public function findByEmail(string $email)
    {
        $sql = 'SELECT id, username, email, salt, password, active FROM users WHERE email = :email';
        
        $stmt = $this->_conn->prepare($sql);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute();

        $userData = $result->fetchArray(SQLITE3_ASSOC);
        
        if (!empty($userData)) {
            $this->_id       = $userData['id'];
            $this->_username = $userData['username'];
            $this->_email    = $userData['email'];
            $this->_salt     = $userData['salt'];
            $this->_password = $userData['password'];
            $this->_active   = $userData['active'];
        } else {
            return false;
        }
        
        return true;
    }
    
    
    /**
          * check pass
          * @param string $md5
          * @return type
          */
    public function isActive()
    {
        return (bool) $this->_active;
    }
    
    
    /**
          * check pass
          * @param string $password
          * @return type
          */
    public function checkPass(string $password)
    {
        return $this->_password == md5($this->_salt . $password);
    }
    
    
    /**
          * username
          */
    public function username()
    {
        return $this->_username;
    }
    
    
    /**
          * username
          */
    public function email()
    {
        return $this->_email;
    }
    
    
    /**
          * create new item
          *
          * @param array $attributes
          */
    public function create(array $attributes)
    {
        if (empty($attributes['username'])) {
            throw new Exception("Empty username parameter");
        }
        
        if (empty($attributes['email'])) {
            throw new Exception("Empty email parameter");
        }
        
        if (empty($attributes['password'])) {
            throw new Exception("Empty password parameter");
        }
        
        $username = $attributes['username'];
        $email = $attributes['email'];
        $password = $attributes['password'];
        
        $sql = "INSERT INTO users (username, email, salt, password, active) VALUES (:username, :email, :salt, :password, :active)";
        
        $this->_conn->exec('BEGIN');
        
        $salt = md5(time() . rand(1000, 10000) . 'salt' . $email);
        $passwordHash = md5($salt . $password);
        $active = 0;
        
        $stmt = $this->_conn->prepare($sql);
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':salt', $salt, SQLITE3_TEXT);
        $stmt->bindValue(':password', $passwordHash, SQLITE3_TEXT);
        $stmt->bindValue(':active', $active, SQLITE3_INTEGER);
        $stmt->execute();
        
        $this->_conn->exec('COMMIT');
        
        $this->_id       = $this->_conn->exec('SELECT last_insert_rowid()');
        $this->_username = $username;
        $this->_email    = $email;
        $this->_salt     = $salt;
        $this->_password = $passwordHash;
        $this->_active   = $active;
        
        return true;
    }

    
    /**
          * update username item
          *
          * @param string $username
          */
    public function updateUsername(string $username)
    {
        if (empty($this->_id)) {
            throw new Exception("Empty id");
        }
        
        $sql = "UPDATE users SET username = :username WHERE id = :id";
        
        $this->_conn->exec('BEGIN');
        
        $stmt = $this->_conn->prepare($sql);
        $stmt->bindValue(':id', $this->_id, SQLITE3_INTEGER);
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->execute();
        
        $this->_conn->exec('COMMIT');
        
        $this->_username = $username;
        
        return true;
    }
    
    
    /**
          * update email item
          *
          * @param string $email
          */
    public function updateEmail(string $email)
    {
        if (empty($this->_id)) {
            throw new Exception("Empty id");
        }
        
        $sql = "UPDATE users SET email = :email WHERE id = :id";
        
        $this->_conn->exec('BEGIN');
        
        $stmt = $this->_conn->prepare($sql);
        $stmt->bindValue(':id', $this->_id, SQLITE3_INTEGER);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->execute();
        
        $this->_conn->exec('COMMIT');
        
        $this->_email = $email;
        
        return true;
    }
    
    
    /**
          * update password item
          *
          * @param string $password
          */
    public function updatePassword(string $password)
    {
        if (empty($this->_id)) {
            throw new Exception("Empty id");
        }
        
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        
        $this->_conn->exec('BEGIN');
        
        $stmt = $this->_conn->prepare($sql);
        $stmt->bindValue(':id', $this->_id, SQLITE3_INTEGER);
        $stmt->bindValue(':password', md5($this->_salt . $password), SQLITE3_TEXT);
        $stmt->execute();
        
        $this->_conn->exec('COMMIT');
        
        $this->_password = md5($this->_salt . $password);
        
        return true;
    }

    
    /**
          * init activation for user
          */
    public function initActivation()
    {
        // clean activation if it exists
        $sql = "DELETE FROM users_activations WHERE user_id = :user_id";
        $this->_conn->exec('BEGIN');
        $stmt = $this->_conn->prepare($sql);
        $stmt->bindValue(':user_id', $this->_id, SQLITE3_INTEGER);
        $stmt->execute();
        $this->_conn->exec('COMMIT');
            
        // add new activation
        $sql = "INSERT INTO users_activations (user_id, hash, life_until) VALUES (:user_id, :hash, :life_until)";
        
        $hash = $this->generateRandomHash($this->_email);
        
        $life_until = strtotime(date("Y-m-d H:i:s", time() + 86400)); // add 1 day
        
        $this->_conn->exec('BEGIN');
        $stmt = $this->_conn->prepare($sql);
        $stmt->bindValue(':user_id', $this->_id, SQLITE3_INTEGER);
        $stmt->bindValue(':hash', $hash, SQLITE3_TEXT);
        $stmt->bindValue(':life_until', $life_until, SQLITE3_TEXT);
        $stmt->execute();
        $this->_conn->exec('COMMIT');
        
        return $hash;
    }
    
    
    /**
          * activate user
          * 
          * @param string $hash
          */
    public function activate(string $hash)
    {
        $sql = 'SELECT id, user_id, hash, life_until FROM users_activations WHERE hash = :hash';
        $stmt = $this->_conn->prepare($sql);
        $stmt->bindValue(':hash', $hash, SQLITE3_TEXT);
        $result = $stmt->execute();
        $userData = $result->fetchArray(SQLITE3_ASSOC);
        
        if (empty($userData)) {
            // activation is not found - do nothing and return false
            $result = false;
        } else if ($userData['life_until'] < time()) {
            // activation is too old - clean and return false
            $sql = "DELETE FROM users_activations WHERE hash = :hash";
            $this->_conn->exec('BEGIN');
            $stmt = $this->_conn->prepare($sql);
            $stmt->bindValue(':hash', $hash, SQLITE3_TEXT);
            $stmt->execute();
            $this->_conn->exec('COMMIT');
            
            $result = false;
        } else if ($userData['life_until'] >= time()) {
            // activation is OK- activate user, clean activation and return true
            
            // activate user
            $sql = "UPDATE users SET active = 1 WHERE id = :id";
            $this->_conn->exec('BEGIN');
            $stmt = $this->_conn->prepare($sql);
            $stmt->bindValue(':id', $userData['user_id'], SQLITE3_INTEGER);
            $stmt->execute();
            $this->_conn->exec('COMMIT');
            
            // clean activation
            $sql = "DELETE FROM users_activations WHERE hash = :hash";
            $this->_conn->exec('BEGIN');
            $stmt = $this->_conn->prepare($sql);
            $stmt->bindValue(':hash', $hash, SQLITE3_TEXT);
            $stmt->execute();
            $this->_conn->exec('COMMIT');
            
            $result = true;
        } else {
            // formal case - clean and return false
            $result = false;
        }
        
        return $result;
    }
    
    
    /**
          * init reset password for user
          */
    public function initResetPassword()
    {
        // clean reset password
        $sql = "DELETE FROM reset_paswords WHERE user_id = :user_id";
        $this->_conn->exec('BEGIN');
        $stmt = $this->_conn->prepare($sql);
        $stmt->bindValue(':user_id', $this->_id, SQLITE3_INTEGER);
        $stmt->execute();
        $this->_conn->exec('COMMIT');
            
        // add new reset password
        $sql = "INSERT INTO reset_paswords (user_id, hash, life_until) VALUES (:user_id, :hash, :life_until)";
        
        $hash = $this->generateRandomHash($this->_email);
        $life_until = strtotime(date("Y-m-d H:i:s", time() + 86400)); // add 1 day
        
        $this->_conn->exec('BEGIN');
        $stmt = $this->_conn->prepare($sql);
        $stmt->bindValue(':user_id', $this->_id, SQLITE3_INTEGER);
        $stmt->bindValue(':hash', $hash, SQLITE3_TEXT);
        $stmt->bindValue(':life_until', $life_until, SQLITE3_TEXT);
        $stmt->execute();
        $this->_conn->exec('COMMIT');
        
        return $hash;
    }
    
    
    /**
          * reset password
          * 
          * @param string $hash
          * @param string $oldPassword
          * @param string $newPassword
          */
    public function resetPassword(string $hash, string $oldPassword, string $newPassword)
    {
        $sql = 'SELECT id, user_id, hash, life_until FROM reset_paswords WHERE hash = :hash';
        $stmt = $this->_conn->prepare($sql);
        $stmt->bindValue(':hash', $hash, SQLITE3_TEXT);
        $result = $stmt->execute();
        $userData = $result->fetchArray(SQLITE3_ASSOC);
        
        if (empty($userData)) {
            // reset is not found - do nothing and return false
            $result = false;
        } else if ($userData['life_until'] < time()) {
            // reset is too old - clean and return false
            $sql = "DELETE FROM reset_paswords WHERE hash = :hash";
            $this->_conn->exec('BEGIN');
            $stmt = $this->_conn->prepare($sql);
            $stmt->bindValue(':hash', $hash, SQLITE3_TEXT);
            $stmt->execute();
            $this->_conn->exec('COMMIT');
            
            $result = false;
        } else if ($userData['life_until'] >= time()) {
            // reset is OK- check pass (return false if it is not), reset pass and return true
            $this->find($userData['user_id']);
            if (!$this->checkPass($oldPassword)) {
                return false;
            }
            
            // reset password
            $passwordHash = md5($this->_salt . $newPassword);
            $sql = "UPDATE users SET password = :password WHERE id = :id";
            $this->_conn->exec('BEGIN');
            $stmt = $this->_conn->prepare($sql);
            $stmt->bindValue(':id', $userData['user_id'], SQLITE3_INTEGER);
            $stmt->bindValue(':password', $passwordHash, SQLITE3_TEXT);
            $stmt->execute();
            $this->_conn->exec('COMMIT');
            
            // clean reset password
            $sql = "DELETE FROM users_activations WHERE hash = :hash";
            $this->_conn->exec('BEGIN');
            $stmt = $this->_conn->prepare($sql);
            $stmt->bindValue(':hash', $hash, SQLITE3_TEXT);
            $stmt->execute();
            $this->_conn->exec('COMMIT');
            
            $result = true;
        } else {
            // formal case - clean and return false
            $result = false;
        }
        
        return $result;
    }
}
