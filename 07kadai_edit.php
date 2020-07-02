<?php
// 送信データのチェック
// var_dump($_GET);
// exit();

// 関数ファイルの読み込み
include("functions.php");

// idの受け取り
$id = $_GET['id'];

// DB接続
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM schedule_share WHERE id=:id';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();



// データ登録処理後
if ($status == false) {
   // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
   $error = $stmt->errorInfo();
   echo json_encode(["error_msg" => "{$error[2]}"]);
   exit();
} else {
   // 正常にSQLが実行された場合は指定の11レコードを取得
   // fetch()関数でSQLで取得したレコードを取得できる
   $record = $stmt->fetch(PDO::FETCH_ASSOC);
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>DB連携型todoリスト（編集画面）</title>
</head>

<body>
   <form action="07kadai_update.php" method="POST">
      <fieldset>
         <legend>DB連携型todoリスト（編集画面）</legend>
         <a href="07kadai_read.php">一覧画面</a>
         <div>
            カルテNo: <?= $record["karte"] ?>
         </div>
         <div>
            カナ: <input type="text" name="kana" value="<?= $record["kana"] ?>">
         </div>
         <div>
            名前: <input type="text" name="name" value="<?= $record["name"] ?>">
         </div>
         <div>
            年齢: <input type="text" name="age" value="<?= $record["age"] ?>">
         </div>
         <div>
            性別: <input type="text" name="sex" value="<?= $record["sex"] ?>">
         </div>
         <div>
            住所: <input type="text" name="address" value="<?= $record["address"] ?>">
         </div>
         <div>
            <button>submit</button>
         </div>
         <input type="hidden" name="id" value="<?= $record['id'] ?>">
      </fieldset>
   </form>

   <style>
      body {
         background-color: #F1F1F2;
         margin: 0 auto;
         text-align: center;
         color: #685161;
      }
   </style>
</body>