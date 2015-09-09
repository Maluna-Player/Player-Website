<?php

class User
{
    private $login;

    private $mail;

    private $admin;


    public function __construct($userId)
    {
        $pdo = DbConnection::getPDO();

        $request = $pdo->prepare('SELECT * FROM member WHERE idMember = ?');
        $request->execute(array($userId));

        if ($data = $request->fetch())
        {
            $this->login = $data['login'];
            $this->mail = $data['mail'];
            $this->admin = $data['admin'];
        }

        $request->closeCursor();
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function isAdmin()
    {
        return $this->admin;
    }

    public function setMail($newMail)
    {
        if (preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $newMail))
        {
            $pdo = DbConnection::getPDO();

            $request = $pdo->prepare('UPDATE member SET mail = :newMail WHERE login = :login');
            $request->execute(array(':newMail' => $newMail,
                                    ':login' => $this->login));

            $this->mail = $newMail;
        }
    }

    public function sendMail($object, $message)
    {
        mail($this->mail, $object, $message);
    }

    /**
     * @param login Pseudo de l'utilisateur recherché
     * @return Champs de l'utilisateur correspondant au login envoyé, false s'il n'existe pas
     */
    public static function getUserRowFromLogin($login)
    {
        $pdo = DbConnection::getPDO();

        $request = $pdo->prepare('SELECT * FROM member WHERE login = ?');
        $request->execute(array($login));

        $row = $request->fetch();
        $request->closeCursor();

        return $row;
    }

    /**
     * @return Identifiant de l'utilisateur ajouté
     */
    public static function addUser($login, $password, $mail)
    {
        $pdo = DbConnection::getPDO();

        $request = $pdo->prepare('INSERT INTO member(login, password, mail, registrationDate, admin)
                                  VALUES(:login, :password, :mail, NOW(), 0)');
        $request->execute(array(':login' => $login,
                                ':password' => $password,
                                ':mail' => $mail));
    
        return $pdo->lastInsertId();
    }
}
