<?php
include"PHPMailer/src/PHPMailer.php";
include"PHPMailer/src/Exception.php";
include"PHPMailer/src/OAuth.php";
include"PHPMailer/src/POP3.php";
include"PHPMailer/src/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



$mail = new PHPMailer(true);
// print_r($mail);

   //         $mail->CharSet = 'UTF-8';
			// // dùng try catch để bắt lỗi;
			try {
			    //Server settings
			    $mail->SMTPDebug = 0;                                 // =2 gửi không thành công hoặc thành công vẫn show ra thông tin mail,=0 sẽ không show
			    $mail->isSMTP();                                      // 
			    $mail->Host = 'smtp.gmail.com';  					  // sủ dụng sever
			    $mail->SMTPAuth = true;                               // Enable SMTP authentication
			    $mail->Username = 'domanh011020@gmail.com';           // mail để gửi thông tin mail
			    $mail->Password = 'ealhavkzormmwrcp';                 // mật khẩu của app mail lấy trong thông tin gmail vào quản lý tài khoản->bảo mật->mật khẩu ứng dụng
			    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			    $mail->Port = 587;                                    // TCP port to connect to
			 
			    //gửi từ mail nào
			    $mail->setFrom('domanh011020@gmail.com', 'Admin');             
			    // đến mail cho nhiều người
			    $mail->addAddress($maildathang, 'khach hang');     // Add a recipient
			    // $mail->addAddress('ellen@example.com');               // Name is optional
			    // $mail->addReplyTo('info@example.com', 'Information');
			    // mail backup
			    $mail->addCC('domanh011020@gmail.com');
			    // $mail->addBCC('bcc@example.com');
			 
			    //Attachments
			    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			 
			    //Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    // tiêu đề mail
			    $mail->Subject = $tieude;
			    // nội dung mail
			    $mail->Body    = $noidung;
			    // 
			    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			 
			    $mail->send();
			    echo 'Tin nhắn đã được gửi đi';
				} catch (Exception $e) {
				    echo 'Tin nhắn chưa được gửi đi. lỗi: ', $mail->ErrorInfo;
				}
 ?>