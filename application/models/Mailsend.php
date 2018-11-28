<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailsend extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->library('email');
    }

   public function send_mail($from='form@webliststore.com',$to='form@webliststore.com',$subject='Mail from Uriah Solution',$message='',$cc='form@webliststore.com',$bcc=''){
        $mail_subject = $subject;
	    $message_html = '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
                        <style type="text/css">
                        html, body {margin: 0; padding: 0; outline: 0; font-family: "Lucida Grande",Verdana,Arial,Helvetica,sans-serif; font-size: 13px; font-weight: normal; width:100%; height:100%; }
                        body{min-width:320px; margin:0; padding:0; background:#fff;}
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
                            <td width="500" height="80" align="left" bgcolor="#FFFFFF" style="font-size: 0; line-height: 0; padding: 0 10px">
                            <span style="font-size: 0; line-height: 0"><a href="https://www.uriahsolution.com" target="_blank" rel="noreferrer"><img src="https://www.uriahsolution.com/img/logo-light.png" width="200" border="0"></a></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" bgcolor="#0093de" style="padding: 30px; font-size: 16px;font-weight: bold; text-align: center; color: #fff">
                            <span style="color:#fff;">BusyToEasy! </span> THE WAY TO GROW UP & SUCCEED</td>
                        </tr>
                        <tr>
                        <td colspan="4" style="padding: 30px 20px 10px; font-size: 14px">
                            <div>'.$message.'</div>
                            <br><br>
                            <div>We are known for providing affordable, professional, responsive, and custom web designing as per the client’s requirements. <a href="https://www.uriahsolution.com" style="color:#de1d3c;"><b>BusyToEasy</b></a>.</div>
                            <br></td>
                        </tr>
                        <tr><td colspan="4" style="padding: 20px; font-size: 14px"><div style="font-size: 14px"> <span>Regards,</span></div>
                            <div style="font-size: 14px; padding-top: 10px"> <span>BusyToEasy</span> </div></td>
                        </tr>
                        <tr>
                        <td colspan="4" style="padding: 10px 20px; font-size: 14px;background: #0093de;color:#fff;font-size: 10px;">
                        <p>World Vision Cable is a pioneer internet and Cable network provider in Bangalore. Our motto is to become a seamless service provider across the city both for businesses and home at various levels of internet speed.</p>
                        </td></tr></tbody></table></div></div></div></body></html>';
	    
        	    $config['protocol']    = 'sendmail';
                $config['mailpath']    = '/usr/sbin/sendmail';
                //$config['smtp_timeout'] = '5'; 
                $config['charset']    = 'utf-8';
                $config['mailtype'] = 'html'; // or html
                $config['validation'] = TRUE;
      
              $config['wordwrap'] = TRUE;
              $config['smtp_host'] = 'mail.webliststore.in';
              $config['smtp_port'] = '465';
              $config['smtp_user'] = 'form@webliststore.in';
              $config['smtp_pass'] = 'weblist@123';

      $this->email->initialize($config);
     
      $this->email->to($to);
      if(isset($bcc)){$this->email->bcc($bcc);}
      $this->email->cc($cc);
      //$this->phpmailer->IsMail();
      $this->email->from($from);
      //$this->email->IsHTML(true);
      $this->email->subject($mail_subject);
      $this->email->message($message_html);
      if($this->email->Send()) {
        return '1';
      }
      else {
        return '0';
      }
    }
    
}