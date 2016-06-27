<?php

/////security must be updated!!!!!!!!!!!!!!!!!
$count="red";
$db="off";
$status=0;
$included_files = get_included_files();

foreach ($included_files as $filename) {
$arrcook[] = $filename;
} 

    if (in_array("/home/wheresthegrub/public_html/admin/_settings.php", $arrcook)) {
    $db="on";
    $status+=1;
} else {
  echo "There was an error! Possible malicious activity detected. This has been reported.<br>";
}
    if (in_array("/home/wheresthegrub/public_html/admin/index.php", $arrcook)) {
      $status+=1;
} else {
  echo "There was a problem executing our configuration.";
  if ($db=="off") {} else {
    $ip=getRealIpAddr(); 
    echo "There was an error! Possible malicious activity detected. This has been reported.<br>";
exit();
  }
}
    if (in_array("/home/wheresthegrub/public_html/admin/_inc.php", $arrcook)) {
      $status+=1;
} else {
  echo "There was a problem executing our configuration.";
  if ($db=="off") {} else {
    $ip=getRealIpAddr(); 
    echo "There was an error! Possible malicious activity detected. This has been reported.<br>";
exit();
  }
}
if ($status==3) {
  $count="green";
}
if ($count=="green") {
  ///fuck yea!
} else {
exit();
}

