<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
       private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
            //$user= Usuarios::model()->find("LOWER(usr_ruc)=?",array(strtolower($this->username)));
            
            $user=Usuarios::model()->find(array(
                                'condition' => 'LOWER(usr_ruc)=:usr_ruc and  usr_estado=:usr_estado ',
                                'params' => array(':usr_ruc'=>strtolower($this->username),'usr_estado'=>true) 
                            ));
               // print_r($user);
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(md5($this->password) !== $user->usr_password){
                     
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
                }
		else
                    {
                        $this->_id=$user->usr_codigo;
                        $this->username=$user->usr_ruc;
                        $this->setState("name",$user->usr_ruc); 
//                        
//                    $this->setState("nombres",$user->usr_nombre);
//                        $this->setState("cedula",$user->usr_cedula); 
			$this->errorCode=self::ERROR_NONE;
                     }
		return !$this->errorCode;
            
//		$users=array(
//			// username => password
//			'demo'=>'demo',
//			'admin'=>'admin',
//		);
//		if(!isset($users[$this->username]))
//			$this->errorCode=self::ERROR_USERNAME_INVALID;
//		elseif($users[$this->username]!==$this->password)
//			$this->errorCode=self::ERROR_PASSWORD_INVALID;
//		else
//			$this->errorCode=self::ERROR_NONE;
//		return !$this->errorCode;
	}
    public function getId()
    {
        return $this->_id;
    }
}

    