<?php
require_once  'Connection.php';
require_once 'SessionController.php';
class UserModel
{
  protected $ID;
  protected $FIRST;
  protected $EMAIL;
  protected $PWD;
  protected $PHONE;
  protected $ABOUT;
  protected $POSITION;
  protected $BIRTHDAY;
  protected $GENDER;
  protected $STATUS;
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }
  public function cryptage($password) {
    $chars = str_split($password);
    
    $hashedChars = array_map(function($char) {
      $x = ord($char) + 2;
      return chr($x);
    }, $chars);
    
    $hashedPassword = implode('', array_reverse($hashedChars));
    
    return $hashedPassword;
  }
      
    public function getUsers()
    {
        try {
            $query = "SELECT * FROM etudiant";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } catch(PDOException $e) {
          header("Location: Error404.php?error=" . urlencode($e->getMessage()));
          exit;
        }
    }
    public function getUsers_nb()
    {
        $query = "SELECT COUNT(*) FROM etudiant";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $nb = $stmt->fetchColumn();
            return $nb;
        } catch (PDOException $e) {
          header("Location: Error404.php?error=" . urlencode($e->getMessage()));
          exit();
        }
    }
    
    public function verify_teatcher($ID)
    {
        try {
            //The question mark represent the parameter This help prevent sql injection
            $query = "SELECT * FROM admins_ids WHERE ID_PROF = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$ID]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
              return true;
          } else {
              return false;
          }
        } catch (PDOException $e) {
          header("Location: Error404.php?error=" . urlencode($e->getMessage()));
          exit();
        }
    }
    //I Couldn't group them both in 1 query because of code complications and alot of bugs
    public function verify_teacher_by_name($FIRST) {
      try {
        //The question mark represent the parameter This help prevent sql injection
        $query = "SELECT * FROM professor WHERE FIRST = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$FIRST]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
          return true;
        } else {
          return false;
        }
      } catch (PDOException $e) {
        header("Location: Error404.php?error=" . urlencode($e->getMessage()));
        exit();
      }
    }
    
    public function getUserBy_Id_Name($ID, $FIRST)
    {
        if ($this->verify_teatcher($ID) || $this->verify_teacher_by_name($FIRST)) {
            $query = "SELECT * FROM professor WHERE ID_PROF = :id OR FIRST = :first";
        } else {
            $query = "SELECT * FROM etudiant WHERE ID = :id OR FIRST = :first";
        }
        
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $ID);
            $stmt->bindParam(':first', $FIRST);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user !== false) {
                return $user;
            } else {
              header("Location: Profil.php");
              exit();
            }
        } catch (PDOException $e) {
          header("Location: Error404.php?error=" . urlencode($e->getMessage()));
          exit();
        }
    }
    
    public function getPerson_byID($ID)
    {
        $query = "SELECT FIRST FROM etudiant WHERE ID = :id";
    
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $ID);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
          header("Location: Error404.php?error=" . urlencode($e->getMessage()));
          exit();
        }
    }
    public function getPerson_byID2($ID)
    {
        $query = "SELECT * FROM etudiant WHERE ID = :id";
    
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $ID);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
          header("Location: Error404.php?error=" . urlencode($e->getMessage()));
          exit();
        }
    } 

    public function getMessages()
    {
      $query = "SELECT message_id, message, Message_timestamp, sender_id as sender FROM messages
      UNION ALL
      SELECT message_id, message, Message_timestamp, sender_prof_id as sender FROM messages_prof
          
      ORDER BY Message_timestamp ASC;
      ";
      try {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
      } catch(PDOException $e) {
        header("Location: Error404.php?error=" . urlencode($e->getMessage()));
        exit;
      }
    }
    
    //Method That Add a student
    public function registerUser($name, $email, $password, $cin)
    {
      $password = $this->cryptage($password);
      if ($this->verify_teatcher($cin)) {
        $query = "INSERT INTO professor (ID_PROF, FIRST, EMAIL, PWD, PHONE, ABOUT, POSITION, BIRTHDAY, GENDER, STATUS) VALUES ('$cin', '$name', '$email', '$password', '$this->PHONE', '$this->ABOUT', '$this->POSITION', '$this->BIRTHDAY', '$this->GENDER', '$this->STATUS')";  
      } else {
        $query = "INSERT INTO etudiant (ID, FIRST, EMAIL, PWD, PHONE, ABOUT, POSITION, BIRTHDAY, GENDER, STATUS) VALUES ('$cin', '$name', '$email', '$password', '$this->PHONE', '$this->ABOUT', '$this->POSITION', '$this->BIRTHDAY', '$this->GENDER', '$this->STATUS')";
      }
      if ($this->db->query($query)) {
        header('Location: Login.php');
      } else {
        header('Location: Register.php');
      }
    }
    
    //Method that check if the user exist in the Database