$page = $_GET['z'];
        if ($page=="main") {
          echo "<table width='100%' border='0' cellspacing='5' cellpadding='5'>
  <tr>
    <th scope='col' align='left' valign='top'><h1>Welcome to the Private Sector Vapors Admin</h1></th>
  </tr>
  <tr>
    <th scope='row' align='left' valign='top'>Welcome! If you have any problems you can send an email to joseph.opanel@privatesectorvapors.com</th>
  </tr>
  <tr>
    <th scope='row' align='left' valign='top'>ENJOY</a></th>
  </tr>
</table>";



if (empty($_GET['update'])){
$sql2 = "select * from `settings`";
      $result2 =  mysql_query($sql2) or die(mysql_error());
      while($row2 = mysql_fetch_array($result2)){
        $title=$row2['title'];
$desc=$row2['desc'];
$keywords=$row2['keywords'];
$services1=$row2['services1'];
$services2=$row2['services2'];
$services3=$row2['services3'];
$services4=$row2['services4'];
$about = $row2['about'];
$whatis = $row2['whatis'];
}
?>
<br />
<form action='?page=admin&z=main&update=true' method='post'>
Page Title (16-70 characters): <input type="text" value="<?php echo $title;?>" name="title"/><br />
Page Description (70-160 characters) : <input type="text" value="<?php echo $desc;?>" name="desc"/><br />
Keywords: <input type="text" value="<?php echo $keywords;?>" name="keywords"/><br />
<input type="submit" />
</form>
<?php 
} else {
  $title = $_POST['title'];
$title=mysql_real_escape_string($title);
$desc = $_POST['desc'];
$desc=mysql_real_escape_string($desc);
$keywords = $_POST['keywords'];
$keywords=mysql_real_escape_string($keywords);
if (!isset($_POST['whatis']) || empty($_POST['whatis'])) {$whatis="";} else {$whatis=$_POST['whatis']; $whatis=mysql_real_escape_string($whatis);}
if (!isset($_POST['about']) || empty($_POST['about'])) {$about="";} else {$about=$_POST['about']; $about=mysql_real_escape_string($about);}
if (!isset($_POST['services1']) || empty($_POST['services1'])) {$services1="";} else {$services1=$_POST['services1']; $services1=mysql_real_escape_string($services1);}
if (!isset($_POST['services2']) || empty($_POST['services2'])) {$services2="";} else {$services2=$_POST['services2']; $services2=mysql_real_escape_string($services2);}
if (!isset($_POST['services3']) || empty($_POST['services3'])) {$services3="";} else {$services3=$_POST['services3']; $services3=mysql_real_escape_string($services3);}
if (!isset($_POST['services4']) || empty($_POST['services4'])) {$services4="";} else {$services4=$_POST['services4']; $services4=mysql_real_escape_string($services4);}
  $sql = "update `settings` set `whatis`='$whatis', `about`='$about', `title`='$title', `desc`='$desc', `keywords`='$keywords', `services1`='$services1', `services2`='$services2', `services3`='$services3', `services4`='$services4'";
  mysql_query($sql) or die(mysql_error());
  $url = $_SERVER['HTTP_REFERER'];
  header("Refresh: 3; url=$url");
}


?>
<table width="100%" border="0">
  <tr>
    <td>Total Users</td>
    <td><?php     
$num=0;
$sql222 = "select * from `users`";
    $result222 = mysql_query($sql222) or die(mysql_error());
    while($row222 = mysql_fetch_array($result222)){ 
    $num+=1; } echo $num; ?></td>
  </tr>
  
</table>
<?php
        }



        if ($page=="datamanager") {
if (!isset($_GET['action']) || empty($_GET['action'])) {$action="nothing";} else {$action = $_GET['action'];}
if ($action == "generateleads") {
  set_time_limit(0);

  $keyword = $_POST['keyword'];
  scanyellowpages($keyword);
  echo "breaking the internet in progress.. our server may slow";
}
?>
<h1>[Yellow Pages] Create New Leads by Keyword</h1>
<form action="?page=admin&z=datamanager&action=generateleads" method="POST">
  <input type="text" name="keyword" placeholder="keyword"> <br>
  <input type="submit"></form>
  <br>
<?php
  $num_per_page = 500;
  if (isset($_GET['i'])) {$i = $_GET['i']; } else {$i = 1; }
    if (!isset($_GET['kid']) || empty($_GET['kid'])) {$add = ""; $add2=""; } else {$add = " WHERE `kid`='".$_GET['kid']."'"; $add2= "&kid=".$_GET['kid']."";}
  if (!isset($_POST['keyword']) || empty($_POST['keyword'])) {$add = ""; $add2=""; } else {$add = " WHERE `kid`='".$_POST['keyword']."'"; $add2= "&kid=".$_POST['keyword']."";}
  $start_from = ($i-1) * $num_per_page;
  $leads = [];
$totalleads = 0;
  $sql = "SELECT * FROM `leads`$add ORDER BY `id` ASC LIMIT $start_from, $num_per_page";
  $result = mysql_query($sql) or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $totalleads+=1;
    $lid = $row['id'];
    $kid = $row['kid'];
    $name = $row['name'];
    $address = $row['address'];
    $phone = $row['phone'];
    $sql2 = "SELECT * FROM `keywords` WHERE `id`='".$kid."'";
    $result2 = mysql_query($sql2) or die(mysql_error());
    while ($row2 = mysql_fetch_array($result2)) {
      $keyword = $row2['name'];
    }
    $leads[] = array($lid,$name,$address,$phone,$keyword);
  }
  ?>
  <section class="panel panel-default">
                <header class="panel-heading">
                  Leads
                </header>
                <form action="?page=callcenter&z=leads" method="POST">
                <div class="row text-sm wrapper">
                  <div class="col-sm-5 m-b-xs">
                    <select name="keyword" class="input-sm form-control input-s-sm inline">
                      <?php 
                      $sql3 = "SELECT * FROM `keywords`";
                      $result3 = mysql_query($sql3) or die(mysql_error());
                      while ($row3 = mysql_fetch_array($result3)) {
                        echo "<option value='".$row3['id']."'>".$row3['name']."</option>";
                      }
                      ?>
                    </select>
                    <input type="submit" class="btn btn-sm btn-default" value="Apply">                
                  </div> 
                </div>
            </form>
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th width="20"><input type="checkbox"></th>
                        <th class="th-sortable" data-toggle="class">Name
                          <span class="th-sort">
                            <i class="fa fa-sort-down text"></i>
                            <i class="fa fa-sort-up text-active"></i>
                            <i class="fa fa-sort"></i>
                          </span>
                        </th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Keyword</th>
                        <th width="30"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      
                      foreach ($leads as $value) {
                        ?>
                        <tr>
                          <td><?php echo $value[0]; ?></td>
                          <td><?php echo $value[1]; ?></td>
                          <td><?php echo $value[2]; ?></td>
                          <td><?php echo $value[3]; ?></td>
                          <td><?php echo $value[4]; ?></td>
                          <td><a href="?page=accountmanager&z=vendors&action=start&id=<?php echo $value[0]; ?>">Contact</a></td>

                        
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <?php 
            $sqr = "SELECT * FROM `leads`$add";
                        $rs_result = mysql_query($sqr);
                        $total_records = mysql_num_rows($rs_result);
                        $total_pages = ceil($total_records / $num_per_page);
                    ?>
                <footer class="panel-footer">
                  <div class="row">
                    <div class="col-sm-4 text-center">
                      <small class="text-muted inline m-t-sm m-b-sm">showing <?php echo $totalleads; ?>-<?php echo $total_records; ?> of <?php echo $total_records; ?> leads</small>
                    </div>
                    <div class="col-sm-4 text-right text-center-xs">                
                      <ul class="pagination pagination-sm m-t-none m-b-none">
                        <?php 
                        
                        if ($total_pages > 0) {
                        echo "<li><a href='?page=callcenter&z=leads".$add2."&i=1'><i class='fa fa-chevron-left'></i></a></li>";
                      }
                       for ($r=1; $r<=$total_pages; $r++) {
                        echo "<li><a href='?page=callcenter&z=leads".$add2."&i=".$r."'>".$r."</a></li>";
                       }
                      if ($total_pages > 0) {
                        echo "<li><a href='?page=callcenter&z=leads".$add2."&i=".$total_pages."'><i class='fa fa-chevron-right'></i></a></li>";
                    }
                        ?>
                      </ul>
                    </div>
                  </div>
                </footer>
              </section>
              <?php


        } // end datamanager page

