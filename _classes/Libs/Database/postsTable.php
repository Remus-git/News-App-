<?php
    namespace Libs\Database;
    use PDOException;
    use Helpers\HTTP;

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
                    user_id,title,content,category_id,post_photo,created_at
                )VALUES(:userId,:title,:content,:category,:photo,NOW())
                ";
                $statement = $this->db->prepare($query);
                $statement->execute($data);
                return $this->db->lastInsertId();
            }catch(PDOException $e){
                $e -> getMessage();
            }
        }
        public function getAll($category_id){
            try{
                $statement = $this->db->prepare("
                    SELECT posts.*,users.name,users.photo FROM posts LEFT JOIN users ON users.id = posts.user_id WHERE posts.category_id = :category_id ORDER BY id DESC 
                ");
                $statement->execute([
                    ':category_id' => $category_id
                ]);
                return $statement->fetchAll();
                
            }catch(PDOException $e){
                $e->getMessage();
            }
        }
        public function allTopics(){
            try{
                $statement = $this->db->prepare("
                SELECT posts.*,users.name,users.photo FROM posts LEFT JOIN users ON users.id = posts.user_id ORDER BY id DESC 
                ");
                $statement->execute();
                return $statement->fetchAll();
            }
            catch(PDOException $e){
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
        public function getPost($auth_id){
            try{
                $statement = $this->db->prepare("
                    SELECT posts.*,users.id FROM posts RIGHT JOIN users ON posts.user_id = users.id WHERE users.id = :auth_id;
                ");
                $statement->execute([
                    ':auth_id'=>$auth_id
                ]);
                return $statement->fetchAll();
            }
            catch(PDOException $e){
                $e->getMessage();
            }
        }
        // public function getIndividualPost($auth_id,$category_id){
        //     try{
        //         $statement = $this->db->prepare("
                
        //         ");
        //         $statement->execute([
        //             ':auth_id'=> $auth_id,
        //             ':category_id'=>$category_id
        //         ]);
        //     }
        //     catch(PDOException $e){
        //         $e->getMessage();
        //     }
        // }
    }