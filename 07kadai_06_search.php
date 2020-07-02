<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>患者検索</title>
</head>

<body>
    <form action="07kadai_p_result.php" method="POST">
        <h2>患者検索</h2>
        <p>カルテNo.検索</p>
        <input type="text" name="krt">
        <p>カナ検索</p>
        <input type="text" name="kn">
        <p>名前検索</p>
        <input type="text" name="nm">
        <button>検索</button>
    </form>

    <style>
        body {
            background-color: #F1F1F2;
            margin: 0 auto;
            color: #5D535E;
        }

        form {
            margin-left: 600px;
        }
    </style>

</body>

</html>