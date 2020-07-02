<?php
// var_dump($_POST);
// exit();
header('Content-type: application/json');
// 関数ファイルの読み込み
include("functions.php");

// idの受け取り
// $kana = $_POST['kn'];


// DB接続
$pdo = connect_to_db();


// if (isset($_POST['send']) === true) {
// データ取得SQL作成
$sql = 'SELECT * FROM schedule_share';
// $sql = 'SELECT * FROM schedule_share where karte LIKE "%' . $_POST["krt"] . '%" AND kana LIKE "%' . $_POST["kn"] . '%" AND name LIKE "%' . $_POST["nm"] . '%"';
// $sql = 'SELECT * FROM schedule_share where kana LIKE "%' . $_POST["kn"] . '%"';
// $sql = 'SELECT * FROM schedule_share where kana = "' . $_POST["kn"] . '"';

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
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   // $output = [
   //    $kana->kana


   // ];


};
// $output = "";
// foreach ($result as $record) {
//    $output .= "<tr>";
//    $output .= "<td>{$record["karte"]}</td>";
//    $output .= "<td>{$record["kana"]}</td>";
//    $output .= "<td>{$record["name"]}</td>";
//    $output .= "<td>{$record["age"]}</td>";
//    $output .= "<td>{$record["sex"]}</td>";
//    $output .= "<td>{$record["address"]}</td>";
//    $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>";
//    $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
//    $output .= "</tr>";
// }
//jsonとして出力

echo json_encode($result, JSON_UNESCAPED_UNICODE);
exit();

?>



<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>患者検索</title>
</head>

<body>
   <form action="" method="POST">
      <h2>患者検索</h2>
      <p>カルテNo.検索</p>
      <input type="text" name="krt" id="karte">
      <p>カナ検索</p>
      <input type="text" name="kn" id="kana">
      <p>名前検索</p>
      <input type="text" name="nm" id="name">
      <button id="send">検索</button>
   </form>


   <h3>患者検索結果</h3>
   <table>
      <div>
         <tr>
               <th>カルテNo.</th>
               <th>カナ</th>
               <th>名前</th>
               <th>年齢</th>
               <th>性別</th>
               <th>住所</th>
         </tr>
      </div>

      <div id="output"></div>
   </table>

   <style>
      body {
         background-color: #F0EFEA;
         margin: 0 auto;
         color: #426E86;
         display: flex;
         flex-direction: column;
         align-items: center;
      }
   </style>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script>
      $(function() {

         $('#send').click(function() {
               //HTMLから受け取るデータです。
               const data = {
                  "karte": $('#karte').val(),
                  "kana": $('#kana').val(),
                  "name": $('#name').val()
               };

               //ここからajaxの処理です。          
               $.getJSON({
                     //POST通信
                     type: "POST",
                     //ここでデータの送信先URLを指定します。
                     url: "07kadai_p_create.php",
                     datatype: 'data',
                     data: data
                  })
                  //処理が成功したら
                  .done(function(data, textStatus, jqXHR) {
                     //HTMLファイル内の該当箇所にレスポンスデータを追加します。
                     console.log(data);

                     $('#output').html(data);
                  })
                  //処理がエラーであれば
                  .false(function(jqXHR, textStatus, error) {
                     alert('通信エラー');
                  })

                  .always(function(data) {
                     console.log("完了");

                  })
               //submitによる画面リロードを防いでいます。
               // return false;
         });
      });
   </script>

</body>

</html>