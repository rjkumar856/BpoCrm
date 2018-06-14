<?php
require_once 'db.php';
class USER{
	private $conn;
    	public function __construct()
    	{
    		$database = new Database1();
    		$db = $database->dbConnection();
    		$this->conn = $db;
        }
	 
    	public function runQuery($sql)
    	{
    		$stmt = $this->conn->prepare($sql);
    		return $stmt;
    	}
	
    	public function lasdID()
    	{
    		$stmt = $this->conn->lastInsertId();
    		return $stmt;
    	}
	
    	public function login($email,$upass){
    		try
    		{
    			$stmt = $this->conn->prepare("SELECT * FROM user WHERE cusEmail=:email_id OR user_name=:email_id");
    			$stmt->execute(array(":email_id"=>$email));
    			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    			
    			if($stmt->rowCount() > 0)
    			{
    				if($userRow['cusStatus']=="Y")
    				{
    					if($userRow['cusPassword']==md5($upass)){
    						$_SESSION['userSession'] = $userRow['id'];
    						$_SESSION['user_details'] = array("id"=>$userRow['id'],"user_name"=>$userRow['user_name'],"first_name"=>$userRow['first_name'],"last_name"=>$userRow['last_name'],
    						"email"=>$userRow['cusEmail'],"password"=>$userRow['cusPassword'],"mobile"=>$userRow['mobile'],"address1"=>$userRow['address1'],
    						"city"=>$userRow['city'],"state"=>$userRow['state'],"country"=>$userRow['country'],"pincode"=>$userRow['pincode'],"usertype"=>$userRow['usertype'],'reserve_id'=>$userRow['reserve_id']);
    						return true;
    					}
    					else
    					{
    						$_SESSION['userPasswordWrong'] = "Password dint matched with the given email id";
    						header("Location: login");
    						exit;
    					}
    				}
    				else
    				{
    					$_SESSION['userInactive'] = "User is inactive we have sent a email please check to active.";
    					header("Location: login");
    					exit;
    				}	
    			}
    			else
    			{
    				$_SESSION['userNotExist'] = "User not found please register as new user";
    				header("Location: login");
    				exit;
    			}		
    		}
    		catch(PDOException $ex)
    		{
    			echo $ex->getMessage();
    		}
    	}
	
    	public function redirect($url)
    	{
    		header("Location: ".DIR_SYSTEM.$url);
    	}
    	
    	public function logout(){
    		unset($_SESSION['userSession']);
    		unset($_SESSION['user_details']);
    		session_destroy();
    	}
	
