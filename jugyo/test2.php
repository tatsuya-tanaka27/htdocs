<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>php</title>
        <style>

            form{
                background-color: #eaeaea;
                padding:30px 50px;
            }

            form dl dt{
                width: 165px;
                padding:10px 0;
                float:left;
                clear:both;
            }

            form dl dd{
                padding:10px 0;
            }

            .dd-area{
                display:flex;
            }

            .radio-area {
                margin-left:0px;
            }

            .checkbox-area {
                margin-left:0px;
            }
        </style>
    </head>
    <body>
        <form method="POST" action="test2-post.php">
            <dl>
                <dt>メールアドレス</dt>
                    <dd><input type="text" name="mail"></dd>
                <dt>パスワード</dt>
                    <dd><input type="text" name="pass"></dd>
                <dt>生年月日（西暦）</dt>
                    <dd><input type="text" name="birthday"></dd>
                <dt>性別</dt>
                    <span class="dd-area">
                        <dd class="radio-area">
                            <input type="radio" name="sex[]" value="man">男
                            <input type="radio" name="sex[]" value="woman">女
                            <input type="radio" name="sex[]" value="nosex">選択なし
                        </dd>
                    </span>
                <dt>旅行目的</dt>
                    <span class="dd-area">
                        <dd class="checkbox-area">
                            <input type="checkbox" name="purpose[]" value="business">仕事
                            <input type="checkbox" name="purpose[]" value="sightseeing">観光
                            <input type="checkbox" name="purpose[]" value="hobby">趣味
                            <input type="checkbox" name="purpose[]" value="other">その他
                        </dd>
                    </span>
                <dt>ご意見</dt>
                    <dd><textarea name="comment" style="height:100px;"></textarea></dd>
            </dl>
            <input type="submit" value="送信">
        </form>
    </body>
</html>