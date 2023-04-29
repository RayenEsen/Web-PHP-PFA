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
        $query = "SELECT * FROM etudiant";
        $result = $this->db->query($query);
        $users = $result->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }    
    public function getUsers_nb()
    {
        $query = "SELECT COUNT(*) FROM etudiant";
        $result = $this->db->query($query);
        $nb = $result->fetchColumn();
        return $nb;
    }
    
    
    public function getName($ID)
    {
        $query = "SELECT FIRST FROM etudiant WHERE ID = '$ID'";
        $result = $this->db->query($query);
        $name = $result->fetch(PDO::FETCH_ASSOC);
        return $name;
    }
    

    public function getMessages()
    {
      $query = "SELECT message_id, message, Message_timestamp, sender_id as sender FROM messages
      UNION ALL
      SELECT message_id, message, Message_timestamp, sender_prof_id as sender FROM messages_prof
      
      ORDER BY Message_timestamp ASC;
      ";
      $result = $this->db->query($query);
      $users = $result->fetchAll(PDO::FETCH_ASSOC);
      return $users;
    }

    public function verify_teatcher($ID)
    {
      $query = "SELECT * FROM admins_ids WHERE ID_PROF = '$ID';";
      $result = $this->db->query($query);
      if ($result->rowCount() > 0) {
        return true;
      } else {
        return false;
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
        echo "Error registering user.";
      }
    }
    
    //Method that check if the user exist in the Database
    public function loginUser($email, $password)
    {
      $password = $this->cryptage($password);
      $query = "SELECT * FROM etudiant WHERE EMAIL = '$email' AND PWD = '$password' UNION SELECT * FROM professor WHERE EMAIL = '$email' AND PWD = '$password'";
      $result = $this->db->query($query);
      $user = $result->fetch(PDO::FETCH_ASSOC);
    
      if (!$user) {
        echo("Invalid email or password.");
      } else {
        $this->ID = $user['ID'];
        $this->FIRST = $user['FIRST'];
        $this->EMAIL = $user['EMAIL'];
        $this->PWD = $user['PWD'];
        Session($this->FIRST, $this->EMAIL, $user['POSITION'], $user['GENDER'], $this->ID, $user['PHONE'], $user['BIRTHDAY'], $user['ABOUT'],$user['status']);
        header('Location: http://localhost/web/View/Profil.php');
      }
      exit();
    }
    
    //Method that Modify the User Info
    public function Edit_profile($FIRST, $EMAIL, $POSITION, $GENDER, $ID, $PHONE, $BIRTHDAY, $ABOUT, $STATUS)
    {
      if ($this->verify_teatcher($ID)) {
        $query = "UPDATE professor SET FIRST = '$FIRST',
          EMAIL = '$EMAIL',
          POSITION = '$POSITION',
          GENDER = '$GENDER',
          PHONE = '$PHONE',
          BIRTHDAY = '$BIRTHDAY',
          ABOUT = '$ABOUT',
          STATUS = '$STATUS'
          WHERE ID_PROF = '$ID';";
      } else {
        $query = "UPDATE etudiant SET FIRST = '$FIRST',
          EMAIL = '$EMAIL',
          POSITION = '$POSITION',
          GENDER = '$GENDER',
          PHONE = '$PHONE',
          BIRTHDAY = '$BIRTHDAY',
          ABOUT = '$ABOUT',
          STATUS = '$STATUS'
          WHERE ID = '$ID';";
      }     
      $this->db->query($query);
      Session($FIRST,$EMAIL,$POSITION,$GENDER,$PHONE,$BIRTHDAY,$ID,$ABOUT,$STATUS);
      header('Location: http://localhost/web/View/Profil.php');
    }
    
    
    public function View_profile($FIRST)
    {
      $query = "SELECT * FROM etudiant WHERE FIRST = '$FIRST'";
      $result = $this->db->query($query);
      $user = $result->fetch(PDO::FETCH_ASSOC);
      if (!$user) {
        $query = "SELECT * FROM professor WHERE FIRST = '$FIRST'";
        $result = $this->db->query($query);
        $user = $result->fetch(PDO::FETCH_ASSOC);
        header('Location: http://localhost/web/View/Profil_show.php?' . http_build_query($user));
      } else {
        //apparently this code pass the user data as an URL parameter to the other page, I can later access the data passed throught the URL using the $_GET
        header('Location: http://localhost/web/View/Profil_show.php?' . http_build_query($user));
      }
    }
    public function Insert_Message($sender_id,$message)
    {
      if ($_SESSION['user_position'] != "teatcher")
      {
        $query = "INSERT INTO messages (message, sender_id) VALUES ('$message', '$sender_id')";
        $this->db->query($query);
        header('Location: http://localhost/web/View/Chat.php');
      }
      else
      {
        $query = "INSERT INTO messages_prof (message, sender_prof_id) VALUES ($message, $sender_id)";
        $this->db->query($query);
        header('Location: http://localhost/web/View/Chat.php');
      }
    }
    public function Delete_User($ID)
    {
      $query = "DELETE FROM etudiant WHERE ID = '$ID'";
      $this->db->query($query);
      header('Location: http://localhost/web/View/dashboard.php');
    }
    
}