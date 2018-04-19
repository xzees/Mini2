<?php

namespace Core\Provider;

use PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Config;
use \InlineStyle\InlineStyle;

class MailProvider
{
    protected $_mail;
    protected $_root;
    protected $_content; 
    public function __construct()
    {
        $this->_root = dirname(dirname(__DIR__));
        $this->_mail = new PHPMailer(true);
    }
    public static function to($to, $func=null)
    {
        $obj = (new self);
        try {
            $obj->_mail->Subject   	= 'test';
            $obj->_mail->Body      	= 'test'; 
            $obj->_mail->CharSet 		= "UTF-8";

            if(is_array($to)){ 
                foreach($to as $k=>$v)
                {
                    $obj->_mail->addAddress($v);
                }
            }else{
                $obj->_mail->addAddress($to);
            }
            
            $obj->_mail->isHTML(true);
        
            $config = Config::getMail();

            $obj->_mail->setFrom($config['SMTP']['from']['mail'],$config['SMTP']['from']['name']);
            $obj->_mail->Host		= $config['SMTP']['Host'];
            $obj->_mail->Port 		= $config['SMTP']['Port'];
            $obj->_mail->Username 	= $config['SMTP']['Username'];
            $obj->_mail->Password 	= $config['SMTP']['Password'];
            
            if($func){
                $func($obj);
            }
            if($obj->_mail->SMTPAuth == true){
                $obj->_mail->IsSMTP();
            }
            if($obj->_content!="")
            {
                $obj->_content = new InlineStyle($obj->_content);
                $obj->_content->applyStylesheet($obj->_content->extractStylesheets());
                
                $obj->_content = $obj->_content->getHTML();
                $obj->_mail->Body = $obj->_content;
            }
            $obj->_mail->send();
            
            return true;
        } catch (Exception $e) {
            return 'Message could not be sent. Mailer Error: '. $obj->_mail->ErrorInfo;
        }
    }
    public function smtp($bool=true)
    {
        $this->_mail->SMTPAuth = $bool;
        return $this;
    }
    public function subject($str)
    {
        $this->_mail->Subject = $str;
        return $this;
    }
    public function body($path,$array)
    {
        if(file_exists($this->_root.$path.'.phtml'))
        {
            if(count($array)>0){
                foreach($array as  $k=>$v)
                {
                    $this->$k = $v;   
                }
            }
            ob_start();
            require $this->_root.$path.'.phtml';
            $this->_content = ob_get_clean();
            
        }else{
            trigger_error("Could not find file {$path}", E_USER_ERROR);
        }
        
        return $this;
    }

    public function layout($path,$array)
    {
        if(file_exists($this->_root.$path.'.phtml'))
        {
            if(count($array)>0){
                foreach($array as  $k=>$v)
                {
                    $this->$k = $v;   
                }
            }
            ob_start();
            require $this->_root.$path.'.phtml';
            $this->_content = ob_get_clean();
        }else{
            trigger_error("Could not find file {$path}", E_USER_ERROR);
        }
        
        return $this;
    }
    
    public function charset($str)
    {
        $this->_mail->CharSet = $str;
        return $this;
    }
    public function from($mail,$name=null)
    {
        if($name){
            $this->_mail->setFrom($mail,$name);
        }else{
            $this->_mail->setFrom($mail);
        }
        return $this;
    }
    public function reply($arr)
    {
        if(isset($arr[0]))
        {
            foreach($arr as $k=>$v)
            {
                if(isset($v['name'])){
                    $this->_mail->addReplyTo($v['mail'],$v['name']);
                }else{
                    $this->_mail->addReplyTo($v);
                }
            }
        }else{
            if(isset($arr['name'])){
                $this->_mail->addReplyTo($arr['mail'],$arr['name']);
            }else{
                $this->_mail->addReplyTo($arr);
            }
        }
        
        return $this;
    }

    public function attachfile($arr)
    {
        if(isset($arr[0]))
        {
            foreach($arr as $k=>$v)
            {
                if(isset($v['path'])){
                    $this->_mail->addAttachment($this->_root.$v['path'],$v['name']);
                }else{
                    $this->_mail->addAttachment($this->_root.$v);
                }
            }
        }else{
            if(isset($arr['path'])){
                $this->_mail->addAttachment($this->_root.$arr['path'],$arr['name']);
            }else{
                $this->_mail->addAttachment($this->_root.$arr);
            }
        }
        
        return $this;
    }

    public function cc($arr)
    {
        if(isset($arr[0]))
        {
            foreach($arr as $k=>$v)
            {
                $this->_mail->addCC($v);
            }
        }else{
            $this->_mail->addCC($arr);
        }
        
        return $this;
    }

    public function bcc($arr)
    {
        if(isset($arr[0]))
        {
            foreach($arr as $k=>$v)
            {
                $this->_mail->addBCC($v);
            }
        }else{
            $this->_mail->addBCC($arr);
        }
        
        return $this;
    }   
}
/*
example 

    Mail::to('test@gmail.com',function($mail){
        $mail->subject('Please fill from exit interview')
        ->body('/views/mail/from_exit_interview',
            array(
                'title'=>'Please fill From exit interview',
                'link'=>'...',
                'click'=>'Click to from',
                'detail'=>' Dear P'
            )
        )
        ->layout('/views/mail/layout/layout',
            array(
                'header'=>'Club21',
                'footer'=>'© 2017 Club21. All rights reserved.'
            )
        )
        ->smtp(true);
    });
*/
