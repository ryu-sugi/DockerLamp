<?php  
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['member_login'])==false)
    {
    print 'ログインされていません。 <br>';
    print '<a href="shop_list.php">商品一覧へ</a>';
    exit();
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>ろくまる農園</title>
</head>
<body>

<?php

try
{

require_once('../common/common.php');

$post=sanitize($_POST);

$onamae=$post['onamae'];
$email=$post['email'];
$postal1=$post['postal1'];
$postal2=$post['postal2'];
$address=$post['address'];
$tel=$post['tel'];

print $onamae.'様 <br>';
print 'ご注文ありがとうございました。 <br>';
print $email.'にメールを送りましたのでご確認ください。 <br>';
print '商品は以下の住所に発送させていただきます。 <br>';
print  $postal1.'-'.$postal2. '<br>';
print $address. '<br>';
print $tel. '<br>';

$honbun='';
$honbun.=$onamae."様 \n\n このたびはご注文ありがとうございました。 \n";
$honbun.="\n";
$honbun.="ご注文商品 \n";
$honbun.="-------------\n";

$cart= $_SESSION['cart'];
$kazu= $_SESSION['kazu'];
$max= count($cart);

$dsn = 'mysql:dbname=shop;host=172.19.0.4;port=3306;charset=utf8';
$user = 'root';
$password = 'password';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

for($i=0; $i<$max; $i++)
{

    $sql = 'SELECT name,price FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[0] = $cart[$i];
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    $name = $rec['name'];
    $price = $rec['price'];
    $kakaku[] = $price;
    $suryo = $kazu[$i];
    $shokei = $price * $suryo;

    $honbun.=$name.' ';
    $honbun.=$price.'円x';
    $honbun.=$suryo.'個 =';
    $honbun.=$shokei."円 \n";
}

$sql = 'LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$lastmembercode=$_SESSION['member_code'];

$honbun.="□□□□□□□□□□□□□□□□□□□□□□□□□□□□ \n";
$honbun.=" ~安心野菜のろくまる農園~ \n";
$honbun.="\n";
$honbun.="〇〇県六丸郡六丸村 123-4 \n";
$honbun.="電話 090-6060-xxxx \n"; 
$honbun.="メール info@rokumarunouen.co.jp \n";
$honbun.="□□□□□□□□□□□□□□□□□□□□□□□□□□□□ \n";
//  print '<br>';
//  print nl2br($honbun);

$title = 'ご注文ありがとうございます。';
$header = 'From: info@rokumarunouen.co.jp';
$honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail($email, $title, $honbun, $header);

$title = 'お客様からご注文がありました。';
$header = 'From:'.$email;
$honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail('info@rokumarunouen.co.jp', $title, $honbun, $header);

}
catch(Exception $e)
{
    print $e;
    exit();
}
?>

<br>
<a href="shop_list.php">商品画面へ</a>

</body>
</html>