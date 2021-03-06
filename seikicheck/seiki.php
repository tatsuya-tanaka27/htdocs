<!DOCTYPE html>
<html lamg="ja">
<head>
	<meta charset="UTF-8">
	<title>正規表現チェック</title>
</head>
<body>
<?php

//メールアドレスチェック例

$mailmatch="/^[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+.[a-zA-Z0-9\._-]+$/";
$email="aaa@aa.aa.aa";
if(preg_match($mailmatch,$email)){
	echo "<p>メールはマッチした</p>";
}
else{
	echo "<p>メールはマッチしなかった</p>";
}


//全角文字チェック例

$wordmatch="/^[ぁ-んァ-ヶー々一-龠０-９]+$/u";
$word="あア言葉１２佐々木";
if(preg_match($wordmatch,$word)){
	echo "<p>文字はマッチした</p>";
}
else{
	echo "<p>文字はマッチしなかった</p>";
}

//パスワードチェック例(小文字英、大文字英、数字の３種必須)

$pass="AAAAbbbb1234";
if(preg_match("/^[a-zA-Z0-9]{8,12}$/",$pass) && preg_match("/[a-z]+/",$pass) && preg_match("/[A-Z]+/",$pass) && preg_match("/[0-9]+/",$pass)){
	echo "<p>パスはマッチした</p>";
}
else{
	echo "<p>パスはマッチしなかった</p>";
}

/*
正規表現チェックについて
preg_match()関数を使用し、
第一引数にマッチ指定
第二引数に確認する文字列

マッチ指定は全体を/～/で囲む
その時、全角文字を指定するときは/の後に文字コード指定(utf-8ならu)
開始の/の後に^を付けると確認する文字列の１文字目から
つけないと頭に関係ない文字があってもtrue判定になる
終了の/の前に$を付けると確認する文字列の最後の文字まで
つけないと後ろに関係ない文字があってもtrue判定になる

文字数について

+　直前の指定文字が１字以上
*　直前の指定文字が０字以上
{m}　直前の指定文字がm字
{m,}　直前の指定文字がm字以上
{m,n}　直前の指定文字がm字からn字


文字種の指定について
（-が～の意味）

a-z　半角小文字英字
A-Z　半角大文字英字
0-9　半角数字
０-９　全角数字
ぁ-ん　全角ひらがな
ァ-ヶ　全角カタカナ
一-龠　全角漢字（常用漢字）「々」や「ー（音引き）」は入らない

記号などは個々に指定
複数の中のどれかの時は[]で囲む
[]の中の１文字目に^を付けると否定になる
例)[^0-9]は半角数字以外となる
*/

?>
</body>
</html>