if ($page=="massemail") {

  if (!isset($_GET['a'])) {

  echo " Submit News<hr>
    <form action='?page=admin&z=massemail&a=go' enctype='multipart/form-data' method='post'>
Once you press submit it is authorized to go through. It will rummage through the list of emails and send them out. <br>
    <b>Subject:</b> <input type='text' name='title'><br>
  
        <br>
    
    <b>Body</b><br>
  ";
?>
  
  <textarea cols="80" id="editor1" name="editor1" rows="10"></textarea>
      <script>

        CKEDITOR.replace( 'editor1', {
          /*
           * Ensure that htmlwriter plugin, which is required for this sample, is loaded.
           */
          extraPlugins: 'htmlwriter',

          /*
           * Style sheet for the contents
           */
          contentsCss: 'body {color:#000; background-color#:FFF;}',

          /*
           * Simple HTML5 doctype
           */
          docType: '<!DOCTYPE HTML>',

          /*
           * Allowed content rules which beside limiting allowed HTML
           * will also take care of transforming styles to attributes
           * (currently only for img - see transformation rules defined below).
           *
           * Read more: http://docs.ckeditor.com/#!/guide/dev_advanced_content_filter
           */
          allowedContent:
            'h1 h2 h3 p pre[align]; ' +
            'blockquote code kbd samp var del ins cite q b i u strike ul ol li hr table tbody tr td th caption; ' +
            'img[!src,alt,align,width,height]; font[!face]; font[!family]; font[!color]; font[!size]; font{!background-color}; a[!href]; a[!name]',

          /*
           * Core styles.
           */
          coreStyles_bold: { element: 'b' },
          coreStyles_italic: { element: 'i' },
          coreStyles_underline: { element: 'u' },
          coreStyles_strike: { element: 'strike' },

          /*
           * Font face.
           */

          // Define the way font elements will be applied to the document.
          // The "font" element will be used.
          font_style: {
            element: 'font',
            attributes: { 'face': '#(family)' }
          },

          /*
           * Font sizes.
           */
          fontSize_sizes: 'xx-small/1;x-small/2;small/3;medium/4;large/5;x-large/6;xx-large/7',
          fontSize_style: {
            element: 'font',
            attributes: { 'size': '#(size)' }
          },

          /*
           * Font colors.
           */

          colorButton_foreStyle: {
            element: 'font',
            attributes: { 'color': '#(color)' }
          },

          colorButton_backStyle: {
            element: 'font',
            styles: { 'background-color': '#(color)' }
          },

          /*
           * Styles combo.
           */
          stylesSet: [
            { name: 'Computer Code', element: 'code' },
            { name: 'Keyboard Phrase', element: 'kbd' },
            { name: 'Sample Text', element: 'samp' },
            { name: 'Variable', element: 'var' },
            { name: 'Deleted Text', element: 'del' },
            { name: 'Inserted Text', element: 'ins' },
            { name: 'Cited Work', element: 'cite' },
            { name: 'Inline Quotation', element: 'q' }
          ],

          on: {
            pluginsLoaded: configureTransformations,
            loaded: configureHtmlWriter
          }
        });

        /*
         * Add missing content transformations.
         */
        function configureTransformations( evt ) {
          var editor = evt.editor;

          editor.dataProcessor.htmlFilter.addRules( {
            attributes: {
              style: function( value, element ) {
                // Return #RGB for background and border colors
                return CKEDITOR.tools.convertRgbToHex( value );
              }
            }
          } );

          // Default automatic content transformations do not yet take care of
          // align attributes on blocks, so we need to add our own transformation rules.
          function alignToAttribute( element ) {
            if ( element.styles[ 'text-align' ] ) {
              element.attributes.align = element.styles[ 'text-align' ];
              delete element.styles[ 'text-align' ];
            }
          }
          editor.filter.addTransformations( [
            [ { element: 'p', right: alignToAttribute } ],
            [ { element: 'h1',  right: alignToAttribute } ],
            [ { element: 'h2',  right: alignToAttribute } ],
            [ { element: 'h3',  right: alignToAttribute } ],
            [ { element: 'pre', right: alignToAttribute } ]
          ] );
        }

        /*
         * Adjust the behavior of htmlWriter to make it output HTML like FCKeditor.
         */
        function configureHtmlWriter( evt ) {
          var editor = evt.editor,
            dataProcessor = editor.dataProcessor;

          // Out self closing tags the HTML4 way, like <br>.
          dataProcessor.writer.selfClosingEnd = '>';

          // Make output formatting behave similar to FCKeditor.
          var dtd = CKEDITOR.dtd;
          for ( var e in CKEDITOR.tools.extend( {}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent ) ) {
            dataProcessor.writer.setRules( e, {
              indent: true,
              breakBeforeOpen: true,
              breakAfterOpen: false,
              breakBeforeClose: !dtd[ e ][ '#' ],
              breakAfterClose: true
            });
          }
        }

      </script>
<?php
echo "<br />

    <input type='submit'></form>";

 } else {

$subject=$_POST['title'];
$message=$_POST['editor1'];
$sql10 = "SELECT * from `users`";
$result10 = mysql_query($sql10) or die(mysql_error());
while($row0 = mysql_fetch_array($result10)){
  $email=$row0['email'];

$rq=0;
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
 
} else {
  $rq=1; echo "User with email: " . $email . " cannot be mailed too, skipping."; 
}
if ($rq==1) { } else {
  $to = $email; 
      $from = "support@privatesectorvapors.com"; 
    

       //end of message 
      $headers  = "From: $from\r\n"; 
      $headers .= "Content-type: text/html\r\n"; 
      //options to send to cc+bcc 
      //$headers .= "Cc: [email]maa@p-i-s.cXom[/email]"; 
      //$headers .= "Bcc: [email]email@maaking.cXom[/email]"; 
       
      // now lets send the email. 
      mail($to, $subject, $message, $headers); 
}
}
}
}

  