public function loginUser($email, $password)
{
  try {
    $password = $this->cryptage($password);
    $query = "SELECT * FROM etudiant WHERE EMAIL = '$email' AND PWD = '$password' UNION SELECT * FROM professor WHERE EMAIL = '$email' AND PWD = '$password'";
    $result = $this->db->query($query);
    $user = $result->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
      header('Location: Login.php');
    } else {
      $this->ID = $user['ID'];
      $this->FIRST = $user['FIRST'];
      $this->EMAIL = $user['EMAIL'];
      $this->PWD = $user['PWD'];
      Session($this->FIRST, $this->EMAIL, $user['POSITION'], $user['GENDER'], $this->ID, $user['PHONE'], $user['BIRTHDAY'], $user['ABOUT'],$user['status']);
      header('Location: Profil.php');
    }
    exit();
  } catch (Exception $e) {
    header("Location: Error404.php?error=" . urlencode($e->getMessage()));
    exit();
  }
}

    
    //Method that Modify the User Info
    public function Edit_profile($FIRST, $EMAIL, $POSITION, $GENDER, $ID, $PHONE, $BIRTHDAY, $ABOUT, $STATUS, $imgContent = null, $backgroundContent = null)
    {
      // If the Verify teacher returns true, the user that belongs to the session is a teacher, so we are going to insert/update the new data of the teacher
      if ($this->verify_teatcher($ID)) {
        // A query in case no image or background image is uploaded
        if ($imgContent == null && $backgroundContent == null) {
          $query = "UPDATE professor SET FIRST = :FIRST,
          EMAIL = :EMAIL,
          POSITION = :POSITION,
          GENDER = :GENDER,
          PHONE = :PHONE,
          BIRTHDAY = :BIRTHDAY,
          ABOUT = :ABOUT,
          STATUS = :STATUS
          WHERE ID_PROF = :ID";
        } else {
          $query = "UPDATE professor SET FIRST = :FIRST,
          EMAIL = :EMAIL,
          POSITION = :POSITION,
          GENDER = :GENDER,
          PHONE = :PHONE,
          BIRTHDAY = :BIRTHDAY,
          ABOUT = :ABOUT,
          STATUS = :STATUS";
    
          if ($imgContent !== null) {
            $query .= ", PFP = :IMAGE";
          }
    
          if ($backgroundContent !== null) {
            $query .= ", BACKGROUND_IMAGE = :BACKGROUND_IMAGE";
          }
    
          $query .= " WHERE ID_PROF = :ID";
        }
      } else {
        // It is a student
        if ($imgContent == null && $backgroundContent == null) {
          $query = "UPDATE etudiant SET FIRST = :FIRST,
          EMAIL = :EMAIL,
          POSITION = :POSITION,
          GENDER = :GENDER,
          PHONE = :PHONE,
          BIRTHDAY = :BIRTHDAY,
          ABOUT = :ABOUT,
          STATUS = :STATUS
          WHERE ID = :ID";
        } else {
          $query = "UPDATE etudiant SET FIRST = :FIRST,
          EMAIL = :EMAIL,
          POSITION = :POSITION,
          GENDER = :GENDER,
          PHONE = :PHONE,
          BIRTHDAY = :BIRTHDAY,
          ABOUT = :ABOUT,
          STATUS = :STATUS";
    
          if ($imgContent !== null) {
            $query .= ", PFP = :IMAGE";
          }
    
          if ($backgroundContent !== null) {
            $query .= ", BACKGROUND_IMAGE = :BACKGROUND_IMAGE";
          }
    
          $query .= " WHERE ID = :ID";
        }
      }
    
      try {
        // Bind params to prevent SQL injection
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':FIRST', $FIRST);
        $stmt->bindParam(':EMAIL', $EMAIL);
        $stmt->bindParam(':POSITION', $POSITION);
        $stmt->bindParam(':GENDER', $GENDER);
        $stmt->bindParam(':PHONE', $PHONE);
        $stmt->bindParam(':BIRTHDAY', $BIRTHDAY);
        $stmt->bindParam(':ABOUT', $ABOUT);
        $stmt->bindParam(':STATUS', $STATUS);
        $stmt->bindParam(':ID', $ID);
    
        if ($imgContent !== null) {
          // Bind the image content as a blob parameter
          $stmt->bindParam(':IMAGE', $imgContent, PDO::PARAM_LOB);
        }
    
        if ($backgroundContent !== null) {
          // Bind the background image content as a blob parameter
          $stmt->bindParam(':BACKGROUND_IMAGE', $backgroundContent, PDO::PARAM_LOB);
        }
    
        $stmt->execute();
        Session($FIRST, $EMAIL, $POSITION, $GENDER, $ID, $PHONE, $BIRTHDAY, $ABOUT, $STATUS);

        if ($imgContent !== null || $backgroundContent !== null) {
          header('Location: Profil.php');
        } else {
          header('Location: Profil.php?updated=true');
        }
      } catch(PDOException $e) {
        header("Location: Error404.php?error=" . urlencode($e->getMessage()));
        exit;
      }
    }
    
    public function Insert_Message($sender_id, $message)
    {
        if ($this->verify_teatcher($sender_id)==false) {
            $query = "INSERT INTO messages (message, sender_id) VALUES (:message, :sender_id)";
        } else {
            $query = "INSERT INTO messages_prof (message, sender_prof_id) VALUES (:message, :sender_id)";
        }
    
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':sender_id', $sender_id);
            $stmt->execute();
            header('Location: Chat.php');
        } catch(PDOException $e) {
          header("Location: Error404.php?error=" . urlencode($e->getMessage()));
          exit;
        }
    }
    
    public function Delete_User($ID)
    {
        try {
            $this->db->beginTransaction();
    
            // Delete messages associated with the student
            $deleteMessagesQuery = "DELETE FROM messages WHERE sender_id = :ID";
            $stmtMessages = $this->db->prepare($deleteMessagesQuery);
            $stmtMessages->bindParam(':ID', $ID);
            $stmtMessages->execute();
    
            // Delete the student
            $deleteStudentQuery = "DELETE FROM etudiant WHERE ID = :ID";
            $stmtStudent = $this->db->prepare($deleteStudentQuery);
            $stmtStudent->bindParam(':ID', $ID);
            $stmtStudent->execute();
    
            $this->db->commit();
            header('Location: dashboard.php');
          } catch(PDOException $e) {
            $this->db->rollBack();
            header("Location: Error404.php?error=" . urlencode($e->getMessage()));
            exit;
        }
    }
    public function GetnbPost($ID)
    {
        $query = "SELECT COUNT(*) AS post_count FROM post WHERE Forum_id = $ID";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['post_count'];
        } catch (PDOException $e) {
          header("Location: Error404.php?error=" . urlencode($e->getMessage()));
          exit;
        }
    }
    public function GetForums($category, $filter , $type)
    {
        if ($filter == 3) {
            $query = "SELECT * FROM forum WHERE Categorie = :category ORDER BY View $type";
        } else if ($filter == 2) {
            $query = "SELECT * FROM forum WHERE Categorie = :category ORDER BY Timestamp $type";
        } else if ($filter == 1) {
            $query = "SELECT forum.*, COUNT(post.post_id) AS post_count
                      FROM forum
                      LEFT JOIN post ON forum.Forum_id = post.Forum_id
                      WHERE forum.Categorie = :category
                      GROUP BY forum.Forum_id
                      ORDER BY post_count $type";
        } else {
            $query = "SELECT * FROM forum WHERE Categorie = :category";
        }
    
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':category', $category);
            $stmt->execute();
            $forums = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $forums;
        } catch (PDOException $e) {
          header("Location: Error404.php?error=" . urlencode($e->getMessage()));
          exit;
        }
    }  

    public function getForum($ID)
    {
      $query = "SELECT * FROM forum WHERE Forum_id = :ID";
      try {
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ID', $ID);
        $stmt->execute();
        $forum = $stmt->fetch(PDO::FETCH_ASSOC);  // Use fetch instead of fetchAll
        return $forum;
      } catch(PDOException $e) {
        // Log the error instead of redirecting
        error_log($e->getMessage());
        // Handle the error gracefully, e.g., display a generic error message
        return "An error occurred while fetching the forum.";
      }
    }
    
    public function Create_Forum($title, $tags, $person_id, $category)
    {
        // Adding forum title
        $query = "INSERT INTO forum (Title, tags, person_id, Categorie) VALUES (:title, :tags, :person_id, :category)";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':tags', $tags);
            $stmt->bindParam(':person_id', $person_id);
            $stmt->bindParam(':category', $category);
            $stmt->execute();
            $forum_id = $this->db->lastInsertId(); // Retrieve the Forum_id
            
            // Creating the forum_page
            $query = "INSERT INTO forum_page (Forum_id, person_id) VALUES (:forum_id, :person_id)";
            try {
                $stmt2 = $this->db->prepare($query);
                $stmt2->bindParam(':forum_id', $forum_id);
                $stmt2->bindParam(':person_id', $person_id);
                $stmt2->execute();
                
                // Redirect to Forum_list.php with the category parameter
                header("Location: Forum_list.php?category=" . urlencode($category));
                exit;
            } catch (PDOException $e) {
              header("Location: Error404.php?error=" . urlencode($e->getMessage()));
              exit;
            }
        } catch (PDOException $e) {
          header("Location: Error404.php?error=" . urlencode($e->getMessage()));
          exit;
        }
    }
    
    public function getForums_nb()
    {
      $query = "SELECT COUNT(*) FROM forum";
      try {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $nb = $stmt->fetchColumn();
        return $nb;
    } catch (PDOException $e) {
      header("Location: Error404.php?error=" . urlencode($e->getMessage()));
      exit();
    }
    }
    public function getForums_nb2($category)
    {
        $query = "SELECT COUNT(*) FROM forum WHERE Categorie = :category";
      try {
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        $nb = $stmt->fetchColumn();
        return $nb;
    } catch (PDOException $e) {
      header("Location: Error404.php?error=" . urlencode($e->getMessage()));
      exit();
    }
    }
    

    public function InsertPost($content, $poster_id, $forum_id)
    {
        $query = "INSERT INTO post (content, poster_id, Forum_id) VALUES (:content, :poster_id, :forum_id)";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':poster_id', $poster_id);
            $stmt->bindParam(':forum_id', $forum_id);
            $stmt->execute();
            header('Location: Forum_page.php?ID=' . urlencode($forum_id));
            exit;
        } catch (PDOException $e) {
          header("Location: Error404.php?error=" . urlencode($e->getMessage()));
          exit;
        }
    }    
