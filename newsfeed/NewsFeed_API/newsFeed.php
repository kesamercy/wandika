<?php
    require 'database.php';
    require 'validity.php';
   
    // the response will be a JSON object
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");$json = array();
    // pull the input, which should be in the form of a JSON object
    $json_params = file_get_contents('php://input');
    
    
    /**
     * Function that accepts a written post from an html form and associates it with the specified user_id.
     * The function will take the necessary parts from the post fields and input them into the sql database. Uses PDO and
     * prepared statements.
     * @Param: $user_id: the user_id associated with the post. This is a unique key.
     *         
     */
    function set_blog_post($user_id){
        //connect to database
        $conn = connect();
        
        //prepare statement
        $sql = "INSERT INTO posts_table (user_id, title, content, genre, date_posted, time_read, post_image, post_type, allow_comments)
        VALUES(:user_id, :title, :post, :genre, :`data`, :time_read, :post_image, :post_type, :allow_comments)";
        $conn->prepare($sql);
        $conn->bindParam(`:user_id`, $user_id);
        $conn->bindParam(`:title`, $title);
        $conn->bindParam(`:content`, $written_post);
        $conn->bindParam(`:genre`, $genre);
        $conn->bindParam(`:date_posted`, $date);
        $conn->bindParam(`:time_read`, $time_to_read);
        $conn->bindParam(`:post_image`, $post_image);
        $conn->bindParam(`:post_type`, $type_of_post);
        $conn->bindParam(`:allow_comments`, $allow_comments);
        
        //collect data
        $user = $conn->query("SELECT user_id FROM user WHERE user_id==$user_id");
        $written_post = $_POST['blog-post'];
        $blog_title = $_POST['News Feed'];
        $allowedImages = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
        $detectedImage = exif_imagetype($_FILES['blobImage']['pic_name']);
        $error = !in_array($detectedImage, $allowedImages);
        if(!$error){
            $post_image = $_FILES['blobImage'];
        }else{
            $post_image = NULL;
        }
        $genre = $_POST['genre'];
        
        //insert date into date field using php DATE
        $date = date('l jS \of F Y h:i:s A');
        
        //retrieve the estimated time to read from time_to_read form and insert into time_to_read column.
        //javascript needs to return a string.
        $time_to_read = $_POST['timeToRead'];

        $type_of_post = "Blog";
        $allow_comments = ((isset($comments) && $comments=='Allow') ? true : false);

        //insert into table posts            
        $conn->exec();
        echo "New post created successfully.";

        close_connection();
    }

    /*
    *Function that retrieves a blog post associated with a user_id and post_id.
    *Returns a .json.
    */
    function get_blog_post($user_id, $post_id){
        //match user name
        $conn = connect();
        $sql = "SELECT post FROM posts WHERE user_id=$user_id AND post_id=$post_id";
        $user_blog = $conn->query($sql);
        close_connection();
        return json_encode($user_blog);
    }

    function delete_post($user_id, $post_id){
        $conn = connect();
        $sql = "DELETE FROM `posts` WHERE `post_id` = $post_id AND `user_id` = $user_id";
        $conn->exec($sql);
        close_connection();
    }

    function set_tip($user_id){
        //open connection
        $conn = connect();
        //prepared statement
        $sql = "INSERT INTO posts_table (user_id, content, genre, date_posted, post_type)
        VALUES(:user_id, :content, :genre, :date_posted, :post_type)";
        $conn->prepare($sql);
        $conn->bindParam(`:user_id`, $user_id);
        $conn->bindParam(`:content`, $tip_content);
        $conn->bindParam(`:genre`, $genre);
        $conn->bindParam(`:date_posted`, $date_posted);
        $conn->bindParam(`:post_type`, $post_type);
        //fill in variables
        $tip_content = $_POST['content'];
        $genre = $_POST['genre'];
        $date_posted = date('l jS \of F Y h:i:s A');
        $post_type = "Tip";
        
        //execute prepared statement
        $conn->execute();

        close_connection();
    }

    function delete_tip($user_id, $tip_id){
        $conn = connect();
        $postdel = "DELETE FROM `posts_table` WHERE `tips_id` = $tip_id AND `user_id` = $user_id";
        $conn->exec($postdel);
        close_connection();
    }

    /* function set_tag($content_id){
        $conn = connect();
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
        close_connection();
    } */
    
    function get_tag_count($content_id){
        $conn = connect();
        $sql = "SELECT `count` FROM tags WHERE `post_id` = $content_id";
        return $sql;
    }

    function set_comment($user_id, $post_id){
        //open connection
        $conn = connect();
        //prepared statement
        $sql = "INSERT INTO feedback (user_id, content, post_id)
        VALUES(:user_id, :content, :genre, :date_posted, :post_type)";
        $conn->prepare($sql);
        $stmt->bindParam(`:user_id`, $user_id);
        $stmt->bindParam(`:content`, $feedback_content);
        $stmt->bindParam(`:post_id`, $post_id);
        //fill in variables
        $feedback_content = $_POST['feedback'];
        //execute statement
        $stmt->execute();
        close_connection();
    }

    /*
     * Function that returns a bool if a comment should be flagged for moderation.
     */
    function flag_comment($feedback_id){
        
        $conn = connect();
        $sql = "SELECT flag_count FROM feedback WHERE `feedback_id` = $feedback_id";
        $flags = $conn->query($sql);
        $sql = "SELECT views FROM feedback WHERE `feedback_id` = $feedback_id";
        $views = $conn->query($sql);
        $disable = ($views/$flags >= 0.5 ? true : false);
        close_connection();
        return $disable;
    }
    /**
     * Function to increase the flag_count on a comment.
     */
    function  increase_flag_count($feedback_id){
        $conn = connect();
        $sql = "UPDATE feedback SET flag_count = flag_count + 1 WHERE feedback_id = $feedback_id";
        $conn->exec($sql);
        close_connection();
    }

    /* function increase_recommend_comment($feedback_id){
        $conn = connect();
        $sql = "UPDATE feedback SET recommend_count = recommend_count + 1 WHERE feedback_id = $feedback_id";
        close_connection();
    } */

    /* function promote_comment($feedback_id){
        $conn = connect();
        $recommendations = "SELECT FROM feedback `recommendations` WHERE `feedback_id` = $feedback_id";
        $views = "SELECT FROM feedback `views` WHERE `feedback_id` = $feedback_id";
        $promote = ($views/$flags >= 0.5 ? true : false);
        if($promote){
            $user_id = "SELECT user_id FROM feedback WHERE `feedback_id` = $feedback_id";
            $feedback_content = "SELECT content FROM feedback WHERE `feedback_id` = $feedback_id";
            $date = date('l jS \of F Y h:i:s A');
            $sql = "INSERT INTO posts_table (content, post_type, user_id, date_posted) VALUES ($feedback_content, "Tips", $user_id, $date"); 
        }
        close_connection();
        
    } */

    function search_user($query){
        $conn = connect();
        $search = "SELECT * FROM user WHERE username LIKE :query";
        
        //$stmt->bindParam(`:user_id`, $user_id);
        
        $search_result = $conn->prepare($search);
        $search_result->bindParam(':query', %{$query}%);
        $conn->execute();
        $results = $conn->fetchAll();
        return json_encode($results, JSON_FORCE_OBJECT);

        
    }

    /**
     * Function that randomizes a post to be returned as a .json object.
     * This returns the content as a .json object.
     */
    function post_randomizer(){
        $conn = connect();
        $sql = "SELECT * FROM post_table WHERE post_type = "Blog"";
        $conn->query($sql);
        $blogs = $conn->fetchAll(PDO::FETCH_COLUMN, 4); //grabs all content from result
        close_connection();
        shuffle($blogs);
        $count = count($blogs);
        $random_num = random_int(0, $count-1);
        $blog_to_return = $blogs[$random_num];
        return json_encode($blog_to_return, JSON_FORCE_OBJECT);
    }


?>