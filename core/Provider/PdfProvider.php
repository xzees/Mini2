<?php

namespace Core\Provider;

use \mPDF;
use Config;
use \InlineStyle\InlineStyle;

class PdfProvider
{
    protected $_pdf;
    protected $_root;
    protected $_content; 
    public function __construct()
    {
        header('Content-Type: text/html; charset=utf-8'); 
        $this->_root = dirname(dirname(__DIR__));
        $this->_pdf = new mPDF('th');
    }
    public static function create($path, $func=null)
    {
        $obj = (new self);
        $obj->_content = '<h1>สวัสดี ชาวโลก!</h1>';
        if($func){
            $func($obj);
        }
        //$obj->_pdf->allow_charset_conversion = true;
        $obj->_pdf->WriteHTML($obj->_content);
        $obj->_pdf->Output($obj->_root.$path,'F');
        return $obj->_root.$path;
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
