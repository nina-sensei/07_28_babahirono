<?php
// DB接続の設定
// DB名は`gsacf_x00_00`にする
include('functions.php'); // 関数を記述したファイルの読み込み 
$pdo = connect_to_db(); // 関数実行

// データ取得SQL作成
$sql = 'SELECT * FROM schedule_share where karte LIKE "%' . $_POST["krt"] . '%" AND kana LIKE "%' . $_POST["kn"] . '%" AND name LIKE "%' . $_POST["nm"] . '%"';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
$view = "";

if ($status == false) {
   // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
   $error = $stmt->errorInfo();
   exit("sqlError:" . $error[2]);
} else {
   // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
   // fetchAll()関数でSQLで取得したレコードを配列で取得できる
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
   $output = "";
   // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
   // `.=`は後ろに文字列を追加する，の意味
   foreach ($result as $record) {
      $output .= "<tr>";
      $output .= "<td>{$record["karte"]}</td>";
      $output .= "<td>{$record["kana"]}</td>";
      $output .= "<td>{$record["name"]}</td>";
      $output .= "<td>{$record["age"]}</td>";
      $output .= "<td>{$record["sex"]}</td>";
      $output .= "<td>{$record["address"]}</td>";
      $output .= "<td><a href='07kadai_edit.php?id={$record["id"]}'>edit</a></td>";
      $output .= "<td><a href='07kadai_delete.php?id={$record["id"]}'>delete</a></td>";
      $output .= "</tr>";
   }
   unset($record);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>DB連携型todoリスト（一覧画面）</title>
</head>

<body>
   <fieldset>
      <legend>患者検索結果</legend>
      <a href="07kadai_06_search.php">入力画面</a>
      <table>
         <thead>
            <tr>
               <th>カルテNo.</th>
               <th>カナ</th>
               <th>名前</th>
               <th>年齢</th>
               <th>性別</th>
               <th>住所</th>
            </tr>
         </thead>
         <tbody>
            <?= $output ?>
         </tbody>
      </table>
   </fieldset>

   <style>
      body {
         background-color: #F1F1F2;
         margin: 0 auto;
         text-align: center;
         color: #685161;
      }

      legend {
         font-size: 1.5em;
      }

      table{
         width: 700px;
      }
   </style>
</body>

</html>