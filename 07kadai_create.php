<?php
// var_dump($_POST);
// exit();

// 関数ファイルの読み込み
include("functions.php");

// idの受け取り
// $kana = $_POST['kn'];


// DB接続
$pdo = connect_to_db();


// if (isset($_POST['send']) === true) {
// データ取得SQL作成
// $sql = 'SELECT * FROM schedule_share where karte LIKE "%' . $_POST["krt"] . '%" AND kana LIKE "%' . $_POST["kn"] . '%" AND name LIKE "%' . $_POST["nm"] . '%"';
$sql = 'SELECT * FROM schedule_share where kana LIKE "%' . $_POST["kn"] . '%"';
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
   $output = [
      $kana->kana


   ];
      
   
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
   header('Content-type: application/json');
   echo json_encode($output, JSON_UNESCAPED_UNICODE);
   exit();

   
   
   
   
   
   // データの出力用変数（初期値は空文字）を設定
   // $output = "";
   // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
   // `.=`は後ろに文字列を追加する，の意味
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

   


