<?php
    include 'DB.php'
  
    class Newsfeed{
        //Variables
       
       
        /**
         * Function that accepts a written post from an html form and associates it with the specified user_id.
         * The function will take the necessary parts from the post fields and input them into the sql database. Uses PDO and
         * prepared statements.
         * @Param: $user_id: the user_id associated with the post. This is a unique key.
         *         
         */
        public function set_blog_post($user_id){
            //combine under one insert
            //match user name
            $conn = new PDO('mysql:host=webdev.cse.buffalo.edu;dbname=wandika;charset=utf8', 'wandika_user', 'wandika19!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("INSERT INTO posts_table (user_id, title, content, genre, date_posted, time_read, post_image, post_type, allow_comments)
            VALUES(:user_id, :title, :post, :genre, :`data`, :time_read, :post_image, :post_type, :allow_comments)");
            $stmt->bindParam(`:user_id`, $user_id);
            $stmt->bindParam(`:title`, $title);
            $stmt->bindParam(`:content`, $written_post);
            $stmt->bindParam(`:genre`, $genre);
            $stmt->bindParam(`:date_posted`, $date);
            $stmt->bindParam(`:time_read`, $time_to_read);
            $stmt->bindParam(`:post_image`, $post_image);
            $stmt->bindParam(`:post_type`, $type_of_post);
            $stmt->bindParam(`:allow_comments`, $allow_comments);
            $user = "SELECT user_id FROM user WHERE user_id==$user_id";
            
            //retrieve title from title input and store in title column
            //not secure need to add prepared statement. 
            $written_post = $_POST['blog-post'];
            $blog_title = $_POST['News Feed'];
           

            //retrieve the blog post from parameter and store in post column
            $allowedImages = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
            $detectedImage = exif_imagetype($_FILES['blobImage']['pic_name']);
            $error = !in_array($detectedImage, $allowedImages);
            if(!$error){
                $post_image = $_FILES['blobImage'];
            }else{
                $post_image = NULL;
            }

            //retrieve the genre from genre form and store in genre column
            //not secure need to add prepared statement. remove html tags
            $genre = $_POST['genre'];
            
            
            //insert date into date field using php DATE
            $date = date('l jS \of F Y h:i:s A');
           
            
            //retrieve the estimated time to read from time_to_read form and insert into time_to_read column.
            $time_to_read = $_POST['timeToRead'];

            //retrieve image if image available

            $type_of_post = "Blog";
            $allow_comments = ((isset($comments) && $comments=='Allow') ? true : false);

            //insert into table posts            
            $stmt->execute();
            echo "New post created successfully.";

            $conn = null;
        }

        public function get_blog_post($user_id, $post_id){
            //match user name
            $sql = "SELECT post FROM posts WHERE user_id=$user_id AND post_id=$post_id";
            return $sql;
        }

        public function delete_post($user_id, $post_id){
            $conn = new PDO('mysql:host=webdev.cse.buffalo.edu;dbname=wandika;charset=utf8', 'wandika_user', 'wandika19!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $postdel = "DELETE FROM `posts` WHERE `post_id` = $post_id AND `user_id` = $user_id";
            $conn = null;
        }

        public function set_tip($user_id){
            //open connection
            $conn = new PDO('mysql:host=webdev.cse.buffalo.edu;dbname=wandika;charset=utf8', 'wandika_user', 'wandika19!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //prepared statement
            $stmt = $conn->prepare("INSERT INTO posts_table (user_id, content, genre, date_posted, post_type)
            VALUES(:user_id, :content, :genre, :date_posted, :post_type)");
            $stmt->bindParam(`:user_id`, $user_id);
            $stmt->bindParam(`:content`, $tip_content);
            $stmt->bindParam(`:genre`, $genre);
            $stmt->bindParam(`:date_posted`, $date_posted);
            $stmt->bindParam(`:post_type`, $post_type);
            //fill in variables
            $tip_content = $_POST['content'];
            $genre = $_POST['genre'];
            $date_posted = date('l jS \of F Y h:i:s A');
            $post_type = "Tip";
          
            //execute statement
            $stmt->execute();
             
            echo "New tip created successfully.";
            $conn = null;
        }

        public function delete_tip($user_id, $tip_id){
            $conn = new PDO('mysql:host=webdev.cse.buffalo.edu;dbname=wandika;charset=utf8', 'wandika_user', 'wandika19!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $postdel = "DELETE FROM `posts_table` WHERE `tips_id` = $tip_id AND `user_id` = $user_id";
            $conn = null;
        }

        /* public function set_tag($content_id){
            $conn = new PDO('mysql:host=webdev.cse.buffalo.edu;dbname=wandika;charset=utf8', 'wandika_user', 'wandika19!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $tag = $_POST['tag']
            switch($tag){
                case "":
                    $sql = "UPDATE tags SET count = count + 1 WHERE content = ''";
                    break;
                case "":
                    $sql = "UPDATE tags SET count = count + 1 WHERE content = ''";
                    break;
                case "":
                    $sql = "UPDATE tags SET count = count + 1 WHERE content = ''";
                    break;
                case "":
                    $sql = "UPDATE tags SET count = count + 1 WHERE content = ''";
                    break;
                case "":
                    $sql = "UPDATE tags SET count = count + 1 WHERE content = ''";
                    break;
                case "":
                    $sql = "UPDATE tags SET count = count + 1 WHERE content = ''";
                    break;
                case "":
                    $sql = "UPDATE tags SET count = count + 1 WHERE content = ''";
                    break;
                case "":
                    $sql = "UPDATE tags SET count = count + 1 WHERE content = ''";
                    break;
                case "":
                    $sql = "UPDATE tags SET count = count + 1 WHERE content = ''";
                    break;    
                    
            }
            $conn = null;
        } */
        
        public function get_tag_count($content_id){
            $conn = new PDO('mysql:host=webdev.cse.buffalo.edu;dbname=wandika;charset=utf8', 'wandika_user', 'wandika19!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT `count` FROM tags WHERE `post_id` = $content_id";
            return $sql;
        }

        public function set_comment($user_id, $post_id){
            //open connection
            $conn = new PDO('mysql:host=webdev.cse.buffalo.edu;dbname=wandika;charset=utf8', 'wandika_user', 'wandika19!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //prepared statement
            $stmt = $conn->prepare("INSERT INTO feedback (user_id, content, post_id)
            VALUES(:user_id, :content, :genre, :date_posted, :post_type)");
            $stmt->bindParam(`:user_id`, $user_id);
            $stmt->bindParam(`:content`, $feedback_content);
            $stmt->bindParam(`:post_id`, $post_id);
            //fill in variables
            $feedback_content = $_POST['feedback'];
            
            //execute statement
            $stmt->execute();
             
            echo "New comment created successfully.";
            $conn = null;
        }

        public function flag_comment($feedback_id){
            
            $conn = new PDO('mysql:host=webdev.cse.buffalo.edu;dbname=wandika;charset=utf8', 'wandika_user', 'wandika19!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $flags = "SELECT flag_count FROM feedback WHERE `feedback_id` = $feedback_id";
            $views = "SELECT views FROM feedback WHERE `feedback_id` = $feedback_id";
            $disable = ($views/$flags >= 0.5 ? true : false);
            $conn = null;
            return $disable;
        }

        public function  increase_flag_count($feedback_id){
            $conn = new PDO('mysql:host=webdev.cse.buffalo.edu;dbname=wandika;charset=utf8', 'wandika_user', 'wandika19!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE feedback SET flag_count = flag_count + 1 WHERE feedback_id = $feedback_id";
            $conn = null;
        }

        public function increase_recommend_comment($feedback_id){
            $conn = new PDO('mysql:host=webdev.cse.buffalo.edu;dbname=wandika;charset=utf8', 'wandika_user', 'wandika19!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE feedback SET recommend_count = recommend_count + 1 WHERE feedback_id = $feedback_id";
            $conn = null;
        }

        public function promote_comment($feedback_id){
            $conn = new PDO('mysql:host=webdev.cse.buffalo.edu;dbname=wandika;charset=utf8', 'wandika_user', 'wandika19!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $recommendations = "SELECT FROM feedback `recommendations` WHERE `feedback_id` = $feedback_id";
            $views = "SELECT FROM feedback `views` WHERE `feedback_id` = $feedback_id";
            $promote = ($views/$flags >= 0.5 ? true : false);
            if($promote){
                $user_id = "SELECT user_id FROM feedback WHERE `feedback_id` = $feedback_id";
                $feedback_content = "SELECT content FROM feedback WHERE `feedback_id` = $feedback_id";
                $date = date('l jS \of F Y h:i:s A');
                $sql = "INSERT INTO posts_table (content, post_type, user_id, date_posted) VALUES ($feedback_content, "Tips", $user_id, $date"); 
            }
            $conn = null;
            
        }

        public function search_user($query){
            $conn = new PDO('mysql:host=webdev.cse.buffalo.edu;dbname=wandika;charset=utf8', 'wandika_user', 'wandika19!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $search = "SELECT * FROM user WHERE username LIKE :query";
            
            //$stmt->bindParam(`:user_id`, $user_id);
            
            $search_result = $conn->prepare($search);
            $search_result->bindParam(':query', %$query%);

            
        }

        public function post_randomizer

    }
?>