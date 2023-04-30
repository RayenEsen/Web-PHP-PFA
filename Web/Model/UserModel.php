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
            header("Location: http://localhost/web/View/Error404.php");
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
            header('Location: http://localhost/web/Error404.php');
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
            header('Location: http://localhost/web/View/Error404.php');
            exit();
        }
    }
    
    
    public function getName($ID)
    {
        if ($this->verify_teatcher($ID)) {
            $query = "SELECT FIRST FROM professor WHERE ID_PROF = :id";
        } else {
            $query = "SELECT FIRST FROM etudiant WHERE ID = :id";
        }
        
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $ID);
            $stmt->execute();
            $name = $stmt->fetch(PDO::FETCH_ASSOC);
            return $name;
        } catch (PDOException $e) {
            header('Location: http://localhost/web/Error404.php');
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
        header("Location: http://localhost/web/View/Error404.php");
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
    header('Location: http://localhost/web/View/Error404.php');
    exit();
  }
}

    
    //Method that Modify the User Info
    public function Edit_profile($FIRST, $EMAIL, $POSITION, $GENDER, $ID, $PHONE, $BIRTHDAY, $ABOUT, $STATUS)
    {
        if ($this->verify_teatcher($ID)) {
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
            $query = "UPDATE etudiant SET FIRST = :FIRST,
              EMAIL = :EMAIL,
              POSITION = :POSITION,
              GENDER = :GENDER,
              PHONE = :PHONE,
              BIRTHDAY = :BIRTHDAY,
              ABOUT = :ABOUT,
              STATUS = :STATUS
              WHERE ID = :ID";
        }
    
        try {
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
    
            $stmt->execute();
            Session($FIRST,$EMAIL,$POSITION,$GENDER,$ID,$PHONE,$BIRTHDAY,$ABOUT,$STATUS);
            header('Location: http://localhost/web/View/Profil.php');
        } catch(PDOException $e) {
          header("Location: http://localhost/web/View/Error404.php");
            exit;
        }
    }
    
     
    
    
    public function View_profile($FIRST)
    {
        try {
            $query = "SELECT * FROM etudiant WHERE FIRST = :FIRST";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':FIRST', $FIRST);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                $query = "SELECT * FROM professor WHERE FIRST = :FIRST";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':FIRST', $FIRST);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            if (!$user) {
                header("Location: http://localhost/web/View/Error404.php");
                exit;
            } else {
                header('Location: http://localhost/web/View/Profil_show.php?' . http_build_query($user));
                exit;
            }
        } catch (PDOException $e) {
            header("Location: http://localhost/web/View/Error404.php");
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
            header('Location: http://localhost/web/View/Chat.php');
        } catch(PDOException $e) {
            header("Location: http://localhost/web/View/Error404.php");
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
            header("Location: http://localhost/web/View/Error404.php");
            exit;
        }
    }
    
    
}