public function GetPost($ID)
{
    $query = "SELECT * FROM post  WHERE Forum_id=:ID  ORDER BY timestamp ASC ";
    try {
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    } catch (PDOException $e) {
      header("Location: Error404.php?error=" . urlencode($e->getMessage()));
      exit;
    }
}

    public function NewView($ID)
    {
        try {
            $query = "UPDATE forum SET View = View + 1 WHERE Forum_id = :ID";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
            $stmt->execute();
        } catch(PDOException $e) {
          header("Location: Error404.php?error=" . urlencode($e->getMessage()));
          exit;
        }
    }

    public function getViewCount($ID)
{
    try {
        $query = "SELECT View FROM forum WHERE Forum_id = :ID";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['View'];
    } catch(PDOException $e) {
        // Redirect to the error page with the error message
        header("Location: Error404.php?error=" . urlencode($e->getMessage()));
        exit;
    }
}
public function CreateUpvote($Voter_id, $forum_id)
{
    try {
        $query = "SELECT Nbr FROM upvote WHERE Voter_id = :Voter_id AND Forum_id = :forum_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':Voter_id', $Voter_id, PDO::PARAM_STR);
        $stmt->bindParam(':forum_id', $forum_id, PDO::PARAM_INT);
        $stmt->execute();
        $vote = $stmt->fetchColumn();

        if ($vote === false) {
            $query = "INSERT INTO upvote (Voter_id, Nbr, Forum_id) VALUES (:Voter_id, 1, :forum_id)";
        } else {
            if ($vote == 0) {
                $query = "UPDATE upvote SET Nbr = 1 WHERE Voter_id = :Voter_id AND Forum_id = :forum_id";
            } else {
                $query = "UPDATE upvote SET Nbr = 0 WHERE Voter_id = :Voter_id AND Forum_id = :forum_id";
            }
        }

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':Voter_id', $Voter_id, PDO::PARAM_STR);
        $stmt->bindParam(':forum_id', $forum_id, PDO::PARAM_INT);
        $stmt->execute();

        // Additional code for handling successful insertion if needed
        header('Location: Forum_page.php?ID=' . urlencode($forum_id));
      } catch (PDOException $e) {
      header("Location: Error404.php?error=" . urlencode($e->getMessage()));
      exit;
    }
}

public function SumUpvotes($forum_id)
{
  $S = 0;
  $query = "SELECT SUM(Nbr) AS total_upvotes FROM upvote WHERE Forum_id = :forum_id";

  try {
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':forum_id', $forum_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result && isset($result['total_upvotes'])) {
      $S = $result['total_upvotes'];
    }

    return $S;
  } catch (PDOException $e) {
    header("Location: Error404.php?error=" . urlencode($e->getMessage()));
    exit;
  }
}


}