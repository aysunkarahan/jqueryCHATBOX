<?php

$dns = 'mysql:host=localhost;dbname=helpdesk';
$kullaniciAdi = "root";
$sifreP = "";
try{
    $db = new PDO($dns, $kullaniciAdi, $sifreP);
    $db->exec("SET CHARACTER SET UTF8");
}catch (Exception $ex) {
    echo "Veritabanı Hatası : ".$ex->getMessage();
}
 if(!isset($_POST["sonid"])) {
 }else{$sonid = $_POST["sonid"];


     $data = $db->query("SELECT *FROM mesajlar WHERE id > '".$sonid."'  ORDER BY id DESC");
     $row = $data->fetch(PDO::FETCH_ASSOC);
     if($data->rowCount()>0) {
        echo '<li class="left clearfix" id="'.$row["id"].'"><span class="chat-img pull-left" >

                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">'.$row["user_id"].'</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>'.$row["tarih"].'</small>
                                </div>
                                <p>
                                    '.$row["mesaj"].'
                                </p>
                            </div>
                        </li>


                ';

     }

 }

?>