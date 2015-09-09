<?php

class Contribution
{
    private $title;

    private $content;

    private $author;

    private $sendingDate;

    private $sendingTime;


    public function __construct($contributionId)
    {
        $pdo = DbConnection::getPDO();

        $request = $pdo->prepare('SELECT title, content, author,
                                    DATE_FORMAT(sendingDate, \'%d/%m/%Y\') AS date,
                                    DATE_FORMAT(sendingDate, \'%H:%i:%s\') AS time
                                    FROM contribution WHERE idContribution = ?');
        $request->execute(array($contributionId));

        if ($data = $request->fetch())
        {
            $this->title = $data['login'];
            $this->content = $data['content'];
            $this->author = $data['author'];
            $this->sendingDate = $data['date'];
            $this->sendingTime = $data['time'];
        }

        $request->closeCursor();
    }

    public static function getContributions($page, $limit)
    {
        $pdo = DbConnection::getPDO();

        $page = (int) $page;
        $limit = (int) $limit;
        $offset = ($page - 1) * 10;

        $request = $pdo->prepare('SELECT title, content, author,
                                    DATE_FORMAT(sendingDate, \'%d/%m/%Y\') AS date,
                                    DATE_FORMAT(sendingDate, \'%H:%i:%s\') AS time
                                    FROM contribution ORDER BY sendingDate DESC
                                    LIMIT :offset, :limit');

        $request->bindParam(':offset', $offset, PDO::PARAM_INT);
        $request->bindParam(':limit', $limit, PDO::PARAM_INT);
        $request->execute();

        $contributions = $request->fetchAll();

        $request->closeCursor();

        return $contributions;
    }

    public static function count()
    {
        $pdo = DbConnection::getPDO();

        $request = $pdo->query('SELECT COUNT(*) AS contribution_nb FROM contribution');
        $data = $request->fetch();

        $request->closeCursor();

        return $data['contribution_nb'];
    }

    /**
     * @return Identifiant de la contribution ajoutée
     */
    public static function addContribution($title, $content, $author)
    {
        $pdo = DbConnection::getPDO();

        $request = $pdo->prepare('INSERT INTO contribution(title, content, author, sendingDate) VALUES(:title, :content, :author, NOW())');
        $request->execute(array(':title' => $title,
                                ':content' => $content,
                                ':author' => $author));

        return $pdo->lastInsertId();
    }
}