if ($page=="editabout") {
if (!isset($_GET['a'])) { } else {
$a=$_GET['a'];
if ($a=="edit") {
if (!isset($_POST['ikl'])) { $ikl=""; } else { $ikl = $_POST['ikl'];
$ikl=mysql_real_escape_string($ikl);}
$sql2 = "UPDATE `statictext` set `about`='$ikl'";
    mysql_query($sql2) or die(mysql_error());
echo "All done..";
} 
}

$sql1 = "select * from `statictext`";
$result1 = mysql_query($sql1) or die(mysql_error());
while($row1 = mysql_fetch_array($result1)){
$ikl = $row1['about'];

}
?>
    <table style="width:100%;"><tr><td>Edit About Text</td></tr>
    <tr><td><form action="?page=admin&z=editabout&a=edit" method="post">Edit About:<br><textarea cols="80" id="editor1" name="ikl" rows="10"><?php echo $ikl; ?></textarea>
      <script>

        CKEDITOR.replace( 'editor1', {
          /*
           * Ensure that htmlwriter plugin, which is required for this sample, is loaded.
           */
          extraPlugins: 'htmlwriter',

          /*
           * Style sheet for the contents
           */
          contentsCss: 'body {color:#000; background-color#:FFF;}',

          /*
           * Simple HTML5 doctype
           */
          docType: '<!DOCTYPE HTML>',

          /*
           * Allowed content rules which beside limiting allowed HTML
           * will also take care of transforming styles to attributes
           * (currently only for img - see transformation rules defined below).
           *
           * Read more: http://docs.ckeditor.com/#!/guide/dev_advanced_content_filter
           */
          allowedContent:
            'h1 h2 h3 p pre[align]; ' +
            'blockquote code kbd samp var del ins cite q b i u strike ul ol li hr table tbody tr td th caption; ' +
            'img[!src,alt,align,width,height]; font[!face]; font[!family]; font[!color]; font[!size]; font{!background-color}; a[!href]; a[!name]',

          /*
           * Core styles.
           */
          coreStyles_bold: { element: 'b' },
          coreStyles_italic: { element: 'i' },
          coreStyles_underline: { element: 'u' },
          coreStyles_strike: { element: 'strike' },

          /*
           * Font face.
           */

          // Define the way font elements will be applied to the document.
          // The "font" element will be used.
          font_style: {
            element: 'font',
            attributes: { 'face': '#(family)' }
          },

          /*
           * Font sizes.
           */
          fontSize_sizes: 'xx-small/1;x-small/2;small/3;medium/4;large/5;x-large/6;xx-large/7',
          fontSize_style: {
            element: 'font',
            attributes: { 'size': '#(size)' }
          },

          /*
           * Font colors.
           */

          colorButton_foreStyle: {
            element: 'font',
            attributes: { 'color': '#(color)' }
          },

          colorButton_backStyle: {
            element: 'font',
            styles: { 'background-color': '#(color)' }
          },

          /*
           * Styles combo.
           */
          stylesSet: [
            { name: 'Computer Code', element: 'code' },
            { name: 'Keyboard Phrase', element: 'kbd' },
            { name: 'Sample Text', element: 'samp' },
            { name: 'Variable', element: 'var' },
            { name: 'Deleted Text', element: 'del' },
            { name: 'Inserted Text', element: 'ins' },
            { name: 'Cited Work', element: 'cite' },
            { name: 'Inline Quotation', element: 'q' }
          ],

          on: {
            pluginsLoaded: configureTransformations,
            loaded: configureHtmlWriter
          }
        });

        /*
         * Add missing content transformations.
         */
        function configureTransformations( evt ) {
          var editor = evt.editor;

          editor.dataProcessor.htmlFilter.addRules( {
            attributes: {
              style: function( value, element ) {
                // Return #RGB for background and border colors
                return CKEDITOR.tools.convertRgbToHex( value );
              }
            }
          } );

          // Default automatic content transformations do not yet take care of
          // align attributes on blocks, so we need to add our own transformation rules.
          function alignToAttribute( element ) {
            if ( element.styles[ 'text-align' ] ) {
              element.attributes.align = element.styles[ 'text-align' ];
              delete element.styles[ 'text-align' ];
            }
          }
          editor.filter.addTransformations( [
            [ { element: 'p', right: alignToAttribute } ],
            [ { element: 'h1',  right: alignToAttribute } ],
            [ { element: 'h2',  right: alignToAttribute } ],
            [ { element: 'h3',  right: alignToAttribute } ],
            [ { element: 'pre', right: alignToAttribute } ]
          ] );
        }

        /*
         * Adjust the behavior of htmlWriter to make it output HTML like FCKeditor.
         */
        function configureHtmlWriter( evt ) {
          var editor = evt.editor,
            dataProcessor = editor.dataProcessor;

          // Out self closing tags the HTML4 way, like <br>.
          dataProcessor.writer.selfClosingEnd = '>';

          // Make output formatting behave similar to FCKeditor.
          var dtd = CKEDITOR.dtd;
          for ( var e in CKEDITOR.tools.extend( {}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent ) ) {
            dataProcessor.writer.setRules( e, {
              indent: true,
              breakBeforeOpen: true,
              breakAfterOpen: false,
              breakBeforeClose: !dtd[ e ][ '#' ],
              breakAfterClose: true
            });
          }
        }

      </script></td></tr>
    <tr><td><input type="submit" name="submit"></td></tr></form></table>
<?php

}



