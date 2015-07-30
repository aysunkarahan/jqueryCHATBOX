<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>OPERATÖRUN KONUŞMA SAYFASI</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style>
        .chat
        {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li
        {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li.left .chat-body
        {
            margin-left: 60px;
        }

        .chat li.right .chat-body
        {
            margin-right: 60px;
        }


        .chat li .chat-body p
        {
            margin: 0;
            color: #777777;
        }

        .panel .slidedown .glyphicon, .chat .glyphicon
        {
            margin-right: 5px;
        }

        .panel-body
        {
            overflow-y: scroll;
            height: 250px;
        }

        ::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar
        {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }

        .elma{
            width: 500px;
            height: 500px;
            border: 1px;
            background-color: aqua;
            margin-left: 75%;
            position: float;
        }
        #chatbox {
            width: 250px;
            height: 250px;
            margin-top: 20%;
            margin-bottom: 20%;
            margin-right: 20%;
            position: relative;
        }
    </style>
    <script src="jquery-1.11.2.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            gonder();

            var int=self.setInterval("gonder()",5000);
        });

        function gonder(){
            var sonid = $('ul li:first').attr("id");
            $.ajax({
                type:'POST',
                url:'ajax.php',
                data: {"sonid": sonid},
                success: function (cevap) {
                    if(cevap){
                        $("ul").prepend(cevap);}
                }
            });
        }
    </script>

    <script src="jquery-1.11.2.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#form1').submit(function () {
                var mesaj = $('[name=usermesaj]').val().trim();
                $.ajax({
                    url: "gonder.php",
                    type: "POST",
                    data: $('#form1').serialize()
                })
            })

        })
    </script>


</head><body>


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
echo'<div style="width: 300px; height: 800px;"></div> <div class="container" style="position: fixed; bottom:0; left:65%;">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Chat

                </div>
                <div class="panel-body">';
$data = $db->query("SELECT *FROM mesajlar  ORDER BY id DESC LIMIT 10");
while($row = $data->fetch(PDO::FETCH_ASSOC)){
    echo '
                    <ul class="chat">
                        <li class="left clearfix" id="'.$row["id"].'"><span class="chat-img pull-left" >

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

                    </ul>
                ';

} echo '</div>
                <div class="panel-footer">
                    <div class="input-group">
                    <form id="form1">
                        <input type="hidden" name="ad" id="ad" value="operatör"/>
                        <input name="usermesaj" id="usermesaj"  type="text" class="form-control input-sm" placeholder="Mesaj Yaz..." />
                        <span class="input-group-btn">
                        <input class="btn btn-warning btn-sm" type="submit" id="send" name="send" value="Gönder"/>
</form>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></div>';
?>

<div id="sonuc"></div>
</body>
