<?php
require_once  '../Model/Connection.php';
require_once '../Controller/SessionController.php';
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
    
    foreach($chars as &$char) {
    $x = ord($char) + 2;
    $char = chr($x);
    }
    
    $chars = array_reverse($chars);
    
    return implode('', $chars);
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
          header("Location: http://localhost/web/View/Error404.php?error=".urlencode($e->getMessage()));
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
          header("Location: http://localhost/web/View/Error404.php?error=".urlencode($e->getMessage()));
            exit();
        }
    }
    
    public function verify_teatcher($ID)
    {
        try {
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
          header("Location: http://localhost/web/View/Error404.php?error=".urlencode($e->getMessage()));
            exit();
        }
    }
    //I Couldn't group them both in 1 query because of code complications and alot of bugs
    public function verify_teacher_by_name($FIRST) {
      try {
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
        header("Location: http://localhost/web/View/Error404.php?error=".urlencode($e->getMessage()));
        exit();
      }
    }
    
    
    public function getUserBy_Id_Name($ID, $FIRST)
{
    if ($this->verify_teatcher($ID) or ($this->verify_teacher_by_name($FIRST))) {
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
        return $user;
    } catch (PDOException $e) {
        header("Location: http://localhost/web/View/Error404.php?error=".urlencode($e->getMessage()));
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
        header("Location: http://localhost/web/View/Error404.php?error=".urlencode($e->getMessage()));
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
        header('Location: http://localhost/web/View/Login.php');
      } else {
        header('Location: http://localhost/web/View/Register.php');
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
      header('Location: http://localhost/web/View/Login.php');
    } else {
      $this->ID = $user['ID'];
      $this->FIRST = $user['FIRST'];
      $this->EMAIL = $user['EMAIL'];
      $this->PWD = $user['PWD'];
      Session($this->FIRST, $this->EMAIL, $user['POSITION'], $user['GENDER'], $this->ID, $user['PHONE'], $user['BIRTHDAY'], $user['ABOUT'],$user['status']);
      header('Location: http://localhost/web/View/Profil.php');
    }
    exit();
  } catch (Exception $e) {
    header("Location: http://localhost/web/View/Error404.php?error=".urlencode($e->getMessage()));
    exit();
  }
}

    
    //Method that Modify the User Info
    public function Edit_profile($FIRST, $EMAIL, $POSITION, $GENDER, $ID, $PHONE, $BIRTHDAY, $ABOUT, $STATUS , $imgContent = null)
    {
      //If the Verify teacher returns true than the user that belongs to the session is a teacher so we are going to insert/update the new data of the teacher
      if ($this->verify_teatcher($ID)) {
        //a query in case he didn't upload an image (this helps prevent errors)
        if ($imgContent == null)
        {
          $query = "UPDATE professor SET FIRST = :FIRST,
          EMAIL = :EMAIL,
          POSITION = :POSITION,
          GENDER = :GENDER,
          PHONE = :PHONE,
          BIRTHDAY = :BIRTHDAY,
          ABOUT = :ABOUT,
          STATUS = :STATUS
          WHERE ID_PROF = :ID";
        }
        else
        {
          $query = "UPDATE professor SET FIRST = :FIRST,
          EMAIL = :EMAIL,
          POSITION = :POSITION,
          GENDER = :GENDER,
          PHONE = :PHONE,
          BIRTHDAY = :BIRTHDAY,
          ABOUT = :ABOUT,
          STATUS = :STATUS,
          PFP = :IMAGE
          WHERE ID_PROF = :ID";
        }
      } else {
        //Then it is a student 
        if($imgContent == null)
        {
          $query = "UPDATE etudiant SET FIRST = :FIRST,
          EMAIL = :EMAIL,
          POSITION = :POSITION,
          GENDER = :GENDER,
          PHONE = :PHONE,
          BIRTHDAY = :BIRTHDAY,
          ABOUT = :ABOUT,
          STATUS = :STATUS
          WHERE ID = :ID";
        }else
        {
          $query = "UPDATE etudiant SET FIRST = :FIRST,
          EMAIL = :EMAIL,
          POSITION = :POSITION,
          GENDER = :GENDER,
          PHONE = :PHONE,
          BIRTHDAY = :BIRTHDAY,
          ABOUT = :ABOUT,
          STATUS = :STATUS,
          PFP = :IMAGE
          WHERE ID = :ID";
        }
      }    
      try {
        //Bind params to prevent SQL injection
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
        $stmt->execute();
        Session($FIRST,$EMAIL,$POSITION,$GENDER,$ID,$PHONE,$BIRTHDAY,$ABOUT,$STATUS);
        header('Location: http://localhost/web/View/Profil.php');
      } catch(PDOException $e) {
        header("Location: http://localhost/web/View/Error404.php?error=".urlencode($e->getMessage()));
        exit;
      }
    }
    

    public function Insert_Message($sender_id, $message)
    {
        if ($_SESSION['user_position'] != "Teatcher") {
            $query = "INSERT INTO messages (message, sender_id) VALUES (:message, :sender_id)";
        } else {
            $query = "INSERT INTO messages_prof (message, sender_prof_id) VALUES (:message, :sender_id)";
        }
    
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':sender_id', $sender_id);
            $stmt->execute();
            header('Location: http://localhost/web/View/Chat.php ');
        } catch(PDOException $e) {
          header("Location: http://localhost/web/View/Error404.php?error=".urlencode($e->getMessage()));
            exit;
        }
    }
    
    public function Delete_User($ID)
    {
        try {
            $query = "DELETE FROM etudiant WHERE ID = :ID";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':ID', $ID);
            $stmt->execute();
            header('Location: http://localhost/web/View/dashboard.php');
        } catch(PDOException $e) {
          header("Location: http://localhost/web/View/Error404.php?error=".urlencode($e->getMessage()));
            exit;
        }
    }
}