if ($page=="goReg"){


  if ($resp->is_valid) {
    if (empty($_POST['password']) || empty($_POST['password2']) || empty($_POST['email']) || empty($_POST['email'])){
      header('location: ?page=admin&z=newuser&e=1');
    }
    
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];
  
    $stop = 0;
    if ($password != $password2){
      echo "Your passwords didn't match!";
    }else{
      $stop+=1;
    }
    $password = md5("$password");
    $email=$_POST['email'];
    $email = mysql_real_escape_string($email);
    
  
    $activate = genACTKEY();
    $email = mysql_real_escape_string($email);
    $password = mysql_real_escape_string($password);
    
    $uncount = strlen($email);
    if ($uncount<=16 & $uncount >=0){
      $stop+=1;
    }else{
      if ($uncount<6){
        echo "Your email was too short (6 character minimum)";
      }else{
        echo "Your email was too long! (16 character max)";
      }
    }
    $count = 0;
    $sql = "SELECT * FROM `users` WHERE `username`='$email'";
    $result = mysql_query($sql) or die(mysql_error());
    while($row = mysql_fetch_array($result)){
      $count+=1;
    }
    if ($count==0){
      $stop+=1;
    }else{
      echo "<h2>Ooops</h2>username already in use!";
    }
      $date = whatsthedate();
$mwa = $_SESSION['username']; 
      $sql = "INSERT INTO `users` (`verification key`,`id`, `username`, `password`, `level`, `email`,`activate`, `creator`) VALUES ('$key','NULL', '$email', '$password', 'notactivated', '$email','$activate', '$mwa')";
      mysql_query($sql) or die(mysql_error());
      
      echo "Great! Now if you would like to add this user as an administrator please <a href='?page=admin&z=addadmin'>click here</a>.";
    
  }else{
    header('location: ?page=admin&z=newuser&e=5');
  
  }
}


    if ($page=='newuser'){
      

  $email = $_SESSION['username']; 

    
  echo "<form action='?page=admin&z=goReg' method='post'>
    
    Username: <input type='text' name='email'><i></i><br>
    Password: <input type='password' name='password'><br>
    Confirm password: <input type='password' name='password2'><br><br>
    Email: <input type='text' name='email'><br>
     <br>
    <center><i>By registering, I confirm that I $email will be creating a new client and will be held responsible for this client. This user will receive an email with activation.</i><br></center>
    <input type='submit' value='Register' class='submit' style='width: 200px;'>";
     
  
  }
  
  if ($page=="banhammer"){
  if (empty($_GET['email'])){
  error1("Wait a second ", "There was a problem with your request.");
  } else {
  $email = $_GET['email'];
      $YYYY = $_POST['YYYY'];
      $MM = $_POST['MM'];
      $DD = $_POST['DD'];
      $ctor = $_POST['ctor'];
      $banneduntil= "$YYYY-$MM-$DD";
      $sql1 = "select * from `users` where `email`='$email'";
      $result1 = mysql_query($sql1) or die(mysql_error());
      while($row1 = mysql_fetch_array($result1)){
      $ip = $row1['ip'];
      }
      $sql = "insert into `bans` (`ip`, `email`, `banneduntil`, `bannedby`) values ('$ip', '$email', '$banneduntil', '$ctor')";
      mysql_query($sql) or die(mysql_error());
      echo "The user you banned won't be coming back anytime soon.";
    $url = $_SERVER['HTTP_REFERER'];
  header("Refresh: 3; url=$url");
  }
  }
  if ($page=="manageban"){
    
    echo "<table width=100% style='margin-top: 0px'><tr style='width: 11px; color: #ffffff; background: #000000;'><td width='100px'>User</td><td width='100px'><center>Banned Untill</td><td>Reason</td><td>Action</td></tr>";
  $sql = "select * from `bans`";
  $count = 0;
  $result =  mysql_query($sql) or die(mysql_error());
  while($row = mysql_fetch_array($result)){ 
    $email = $row['email'];
      $sql2 = "select * from `bans` where `email`='$email'";
      $result2 =  mysql_query($sql2) or die(mysql_error());
      while($row2 = mysql_fetch_array($result2)){
        $baneduntil = $row2['banneduntil'];
        
      }
    $details = $row['details'];
    $count +=1;
    echo "<tr><td valign='top' style='vertical-align: top;'><a href='?page=admin&z=edituser&email=$email'><span style='color: red;'><b>$email</b></span></a></td> <td valign='top' style='vertical-align: top;'><centeR>$baneduntil</td><td> $details</td><td><form action='?page=admin&z=unban' method='post'><input type='hidden' value='$email' name='email'><input type='submit' class='button' value='unban'></form></td></tr>";
  }
  echo "</table>";
  if ($count==0){
    echo "<center><i>No bans listed</i></center>";
  }
  echo "<br>";
    echo "</td>";
    
  
}
if ($page=="managepage") {
    if (empty($_POST['pagez'])){
      header('location: ?page=admin&z=security');
    } else {
    $pagez = $_POST['pagez'];
    $sql2 = "select * from `pages` where `page`='$pagez'";
      $result2 =  mysql_query($sql2) or die(mysql_error());
      while($row2 = mysql_fetch_array($result2)){
        $activated = $row2['activated'];
          $reason = $row2['reason'];
        
      }
  echo "<table width='100%' border='0'><form action='?page=admin&z=managepage' method='post'><font size='-1'>
  <tr>
    <td>Page URL:</td>
    <td>$pagez<input type='hidden' value='$pagez' name='rofl'></td>
  </tr>
  <tr>
    <td>Activated: (Enabled = 1 || Disabled = 0)</td>
    <td><input name='activated' type='text' value='$activated' size='3' maxlength='1' /></td>
  </tr>
  <tr>
    <td>Reason: (if disabled)</td>
    <td><textarea name='reason' id='reason' cols='45' rows='5'>$reason</textarea></td>
  </tr>
  <tr>
    <td>*Doing this will cause the page to give Access Denied to all users.</td>
    <td><input type='submit' value='Save Changes' class='submit' /></td>
  </tr>
  </font></form>
</table>";
    }
    if (empty($_POST['rofl'])){
      
    } else {
        $pager = $_POST['rofl'];
        $activated = $_POST['activated'];
        $reason = $_POST['reason'];
$reason=mysql_real_escape_string($reason);
  $sql = "update `pages` set `activated`='$activated', `reason`='$reason' where `page`='$pager'";
  mysql_query($sql) or die(mysql_error());
  $url = $_SERVER['HTTP_REFERER'];
  header("Refresh: 3; url=$url");
    }
  }
  
  if ($page=="security"){
  
  
  $me = $_SESSION['username'];
  $date = whatsthedate();
  


echo "  </br> <table width='100%' border='0' cellspacing='3' cellpadding='3'><form action='?page=admin&z=managepage' method='post'>

  <tr>
    <th width='100%' align='left' scope='col'><h2>Lock Frontend Page</h2></th>
  </tr>
</table>
<table width='100%' border='0'>
  <tr>
    <td><select name='pagez'>"; 
  $sql = "select * from `pages`";
  $result = mysql_query($sql) or die(mysql_error());
  while ($row= mysql_fetch_array($result)){
    $pagez = $row['page'];
  
    echo"
    
     <option>$pagez</option>
  ";
  }
  echo "</td>
    <td><input type='submit' name='button5' id='button5' value='Manage Page' /></form></td>
  </tr>
</table>";

  $sql = "select * from `locksite`";
$result = mysql_query($sql) or die(mysql_error());
while($row = mysql_fetch_array($result)){
  $combo = $row['combo'];
  $active = $row['active'];
$note=$row['note'];
  echo "<table width='100%' border='0' cellpadding='3' cellspacing='3'>
  <tr>
    <th width='100%' align='left' scope='col'><h2>Lock Website</h2></th>
  </tr>
</table>
<br /><form action='?page=admin&z=lockit' method='post'>
<table width='100%' border='0'>
  <tr>
    <td width='32%'>Admin: $me<input type='hidden' value='$me' name='email'><br />
      Current Date: $date<input type='hidden' value='$date' name='date'><br />Activated: <input name='active' type='text' value='$active' size='3' maxlength='1'></td>
    <td width='68%'>Leave a message for everybody to see.<br />";
  ?>
    <textarea cols="80" id="editor1" name="note" rows="10"><?php echo $note; ?></textarea>
      <script>

        CKEDITOR.replace( 'editor1', {
          /*
           * Ensure that htmlwriter plugin, which is required for this sample, is loaded.
           */
          extraPlugins: 'htmlwriter',

          /*
           * Style sheet for the contents
           */
          contentsCss: 'body {color:#000; background-color#:FFF;}',

          /*
           * Simple HTML5 doctype
           */
          docType: '<!DOCTYPE HTML>',

          /*
           * Allowed content rules which beside limiting allowed HTML
           * will also take care of transforming styles to attributes
           * (currently only for img - see transformation rules defined below).
           *
           * Read more: http://docs.ckeditor.com/#!/guide/dev_advanced_content_filter
           */
          allowedContent:
            'h1 h2 h3 p pre[align]; ' +
            'blockquote code kbd samp var del ins cite q b i u strike ul ol li hr table tbody tr td th caption; ' +
            'img[!src,alt,align,width,height]; font[!face]; font[!family]; font[!color]; font[!size]; font{!background-color}; a[!href]; a[!name]',

          /*
           * Core styles.
           */
          coreStyles_bold: { element: 'b' },
          coreStyles_italic: { element: 'i' },
          coreStyles_underline: { element: 'u' },
          coreStyles_strike: { element: 'strike' },

          /*
           * Font face.
           */

          // Define the way font elements will be applied to the document.
          // The "font" element will be used.
          font_style: {
            element: 'font',
            attributes: { 'face': '#(family)' }
          },

          /*
           * Font sizes.
           */
          fontSize_sizes: 'xx-small/1;x-small/2;small/3;medium/4;large/5;x-large/6;xx-large/7',
          fontSize_style: {
            element: 'font',
            attributes: { 'size': '#(size)' }
          },

          /*
           * Font colors.
           */

          colorButton_foreStyle: {
            element: 'font',
            attributes: { 'color': '#(color)' }
          },

          colorButton_backStyle: {
            element: 'font',
            styles: { 'background-color': '#(color)' }
          },

          /*
           * Styles combo.
           */
          stylesSet: [
            { name: 'Computer Code', element: 'code' },
            { name: 'Keyboard Phrase', element: 'kbd' },
            { name: 'Sample Text', element: 'samp' },
            { name: 'Variable', element: 'var' },
            { name: 'Deleted Text', element: 'del' },
            { name: 'Inserted Text', element: 'ins' },
            { name: 'Cited Work', element: 'cite' },
            { name: 'Inline Quotation', element: 'q' }
          ],

          on: {
            pluginsLoaded: configureTransformations,
            loaded: configureHtmlWriter
          }
        });

        /*
         * Add missing content transformations.
         */
        function configureTransformations( evt ) {
          var editor = evt.editor;

          editor.dataProcessor.htmlFilter.addRules( {
            attributes: {
              style: function( value, element ) {
                // Return #RGB for background and border colors
                return CKEDITOR.tools.convertRgbToHex( value );
              }
            }
          } );

          // Default automatic content transformations do not yet take care of
          // align attributes on blocks, so we need to add our own transformation rules.
          function alignToAttribute( element ) {
            if ( element.styles[ 'text-align' ] ) {
              element.attributes.align = element.styles[ 'text-align' ];
              delete element.styles[ 'text-align' ];
            }
          }
          editor.filter.addTransformations( [
            [ { element: 'p', right: alignToAttribute } ],
            [ { element: 'h1',  right: alignToAttribute } ],
            [ { element: 'h2',  right: alignToAttribute } ],
            [ { element: 'h3',  right: alignToAttribute } ],
            [ { element: 'pre', right: alignToAttribute } ]
          ] );
        }

        /*
         * Adjust the behavior of htmlWriter to make it output HTML like FCKeditor.
         */
        function configureHtmlWriter( evt ) {
          var editor = evt.editor,
            dataProcessor = editor.dataProcessor;

          // Out self closing tags the HTML4 way, like <br>.
          dataProcessor.writer.selfClosingEnd = '>';

          // Make output formatting behave similar to FCKeditor.
          var dtd = CKEDITOR.dtd;
          for ( var e in CKEDITOR.tools.extend( {}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent ) ) {
            dataProcessor.writer.setRules( e, {
              indent: true,
              breakBeforeOpen: true,
              breakAfterOpen: false,
              breakBeforeClose: !dtd[ e ][ '#' ],
              breakAfterClose: true
            });
          }
        }

      </script>
    <?php
  echo "
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Login Combination: 
      <input name='combo' type='text' value='$combo' />
      <input type='submit' name='button2' id='button2' value='Submit' />
  </form></td>
  </tr>
  </table>";
}
}
if ($page=="lockit"){
       if (!isset($_POST["email"]) || empty($_POST["email"])) { 
  error1("There is a problem ", "Stop fucking shit up douche.");
  exit(); }
  $email = $_POST['email'];
  $combo = $_POST['combo'];
  $date = $_POST['date'];
  $note = $_POST['note'];
  $active = $_POST['active'];
$note=mysql_real_escape_string($note);
  $sql = "update `locksite` set `combo`='$combo', `note`='$note', `active`='$active', `admin`='$email', `date`='$date'";
  mysql_query($sql) or die(mysql_error());
  success("Success", " Please wait to be redirected.");
  $url = $_SERVER['HTTP_REFERER'];
  header("Refresh: 3; url=$url");
}

