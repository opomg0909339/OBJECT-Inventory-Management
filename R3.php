<?php
// 資料庫連接
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ru;", "root", "");
} catch (PDOException $err) {
    die("資料庫無法連接");
}

// 分頁設定
$limit = 15; // 每頁顯示的記錄數
$page = isset($_GET['page']) ? $_GET['page'] : 1; // 目前所在的頁數
$start = ($page - 1) * $limit; // 查詢的起始位置

// 查詢資料總數
$total_stmt = $pdo->prepare('SELECT COUNT(*) as total FROM history');
$total_stmt->execute();
$total_rows = $total_stmt->fetch(PDO::FETCH_ASSOC)['total'];

// 總頁數
$total_pages = ceil($total_rows / $limit);

// 查詢需要顯示的資料
$stmt = $pdo->prepare('SELECT * FROM history ORDER BY ID DESC LIMIT :start, :limit');
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>進銷查詢</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>進銷查詢</h1>

        <!-- 返回按鈕 -->
        <form method="POST" action="rindex.php">
            <button type="submit" class="btn btn-primary">返回</button>
        </form>
        <form method="POST" action="R3.php">
            <button type="submit" class="btn btn-primary" onclick="window.print()">列印</button>
        </form>

        <!-- 表格 -->
        <table class="table">
            <thead align='center'>
                <tr>
                    <th scope="col">最後更改日期</th>
                    <th scope="col">貨號</th>
                    <th scope="col">花板</th>
                    <th scope="col">2</th>
                    <th scope="col">4</th>
                    <th scope="col">6</th>
                    <th scope="col">8</th>
                    <th scope="col">10</th>
                    <th scope="col">12</th>
                    <th scope="col">14</th>
                    <th scope="col">16</th>
                    <th scope="col">18</th>
                    <th scope="col">類型</th>
                </tr>
            </thead>
            <tbody align='center'>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><?= $r['TIME'] ?></td>
                        <td><?= $r['NUMBER'] ?></td>
                        <td><?= $r['STYLE'] ?></td>
                        <td><?= $r['2'] ?></td>
                        <td><?= $r['4'] ?></td>
                        <td><?= $r['6'] ?></td>
                        <td><?= $r['8'] ?></td>
                        <td><?= $r['10'] ?></td>
                        <td><?= $r['12'] ?></td>
                        <td><?= $r['14'] ?></td>
                        <td><?= $r['16'] ?></td>
                        <td><?= $r['18'] ?></td>
                        <td><?= $r['TYPE'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- 分頁 -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">上一頁</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">下一頁</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</body>

</html>
