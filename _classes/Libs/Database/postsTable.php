<?php
    namespace Libs\Database;
    use PDOException;

    class postsTable{
        private $db = null;
        public function __construct(MySQL $db)
        {
            $this->db = $db->connect();
        }

        public function insert($data){
            try{
                $query = " 
                INSERT INTO posts(
                    user_id,title,content,category,post_photo,created_at
                )VALUES(:userId,:title,:content,:category,:photo,NOW())
                ";
                $statement = $this->db->prepare($query);
                $statement->execute($data);
                return $this->db->lastInsertId();
            }catch(PDOException $e){
                $e -> getMessage();
            }
        }
        public function getAll(){
            try{
                $statement = $this->db->prepare("
                    SELECT posts.*,users.name,users.photo FROM posts LEFT JOIN users ON users.id = posts.user_id ORDER BY id DESC
                ");
                $statement->execute();
                return $statement->fetchAll();
            }catch(PDOException $e){
                $e->getMessage();
            }
        }
        public function individualPost($post_id){
            try{
                $statement = $this->db->prepare("
                    SELECT posts.*,users.name,users.photo FROM posts LEFT JOIN users ON posts.id = :post_id
                ");
                $statement->execute([
                    ':post_id'=>$post_id
                ]);
                return $statement->fetch();
            }catch(PDOException $e){

            }
        }
    }