if ($page=="unban"){
     if (!isset($_POST["email"]) || empty($_POST["email"])) { 
  error1("There is a problem ", "Stop fucking shit up douche.");
  exit(); }
  $email = $_POST['email'];
$me = $_SESSION['email']; 
    $sql = "delete from `bans` where `email`='$email'";
    mysql_query($sql) or die(mysql_error());
    $sql1 = "insert into `activity` (`time`, `action`, `by`, `client`) VALUES (NOW(), 'Unbanned', '$me', '$email')";
    mysql_query($sql1) or die(mysql_error());
    success("Success ", " Please wait to be redirected");

  $url = $_SERVER['HTTP_REFERER'];
  header("Refresh: 3; url=$url");

}

 if ($page=="addadmin") {
   


  if (!isset($_POST["email"]) || empty($_POST["email"])) { 
   
} else { 

$user = $_POST["email"];
  $sql2 = "update `users` SET `level`='management' WHERE `username`='$user'";
    mysql_query($sql2) or die(mysql_error());
      echo " $user has been modified to an administrator.";
    
  header("Refresh: 10; url='?page=admin&z=users'");
if (!isset($_POST["email"]) || empty($_POST["email"])) { 
   
} else { 
$email = $_POST["email"];
  $sql2 = "update `users` SET `level`='management' WHERE `username`='$port'";
    mysql_query($sql2) or die(mysql_error());
      echo " $email has been modified to an administrator.";
    
  header("Refresh: 10; url='?page=admin&z=users'");


} 
}
echo "<form action='?page=admin&z=addadmin' method='post'><table width='100%' border='0' cellpadding='3' cellspacing='3'>
  <tr>
    <th width='100%' align='left' scope='col'><h2>Add Administrator</h2></th>
  </tr>
</table>
<br />
<table width='100%' border='0'>
  <tr>
    <td>By Email: 
    <input name='email' type='text' value='' /></td>
    <td>By email: 
    <input name='email' type='text' value='' /></td>
    <td><input type='submit' value='Save Changes' class='submit'></td>
  </tr>
</table>
<p>";
  
 }
 
 if ($page=="users"){
  
echo "<center>";
 //Builds level array
$a = 0;

$sql1 = "select * from `users";
$result1 = mysql_query($sql1) or die(mysql_error());
while($row1 = mysql_fetch_array($result1)){
$level = $row1['level'];
$b = 1;
$forceend = false;
while ($b<=$a+1){
if(isset($levels["$b"])){
if($level==$levels["$b"]){
//level already recorded; force end loop;
$b=$a+1;
$forceend=true;
}else{
$b+=1;
}
}else{
//echo "<b>Debug</b> a: $a; b: $b;<br>";
$b+=1;
}
}
if($forceend==false){
$a+=1;
$levels["$a"] = $level;
}
}


//array levels is "a" items long
$b = 1;
 while ($b<=$a){
//echo "<b>Debug:</b> B: $b; A: $a;";
$levelsel = $levels["$b"];
echo "<h2>$levelsel</h2><table width='100%'><tr style='background: #000000; color: #ffffff;'><td><a href='?page=admin&z=users&sort=id'>ID</a></td><td><a href='?page=admin&z=users&sort=name'>Username</a></td><td><a href='?page=admin&z=users&sort=email'>Email</a></td><td>Action</td></tr>";
//echo $levelsel; //Debug, shows what level is selected
if (!isset($_GET['sort']) || empty($_GET['sort'])) {   
$sql1 = "select * from `users` where `level`='$levelsel' ORDER BY `last_name` ASC";
} else {
$sort=$_GET['sort'];
if ($sort=="email"){ $sql1 = "select * from `users` where `level`='$levelsel' ORDER BY `email` ASC";}
if ($sort=="name"){ $sql1 = "select * from `users` where `level`='$levelsel' ORDER BY `username` ASC";}
if ($sort=="id"){ $sql1 = "select * from `users` where `level`='$levelsel' ORDER BY `id` ASC";}


}
$result1 = mysql_query($sql1) or die(mysql_error());
while($row1 = mysql_fetch_array($result1)){
$name = $row1['username'];
$email = $row1['email'];
$id=$row1['id'];
echo "<tr><td>$id</td><td>$name</td><td>$email</td><td><table><tr><td><a href='?page=admin&z=edituser&email=$email'><div class='submit' style='padding-top: 5px;'><center>Edit</div></a></td></tr></table></td></tr>";
}

echo "</table>";

$b+=1;
}


 }
 
 
