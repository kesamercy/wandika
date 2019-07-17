<?php
    interface blogPost{
        public function set_blog_post($user_id, $written_post);
        public function get_blog_post($user_id, $post_id);
        public function delete_post($user, $post_id);
        public function set_comment($post_id);
        public function set_tip($post_id);
        public function get_tag_count($post_id);
    }

    class wandikaBlogPost implements blogPost{
        //Variables
        $servername = "Local instance MySQL80";
        $username = "root";
        $password = "password";
        $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
        /**
         * Function that accepts a written post from an html form and associates it with the specified user_id.
         * The function will take the necessary parts of a post and input them into the sql database. Uses PDO and
         * prepared statements.
         * @Param: $user_id: the user_id associated with the post. This is a unique key.
         *         $written_post: the text post that will be inserted into the database.
         */
        public function set_blog_post($user_id, $written_post){
            //combine under one insert
            //match user name
            $stmt = $conn->prepare("INSERT INTO posts (user_id, title, post, genre, `date`, time_to_read)
            VALUES(:user_id, :title, :post, :genre, :`data`, :time_to_read)");
            $stmt->bindParam(`:user_id`, $user_id);
            $stmt->bindParam(`:title`, $title);
            $stmt->bindParam(`:post`, $post);
            $stmt->bindParam(`:genre`, $genre);
            $stmt->bindParam(`:date`, $date);
            $stmt->bindParam(`:time_to_read`, $time_to_read);
            $user = "SELECT user_id FROM user WHERE user_id==$user_id";
            
            //retrieve title from title input and store in title column
            //not secure need to add prepared statement. 
            $blog_title = $_POST['title'];
           

            //retrieve the blog post from parameter and store in post column
           

            //retrieve the genre from genre form and store in genre column
            //not secure need to add prepared statement. remove html tags
            $genre = $_POST['genre'];
            
            
            //insert date into date field using php DATE
            $date = date('l jS \of F Y h:i:s A');
           
            
            //retrieve the estimated time to read from time_to_read form and insert into time_to_read column.
            $time_to_read = $_POST['time_to_read'];
          
            //insert into table posts
            $sql = "INSERT INTO posts (user_id, title, post, genre, `date`, time_to_read) VALUES ($user_id, $blog_title, $written_post, $genre, $date, $time_to_read)";
            $stmt->execute();

            echo "New post created successfully.";
        }

        public function get_blog_post($user_id, $post_id){
            //match user name
            $sql = "SELECT post FROM posts WHERE user_id=$user_id AND post_id=$post_id";
            return $sql;

        }

        public function delete_post($user_id, $post_id){
            $postdel = "DELETE FROM `posts` WHERE `post_id` = $post_id AND `user_id` = $user_id";
        }

        public function set_tip($post_id){
            
            $stmt = $conn->prepare("INSERT INTO tips (user_id, tip, genre, `date`)
            VALUES(:user_id, :post, :genre, :`data`);
            $stmt->bindParam(`:user_id`, $user_id);
            $stmt->bindParam(`:tip`, $tip);
            $stmt->bindParam(`:genre`, $genre);
            $stmt->bindParam(`:date`, $date);
            
            $user = "SELECT user_id FROM user WHERE user_id==$user_id";
            $tip = $_POST['tip'];
            $genre = $_POST['genre'];
            $date = date('l jS \of F Y h:i:s A');
          
            //insert into table posts
            $sql = "INSERT INTO tips (user_id, tip, genre, `date`) VALUES ($user_id, $tip, $genre, $date)";
            $stmt->execute();

            echo "New tip created successfully.";
        }
        
        public function get_tag_count($post_id){
            $count = SELECT COUNT (IF(tip="This touched me."), 1, NULL)) "This touched me.",
                            COUNT (IF(tip="Great post!"), 1, NULL)) "Great post!",
                            COUNT (IF


    }
?>