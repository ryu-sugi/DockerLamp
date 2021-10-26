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

require_once('../common/common.php');

$post=sanitize($_POST);

$onamae=$post['onamae'];
$email=$post['email'];
$postal1=$post['postal1'];
$postal2=$post['postal2'];
$address=$post['tel'];

if($oname=='')
{
    print 'お名前が入力されていません。 <br> <br>';
}

if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/',$email)==0)
{
    print 'メールアドレスを正確に入力してください。 <br> <br>';
}

if(preg_match('/\A\[0-9]+\z/',$postal1)==0)
{
    print '郵便番号は半角数字で入力してください。 <br> <br>';
}

if(preg_match('/\A\[0-9]+\z/',$postal2)==0)
{
    print '郵便番号は半角数字で入力してください。 <br> <br>';
}

if($address=='')
{
    print '住所が入力されていません。 <br> <br>';
}

if(preg_match('/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/',$tel)==0)
{
    print '電話番号を正確に入力してください。 <br> <br>';
}

print '<form method="post" action="shop_form_done.php">';
print '<input type="hidden" name="onamae" value="'.$onammae.'">';
print '<input type="hidden" name="email" value="'.$email.'">';
print '<input type="hidden" name="postal1" value="'.$postal1.'">';
print '<input type="hidden" name="postal2" value="'.$postal2.'">';
print '<input type="hidden" name="address" value="'.$address.'">';
print '<input type="hidden" name="tel" value="'.$tel.'">';
print '<input type="button" onclick="history.back()" value="戻る">';
print '<input type="submit" value="OK">';
print '</form>';

?>



</body>
</html>