<?php 
    namespace Libs\Database;
    use PDOException;
    
    class commentsTable{
        private $db = null;
        public function __construct(MySQL $db){
            $this->db = $db->connect();    
        }
        public function insert($data){
            try{
                $query = "
                        INSERT INTO comments(user_id,post_id,content,created_at)
                        VALUES (:userId,:postId,:content,NOW())
                ";
                $statement = $this->db->prepare($query);
                $statement->execute($data);
                return $this->db->lastInsertId();
            }catch(PDOException $e){
                $e->getMessage();
            }
            
        }
        public function getComment(){
            try{
                $query = "
                            SELECT comments.*,users.*,posts.id FROM comments JOIN users ON users.id = comments.user_id JOIN posts ON posts.id = comments.post_id
                ";
                $statement = $this->db->prepare($query);
                $statement->execute();
                return $statement->fetchAll();
            }
            catch(PDOException $e){
                $e->getMessage();
            }
        }
    
    }