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

         $('#send').on("click", function() {
            //HTMLから受け取るデータです。

            //ここからajaxの処理です。          
            $.ajax({
               //POST通信
               type: "POST",
               //ここでデータの送信先URLを指定します。
               url: "07kadai_create.php",
               datatype: 'json',
               data: {
                  karte: $('#karte').val(),
                  kana: $('#kana').val(),
                  name: $('#name').val()
               }


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
               .always(function() {
                  console.log("完了");

               })
               //submitによる画面リロードを防いでいます。
               // return false();
            });
         });
      });
   </script>

</body>

</html>