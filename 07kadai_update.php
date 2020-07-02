<?php

// 送信データのチェック
// var_dump($_POST);
// exit();

// 関数ファイルの読み込み
include("functions.php");

// 送信データ受け取り
$id = $_POST['id'];
$kana = $_POST['kana'];
$name = $_POST['name'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$address = $_POST['address'];


// DB接続
$pdo = connect_to_db();

// UPDATE文を作成&実行
$sql = "UPDATE schedule_share SET kana=:kana, name=:name, age=:age, sex=:sex, address=:address, updated_at=sysdate() WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":kana", $kana, PDO::PARAM_STR);
$stmt->bindValue(":name", $name, PDO::PARAM_STR);
$stmt->bindValue(":age", $age, PDO::PARAM_STR);
$stmt->bindValue(":sex", $sex, PDO::PARAM_STR);
$stmt->bindValue(":address", $address, PDO::PARAM_STR);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();


// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
    header("Location:07kadai_06_search.php");
    exit();
}