	    public function send_mail_post($email,$message,$subject)
        {
        $message_html = '<!DOCTYPE html>
        <html lang="en">
        <head>
        <title>BPO Services in Bangalore, Karnataka, India</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="BPO Services in Bangalore" />
        <meta name="keywords" content="BPO Services in Bangalore" />
        <meta name="Abstract" content="BPO Services in Bangalore">
        <meta name="Subject" content="BPO Services in Bangalore">
        <meta name="robots" content="index, follow">
        <meta name="format-detection" content="telephone=no"/>
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <style type="text/css">
        html, body {  margin: 0; padding: 0; outline: 0; font-family: "Lucida Grande",Verdana,Arial,Helvetica,sans-serif; font-size: 13px; font-weight: normal; width:100%; height:100%; }
        body{min-width:320px; margin:0; padding:0; background:#fff; }
        *, *:before, *:after { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }
        .main { width:100%; margin:0; padding:0; display:block; position:relative; }
        .main-center {background: #f6f6f6; width:100%; max-width:800px; margin:0 auto; display:block; }
        .center { width:100%; max-width:650px; margin:0 auto; display:block; padding-top:0px; }
        </style>
        </head>
        <body class="background">
        <div class="main">
        <div class="main-center">
        <div class="center">
        <table style="border: 0px solid #ccc" border="0" cellpadding="0" cellspacing="0" align="center" width="600" bgcolor="#FFFFFF">
        <tbody>
        <tr>
            <td colspan="4" width="500" height="80" align="left" bgcolor="#FFFFFF" style="font-size: 0; line-height: 0; padding: 0 10px">
            <span style="font-size: 0; line-height: 0"><a href="https://www.webliststore.in" target="_blank" rel="noreferrer"><img src="https://www.webliststore.in/image/demo/logos/theme_logo.png" border="0"></a></span>
            </td>
        </tr>
        <tr>
            <td colspan="4" bgcolor="#bf023c" style="padding: 30px; font-size: 16px;font-weight: bold; text-align: center; color: #fff"><span style="color:#fff;">BPO CRM! </span> Now Sell, Buy, List and shop in the Best Way</td>
        </tr>
        <tr>
            <td colspan="4" style="padding: 30px 20px 10px; font-size: 14px">
            <div>'.$message.'</div>
            <br>
            <br>
            <div>Grow your business online. Grow your business with <a href="https://www.webliststore.com/bpo_crm/" style="color:#de1d3c;"><b>BPO CRM</b></a>.</div>
            <br>
            </td>
        </tr>
        <tr><td colspan="4" style="padding: 20px; font-size: 14px"><div style="font-size: 14px"> <span>Regards,</span></div>
            <div style="font-size: 14px; padding-top: 10px"> <span>Team Weblist Store</span> </div></td>
        </tr>
        <tr>
        <td colspan="4" style="padding: 10px 20px; font-size: 14px;background: #bf023c;color:#fff;font-size: 10px;">
        <p>The information contained in this e-mail is private & confidential and may also be legally privileged. If you are not the intended recipient of this mail, please notify us, preferably by e-mail; and do not read, copy or disclose the contents of this message to anyone. Whilst we have taken reasonable precautions to ensure that any attachment to this e-mail has been swept for viruses, e-mail communications cannot be guaranteed to be secure or error free, as information can be corrupted, intercepted, lost or contain viruses. We do not accept liability for such matter or their consequences.</p>
        </td>
        </tr>
        <tr>
            <td colspan="4" bgcolor="#5b5b5b" style="padding: 0; text-align: center">
            <a href="https://www.webliststore.in/support-app"><img src="https://www.webliststore.in/image/app-download-mail.jpg" alt="app-download" border="0" usemap="#m_-8518122674246736728_Map"></a>
            </td>
        </tr>
        </tbody>
        </table>
        </div>
        </div>
        </div>
        </body>
        </html>';
        
        $this->send_mail($email,$message_html,$subject);
        }
	
        public function send_mail($email,$message,$subject)
        {                       
        require_once(DIR_APPLICATION.'include/mailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP(); 
        $mail->SMTPAuth   = true;                  
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "webliststore.com";      
        $mail->Port       = 465;             
        $mail->AddAddress($email);
        $mail->Username="form@webliststore.com";  
        $mail->Password="weblist@123";            
        $mail->SetFrom('form@webliststore.com','Weblist Store');
        $mail->AddReplyTo("form@webliststore.com","Weblist Store");
        $mail->AddCC("form@webliststore.com", "Weblist Store");
        $mail->Subject= $subject;
        $mail->MsgHTML($message);
        $mail->Send();
        }
	
    	public function getClientIP()
        {
        $ipaddress = '';
    		if (isset($_SERVER['HTTP_CLIENT_IP'])){
        		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    		}
    		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    		}
    		else if(isset($_SERVER['HTTP_X_FORWARDED'])){
        		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    		}
    		else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
        		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    		}
    		else if(isset($_SERVER['HTTP_FORWARDED'])){
        		$ipaddress = $_SERVER['HTTP_FORWARDED'];
    		}
    		else if(isset($_SERVER['REMOTE_ADDR'])){
        		$ipaddress = $_SERVER['REMOTE_ADDR'];
    		}
    		else{
        		$ipaddress = 'UNKNOWN';
    		}
    		return $ipaddress;
    }

}