<?php 
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
    print 'ようこそゲスト様 ';
    print '<a href="member_login.html">ログイン画面へ</a> <br>';
    print '<br>';
}
else
{
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様';
    print '<a href="member_logout.php">ログアウト</a> <br>';
    print '<br>';
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

$pro_code = $_GET ['procode'];

if($_SESSION['cart'] == true)
{
    $cart = $_SESSION['cart'];
    $kazu = $_SESSION['kazu'];
}
$cart[] = $pro_code;
$kazu[] = 1;
$_SESSION['cart'] = $cart;
$_SESSION['kazu'] = $kazu;

foreach($cart as $key => $val)
{
    print $val;
    print '<br>';
}

}
catch(Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

カートに追加しました。<br>
<br>
<a href="shop_list.php">商品一覧に戻る</a>

</body>
</html>