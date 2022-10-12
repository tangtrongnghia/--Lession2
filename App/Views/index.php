<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body>
    <div class="container border border-success mt-4 mb-4 p-5">
        <div class="container border-success mt-3">
            <nav class="row navbar navbar-expand-lg navbar-light bg-white mb-5">
                <a class="navbar-brand btn btn-primary text-white" href="#">Products</a>
                <a class="navbar-brand btn" href="#">Categories</a>
                <img class="ml-auto" width="300" src="./img/logo.jpg" alt="">
            </nav>
            <section class="pb-4">
                <div class="form-outline mb-4">
                    <form action="" class="d-inline">
                        <input id="search-input" type="search" name="search" class="form-control mb-3 border-primary" value="<?=isset($_GET['search']) ? $_GET['search'] : ''?>">
                        <input id="search-submit" type="submit" class="d-none">
                        <label class="form-label" for="datatable-search-input">Search found <?=$count?> results</label>
                    </form>
                    <a id="add" href="javascript:void(0)" class="float-right text-primary" data-toggle="modal" data-target="#form-modal"><i class="float-right fa-solid fa-circle-plus h1 "></i></a>
                </div>
                <?php include __VIEW__ . 'alert.php'; ?>
                <table class="text-center table datatable-table table-bordered">
                    <thead class="datatable-header">
                        <tr>
                            <th>#</thtyle=>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Images</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody class="datatable-body">
                        <?php
                        foreach ($products as $v) {
                        ?>
                            <tr>
                                <td><?= $v['id'] ?></td>
                                <td><?= $v['name'] ?></td>
                                <td><?= $v['category'] ?></td>
                                <td><a href="./<?= $v['thumb'] ?>" target="_blank"><img src="./<?= $v['thumb'] ?>" alt="" style="width: 30px;"></a></td>
                                <td>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#form-modal" onclick="showFormEdit(<?= $v['id'] ?>)" title="Sửa"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#confirm" onclick="showConfirm(<?= $v['id'] ?>, 'delete')" title="Xóa"><i class="fa-solid fa-circle-minus"></i></a>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#confirm" onclick="showConfirm(<?= $v['id'] ?>)" title="Sao chép"><i class="fa-regular fa-file"></i></a>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#detail" onclick="showDetail(<?= $v['id'] ?>)" title="Xem"><i class="fa-solid fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?=pages($sumPage, $page)?>
            </section>
        </div>
    </div>
    
    <!-- modal -->
    <?php include __VIEW__ . 'modal.php'; ?>

</body>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script>
    var products = <?=json_encode($products)?>;
</script>
<script src="./js/main.js"></script>

</html>