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
      <input type="text" name="krt">
      <p>カナ検索</p>
      <input type="text" name="kn" id="kana">
      <p>名前検索</p>
      <input type="text" name="nm">
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
         let area;

         $('#send').click(function() {
            //HTMLから受け取るデータです。
            const data = {
               "kana": $('#kana').val()
            };

            //ここからajaxの処理です。          
            $.post({
                  //POST通信
                  type: "POST",
                  //ここでデータの送信先URLを指定します。
                  url: "07kadai_p_create.php",
                  datatype: 'json',
                  data: data
               })
               //処理が成功したら
               .done(function() {
                  //HTMLファイル内の該当箇所にレスポンスデータを追加します。

                  console.log(data);
                  $.each(data, function(key, item) {
                     area = isValue(item.kana);
                  })
                  $('#output').text(area);
               })
               //処理がエラーであれば
               .false(function(XMLHttpRequest, textStatus, error) {
                  alert('通信エラー');
               })

            //submitによる画面リロードを防いでいます。
            return false;
         });
      });
   </script>

</body>

</html>