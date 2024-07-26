<?php
session_start();
require_once 'funcs.php';
loginCheck();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>登録</title>
    <link rel="stylesheet" href="css/common.css" />
    <link rel="stylesheet" href="css/index.css" />
</head>

<body>
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">data</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
                <div class="navbar-header user-name"><p><?= $_SESSION['user_name'] ?></p></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->
    <!-- Main[Start] -->
    <form method="POST" action="insert.php" enctype="multipart/form-data">
        <div class="jumbotron">

Today's Skin
<br>
<fieldset>
  <legend>Choose your 肌の調子:</legend>

  <div>
    <input type="checkbox" id="kanso" name="kanso" checked />
    <label for="kanso">乾燥</label>
  </div>

  <div>
    <input type="checkbox" id="tekari" name="tekari" />
    <label for="tekari">テカり</label>
  </div>

  <div>
    <input type="checkbox" id="nikibi" name="nikibi" />
    <label for="nikibi">ニキビ</label>
  </div>

  <div>
    <input type="checkbox" id="shimi" name="shimi" />
    <label for="shimi">シミ</label>
  </div>  

  <div>
    <input type="checkbox" id="shiwa" name="shiwa" />
    <label for="shiwa">シワ</label>
  </div>

  <div>
    <input type="checkbox" id="tarumi" name="tarumi" />
    <label for="tarumi">たるみ</label>
  </div>

  <div>
    <input type="checkbox" id="keana" name="keana" />
    <label for="keana">毛穴</label>
  </div>

  <div>
    <input type="checkbox" id="kuma" name="kuma" />
    <label for="kuma">クマ</label>
  </div>

</fieldset>
<fieldset>
  <legend>コメントと写真</legend>
                <div>

                    <textarea id="content" name="content" rows="4" cols="40"></textarea>
                </div>

                <div>
                <label for="image">写真：</label>
                <input type="file" name="image">
                </div>
                </fieldset>


                <input type="date"  />

                <div>
                    <input type="submit" value="送信">
                </div>
                

        </div>
    </form>
</body>

</html>
