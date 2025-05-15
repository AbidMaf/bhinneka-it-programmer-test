<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Document</title>
</head>
<body class="vh-100 m-0 p-0">
    <div class="container-fluid row text-bg-light h-100 w-100 p-0">
        <?= view('admin/dashboard/components/sidebar') ?>
        <div class="col-10 overflow-auto p-0">
            <!-- Modal -->
            <div class="modal fade" id="newProductModal" tabindex="-1" aria-labelledby="newProductModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newProductModalLabel">Create Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="/admin/products/create">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="codeInput" class="form-label">Product Code</label>
                                <input type="text" class="form-control disabled" id="codeInput" readonly name="code" value="<?= $data['lastCode'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="nameInput" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="nameInput" name="name" placeholder="ex: Ban Serep">
                            </div>
                            <div class="mb-3">
                                <label for="priceInput" class="form-label">Price</label>
                                <input type="number" class="form-control" id="priceInput" name="price" placeholder="ex: 10000">
                            </div>
                            <div class="mb-3">
                                <label for="unitInput" class="form-label">Unit</label>
                                <input type="text" class="form-control" id="unitInput" name="unit" placeholder="ex: Pcs">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <form method="post" action="/admin/products/update">
                        <?= csrf_field() ?>
                        <input type="hidden" id="editId" name="id">
                        <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                            <label for="editCode" class="form-label">Product Code</label>
                            <input type="text" class="form-control" id="editCode" name="code" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="editPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="editPrice" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="editUnit" class="form-label">Unit</label>
                            <input type="text" class="form-control" id="editUnit" name="unit">
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <div class="w-100 shadow-sm mh-10 py-3 mb-4 px-5 bg-white d-flex flex-row-reverse">
                <a href="<?= base_url("/logout") ?>" class="btn text-bg-danger text-wrap">Logout</a>
            </div>
            <div class="px-5 py-4">
                <div class="shadow rounded bg-white p-4 overflow-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin/') ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Products</li>
                        </ol>
                    </nav>

                    <div class="d-flex justify-content-between mb-4">
                        <h3>Products</h3>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newProductModal">Add Product</a>
                    </div>
                    <table class="table shadow-sm border table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['products'] as $key => $product): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $product['code'] ?></td>
                                    <td><?= $product['name'] ?></td>
                                    <td><?= 'Rp'.number_format($product['price'], 0, ',', '.') ?></td>
                                    <td><?= ucwords($product['unit']) ?></td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-edit"
                                            data-id="<?= $product['id'] ?>"
                                            data-code="<?= $product['code'] ?>"
                                            data-name="<?= $product['name'] ?>"
                                            data-price="<?= (int)$product['price'] ?>"
                                            data-unit="<?= $product['unit'] ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editProductModal">
                                            Edit
                                        </a>
                                        <a href="products/delete/<?= $product['id'] ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('editId').value = this.dataset.id;
                document.getElementById('editCode').value = this.dataset.code;
                document.getElementById('editName').value = this.dataset.name;
                document.getElementById('editPrice').value = this.dataset.price;
                document.getElementById('editUnit').value = this.dataset.unit;
            });
        });
    </script>
    <?php if (session()->getFlashdata('success')): ?>
    <script>
        Toastify({
            text: "<?= esc(session()->getFlashdata('success')) ?>",
            duration: 3000,
            gravity: "top",
            position: "right",
            backgroundColor: "#198754",
            stopOnFocus: true
        }).showToast();
    </script>
    <?php elseif (session()->getFlashdata('error')): ?>
    <script>
        Toastify({
            text: "<?= esc(session()->getFlashdata('success')) ?>",
            duration: 3000,
            gravity: "top",
            position: "right",
            backgroundColor: "#df2020",
            stopOnFocus: true
        }).showToast();
    </script>
    <?php endif; ?>
</body>
</html>