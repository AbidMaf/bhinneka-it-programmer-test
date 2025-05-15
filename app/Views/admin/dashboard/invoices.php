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
            <!-- Create Modal -->
            <div class="modal fade" id="newInvoiceModal" tabindex="-1" aria-labelledby="newInvoiceModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg overflow-y-auto">
                    <div class="modal-content">
                    <form method="post" action="/admin/invoices/create" class="overflow-auto">
                        <?= csrf_field() ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="newInvoiceModalLabel">Add Invoice</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body overflow-auto">
                        <div class="mb-3">
                            <label for="factureCode" class="form-label">Facture Code</label>
                            <input type="text" class="form-control" id="factureCode" name="invoice_number" value="<?= $data['lastInvoiceNumber'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label">Select Company</label>
                            <select class="form-select" id="company" name="company_id" required>
                                <option value="" disabled selected>-- Choose company --</option>
                                <?php foreach ($data['companies'] as $company): ?>
                                    <option value="<?= $company['id'] ?>"><?= esc($company['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="place" class="form-label">Place</label>
                            <input type="text" class="form-control" id="place" name="created_place" required>
                        </div>
                        
                        <div id="product-items">
                            <div class="row align-items-end mb-3 product-row">
                                <div class="col-6">
                                    <label class="form-label">Product</label>
                                    <select name="products[]" class="form-select" required>
                                    <option value="" disabled selected>-- Choose product --</option>
                                    <?php foreach ($data['products'] as $product): ?>
                                        <option value="<?= $product['id'] ?>"><?= esc($product['name']) ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" class="form-control" name="quantities[]" min="1" value="1" required>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-danger btn-remove-product d-none">−</button>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="add-product" class="btn btn-secondary btn-sm">+ Add Product</button>
                        </div>

                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Invoice</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editInvoiceModal" tabindex="-1" aria-labelledby="editInvoiceModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg overflow-y-auto">
                    <div class="modal-content">
                        <form method="post" action="/admin/invoices/update">
                            <?= csrf_field() ?>
                            <input type="hidden" name="invoice_id" id="edit_invoice_id">

                            <select name="company_id" id="edit_company" class="form-select" required>
                                <?php foreach ($data['companies'] as $c): ?>
                                <option value="<?= $c['id'] ?>"><?= esc($c['name']) ?></option>
                                <?php endforeach ?>
                            </select>

                            <input type="text" class="form-control" name="place" id="edit_place">

                            <div id="edit_product_items"></div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="w-100 shadow-sm mh-10 py-4 mb-4 px-5 bg-white d-flex flex-row-reverse">
                <a href="<?= base_url("/logout") ?>" class="btn text-bg-danger text-wrap">Logout</a>
            </div>
            
            <div class="px-5 py-4">
                <div class="shadow rounded bg-white p-4 overflow-auto">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Invoices</li>
                    </ol>

                    <div class="d-flex justify-content-between mb-4">
                        <h3>Invoices</h3>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newInvoiceModal">Add Invoice</a>
                    </div>
                    <table class="table shadow-sm border table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Facture Code</th>
                                <th scope="col">Company</th>
                                <th scope="col">Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data["invoices"] as $key => $invoice): ?>
                                <tr>
                                    <td scope="row"><?= $key + 1 ?></td>
                                    <td><?= $invoice['invoice_number'] ?></td>
                                    <td><?= $invoice['company_name'] ?></td>
                                    <td><?= date('l, d F Y', strtotime($invoice['created_at'])) ?></td>
                                    <td class="d-flex gap-2">
                                        <a href="#" 
                                            class="btn btn-primary btn-detail-invoice"
                                            data-id="<?= $invoice['id'] ?>" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#invoiceDetailModal">
                                            Detail
                                        </a>
                                        <a href="<?= base_url("/admin/invoices/delete/".$invoice['id']) ?>"
                                            class="btn btn-danger">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice Detail Modal -->
    <div class="modal fade" id="invoiceDetailModal" tabindex="-1" aria-labelledby="invoiceDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceDetailLabel">Invoice Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="invoice-detail-content">
                <div class="text-center py-5">Loading...</div>
            </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        document.getElementById('add-product').addEventListener('click', function () {
            const productItems = document.getElementById('product-items');
            const lastRow = productItems.querySelector('.product-row:last-child');
            const newRow = lastRow.cloneNode(true);

            newRow.querySelector('select').selectedIndex = 0;
            newRow.querySelector('input').value = '1';
            newRow.querySelector('.btn-remove-product').classList.remove('d-none');

            productItems.appendChild(newRow);
            });

            document.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-remove-product')) {
                e.target.closest('.product-row').remove();
            }
        });
    </script>

    <script>
        document.querySelectorAll('.btn-detail-invoice').forEach(button => {
            button.addEventListener('click', function () {
                const invoiceId = this.dataset.id;
                const contentDiv = document.getElementById('invoice-detail-content');

                contentDiv.innerHTML = '<div class="text-center py-5">Loading...</div>';

                fetch(`/admin/invoices/detail/${invoiceId}`)
                .then(response => response.text())
                .then(html => {
                    contentDiv.innerHTML = html;
                })
                .catch(err => {
                    contentDiv.innerHTML = '<div class="text-danger">Failed to load invoice details.</div>';
                });
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