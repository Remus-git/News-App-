<?php
    namespace Libs\Database;
    use PDOException;

    class UsersTable
    {
        private $db = null;

        public function __construct(MySQL $db)
        {
            $this->db = $db->connect();
        }

        public function insert($data)
        {
            try{
                $query = "
                    INSERT INTO users (
                        name,email,phone,password,created_at
                    )VALUES(
                        :name, :email, :phone, :password ,NOW()
                    )
                ";

                $statement=$this->db->prepare($query);
                $statement->execute($data);

                return $this->db->lastInsertId();
            }catch(PDOException $e)
            {
                return $e->getMessage();
            }
        }
        public function findEmailAndPassword($email,$password)
        {
            try{
                $statement = $this->db->prepare("
                    SELECT users.* FROM users WHERE users.email = :email AND users.password = :password
                ");
                $statement->execute([
                    ':email' => $email,
                    ':password'=> $password
                ]
                );

                $row = $statement->fetchAll();
                return $row ?? false;
            }catch(PDOException $e){
                $e->getMessage();
            }
            
        }
        public function updateUserProfile($updateName,$updateAbout,$updatePhone,$updateEmail,$matchUserId,$updatePhoto){
            try{
                $statement = $this->db->prepare("
                    UPDATE users SET users.name = :updateName , users.about = :updateAbout, users.phone = :updatePhone , users.email = :updateEmail , users.photo = :updatePhoto
                    WHERE users.id = :matchUserId;
                ");
                    $updated =$statement->execute([
                        ':updateName'  => $updateName,
                        ':updateAbout' => $updateAbout,
                        ':updatePhone' => $updatePhone,
                        ':updateEmail' => $updateEmail,
                        ':matchUserId' => $matchUserId,
                        ':updatePhoto' => $updatePhoto
                    ]);
                    if($updated){
                        $statement = $this->db->prepare("
                            SELECT users.* FROM users WHERE users.id = :matchUserId;
                        ");
                        $statement->execute([
                            ':matchUserId' => $matchUserId
                        ]);
                    }
                    $updatedProfile = $statement->fetchAll();
                    return $updatedProfile;
                    
                
            }catch(PDOException $e){
                $e->getMessage();
            }
        }
    }    