if ($page=="edituser2"){
    $creator = $_POST['creator'];
  $email = $_POST['email'];
    
    $u = $_POST['email'];
    
  $level = $_POST['level'];
  $password=$_POST['pw'];
  $password = md5("$password");
  $sql = "update `users` set `username`='$creator', `password`='$password', `level`='$level', `email`='$email' where `email`='$u'";
  mysql_query($sql) or die(mysql_error());
  $me = $_SESSION['email'];
echo " Loading..";
  $url = $_SERVER['HTTP_REFERER'];
  header("Refresh: 3; url=$url");
  
}  


if ($page=="edituser"){
  echo "<center>";
  $user = $_GET['email'];
  $sql = "select * from `users` where `email`='$user'";
  $result = mysql_query($sql) or die(mysql_error());
  while($row = mysql_fetch_array($result)){
    $lastlogin = $row['last login'];
    $pw = $row['password']; 
    $level = $row['level'];
    $email2 = $row['email'];
    $ip = $row['ip'];
    $us = $row['email'];
    $id=$row['id'];
      $username = $row['username'];
  
    ?> 
          <form action='?page=admin&z=edituser2' method='post'><input type='hidden' value='<? echo $us; ?>' name='email'>

    <h2> Edit Client Account </h2> (<?php echo $user; ?>)<hr>
  <table width="100%" border="0" cellspacing="3" align="left">
      <tr>
        <td width="46%"><p><b>Username:</b> </td>
        <td width="54%"><input type='text' value='<?php echo $username; ?>' name='creator'></td>
        </tr>
      <tr>
        <td><b>New Password:</b> </td>
        <td><input type='text' value='' name='pw'></td>
        </tr>
      <tr>
        <td><b>Priviledges:</b> </td>
        <td><input type='text' value='<?php echo $level; ?>' name='level'></td>
        </tr>
      <tr>
        <td><b>Email:</b> </td>
        <td>  <input type='text' value='<?php echo $email2; ?>' name='email'></td>
        </tr>
      <tr>
        <td><b>IP Address:</b></td>
        <td><?php echo $ip; ?></td>
        </tr>
                <tr>
        <td><b>Last Login:</b></td>
        <td><?php echo $lastlogin; ?></td>
        </tr>
          <tr><td> <input type='submit' value='Save Changes' class='submit'></form></td></tr>
 <tr><td></td></tr>
 
  <tr><td></td></tr>    
    </table>
    
    <h2>Ban Client</h2><hr />
    Banned Until: <form action='?page=admin&z=banhammer&email=<?php echo $user; ?>' method='post'>
    <input type='hidden' name='ctor' value='<?php echo $me; ?>' />
    <input type='text' name='YYYY' Value='Year' style='width: 80px'>-<select name='MM'  style='width: 80px'><option>01</option><option>02</option><option>03</option><option>04</option><option>05</option><option>06</option><option>07</option><option>08</option><option>09</option><option>10</option><option>11</option><option>12</option></select>-
    <select name='DD'  style='width: 80px'><option>01</option><option>02</option><option>03</option><option>04</option><option>05</option><option>06</option><option>07</option><option>08</option><option>09</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option><option>30</option><option>31</option>
    </select><br /><input type='submit' value='Ban User' class='submit'></form><br />
  <? 
    
  }
}

      
 ?>