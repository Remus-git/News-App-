<?php 
    namespace Libs\Database;
    use PDOException;
    
    class likesTable{
        private $db=null;
        public function __construct(MYSQL $db)
        {
            $this->db = $db->connect();
        }
        
        public function insert($postId,$userId){
            try{    $statement = $this->db->prepare("
                    INSERT into likes(post_id,user_id)
                    VALUES(:post_id,:user_id)
                ");
                $statement->execute([
                    ':post_id' => $postId,
                    ':user_id'=>$userId
                ]);
            }
            catch(PDOException $e){
                $e->getMessage();
            }
        }
        public function getLikes(){
            try{
                $statement = $this->db->prepare("
                    SELECT * FROM likes
                ");
                $statement->execute();
                return $statement->fetchAll();
            }
            catch(PDOException $e){
                $e->getMessage();
            }
        }
    }