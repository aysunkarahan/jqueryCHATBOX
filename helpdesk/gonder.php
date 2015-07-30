<?php

if(isset($_POST["usermesaj"])){
try{

    $dns = 'mysql:host=localhost;dbname=helpdesk';
    $kullaniciAdi = "root";
    $sifreP = "";
    $db = new PDO($dns, $kullaniciAdi, $sifreP);
    $db->exec("SET CHARACTER SET UTF8");
    $data = $db->query("INSERT INTO mesajlar VALUES(NULL,'".$_POST["ad"]."','".$_POST["usermesaj"]."',now())");

}catch (Exception $ex) {
    echo "Veritabanı Hatası : ".$ex->getMessage();
}
}
?>