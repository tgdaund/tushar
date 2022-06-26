<?php

 $subject ="(TESTING) Monthly Attendance Sheet   Under Below Employee   .";
        $message = " gdfgdgdggsdgggsg";
        $header = "From:tusharvtc0@gmail.com \r\n";
        $header .= "Cc: \r\n";
        $header .= "Reply-To:  \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        $retval = mail ('tusharvtc0@gmail.com',$subject,$message,$header);
         
          if( $retval == true ) { 
              echo"$header";
        echo "<script>alert('Mail sent successfully  tusharvtc0@gmail.com')</script>";echo "<br>";
              
          }
          else{
            echo"message here<br> $message";
               exit("Failed To Mail send <br>");

               echo"message here<br> $message";
          }
?>