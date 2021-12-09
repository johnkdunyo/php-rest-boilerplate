<?php 

class Post {
    private $conn;
    private $table = 'posts';

    //post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;



    //constructor
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        //create read query
        $query = 'SELECT 
        c.name as category_name,
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.created_at
        FROM     
         ' . $this->table . ' p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC';

         //prepared statement
         $stmt = $this->conn->prepare($query);

         $stmt->execute();

         return $stmt;

    }





    //get single post
    public function read_single(){

        //create read query
        $query = 'SELECT 
        c.name as category_name,
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.created_at
        FROM     
         ' . $this->table . ' p LEFT JOIN categories c ON p.category_id = c.id
         WHERE p.id = ? LIMIT 0,1
         ';

         //prepared statement
         $stmt = $this->conn->prepare($query);

         //bind id

         $stmt->bindParam(1, $this->id);

         $stmt->execute();

         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         $this->title = $row['title'];
         $this->body =$row['body'];
         $this->author =$row['author'];
         $this->category_id =$row['category_id'];
         $this->category_name =$row['category_name'];

        

    }



    //create a post
    public function create(){

        //query
        $query= '
        INSERT into ' . $this->table . ' 
        SET 
            title = :title,
            body =:body,
            author = :author,
            category_id = :category_id 
        ';


        //prepare stament
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));


        //bind named parameters
        $stmt->bindParam(':title' , $this->title);
        $stmt->bindParam(':body' , $this->body);
        $stmt->bindParam(':author' , $this->author);
        $stmt->bindParam(':category_id' , $this->category_id);
        

        //execute query
        if($stmt->execute()){
            return true;
            printf('Error: %s.\n', $stmt->error);
        } else {
            return false;
        } 

    }





        //create a post

        public function update(){

            //query
            $query= '
            UPDATE ' . $this->table . ' 
            SET 
                title = :title,
                body =:body,
                author = :author,
                category_id = :category_id 
            WHERE
                id = :id
            ';
    
    
            //prepare stament
            $stmt = $this->conn->prepare($query);
    
            //clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));
    
    
            //bind named parameters
            $stmt->bindParam(':title' , $this->title);
            $stmt->bindParam(':body' , $this->body);
            $stmt->bindParam(':author' , $this->author);
            $stmt->bindParam(':category_id' , $this->category_id);
            $stmt->bindParam(':id' , $this->id);
            
    
            //execute query
            if($stmt->execute()){
                return true;
            } else {
                return false;
                printf('Error: %s.\n', $stmt->error);
            } 
    
            
    
    
        }




        public function delete(){
            $query = '
            DELETE from ' . $this->table . ' 
            WHERE id = :id
            ';

            $stmt = $this->conn->prepare($query);

            //lets clean the data
            $this->id = htmlspecialchars(strip_tags($this->id));

            //bind names paramerters

            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()){
                return true;
            } else {
                return false;
            }

        }




}




?>