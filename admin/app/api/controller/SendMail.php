<?php
namespace app\api\controller;
use think\Loader;
use think\Db;
class SendMail{
    /**
     * [send description]
     * @param  string $html  [发送HTML邮件模板]
     * @param  [type] $email [收件人email]
     * @param  [type] $name  [收件人姓名]
     * @param  string $msg   [普通邮件内容]
     * @param  string $type   [发送邮件类型0文字邮件，1HTML格式内容]
     *
     */
    public function send($msg,$type = 0,$email = 'service@morris-cloud.com',$name = 'admin'){
        Loader::import('phpmail.Phpmailer', EXTEND_PATH);
        Loader::import('phpmail.Smtp', EXTEND_PATH);
        $mail  = new \PHPMailer();
        $mail->CharSet    ="UTF-8";                 //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置为 UTF-8
        $mail->IsSMTP();                            // 设定使用SMTP服务
        $mail->SMTPAuth   = true;                   // 启用 SMTP 验证功能
        $mail->SMTPSecure = "ssl";                  // SMTP 安全协议
        $mail->Host       = "smtp.mxhichina.com";       // SMTP 服务器
        $mail->Port       = 465;                    // SMTP服务器的端口号
        $mail->Username   = "service@morris-cloud.com";  // SMTP服务器用户名
        $mail->Password   = "Myfx1213";        // SMTP服务器密码(授权码)
        $mail->SetFrom('service@morris-cloud.com', 'service@morris-cloud.com');    // 设置发件人地址和名称
        $mail->AddReplyTo($email,$name);// 设置邮件回复人地址和名称
        $mail->Subject    = '标题';                     // 设置邮件标题

        $mail->AltBody    = "为了查看该邮件，请切换到支持 HTML 的邮件客户端";
        //发送HTML模板邮件
        if($type == 0){
            $mail->MsgHTML($msg);  // 设置邮件内容
        }else{
            $mail->IsHTML(true); //支持html格式内容
            $mail->MsgHTML($msg);  // 设置邮件内容
        }


        $mail->AddAddress($email, $name);//收件人地址
        //$mail->AddAttachment("test.png"); // 附件
        if(!$mail->Send()) {
            //echo "发送失败：" . $mail->ErrorInfo;
            return false;
        } else {
            return true;
            //echo "恭喜，邮件发送成功！";
        }
    }
}