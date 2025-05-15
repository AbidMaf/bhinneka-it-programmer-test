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
            <div class="modal fade" id="newCompanyModal" tabindex="-1" aria-labelledby="newCompanyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newCompanyModalLabel">Add Company</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="/admin/companies/create">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nameInput" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="nameInput" name="name" placeholder="ex: PT. Sinar Abadi">
                            </div>
                            <div class="mb-3">
                                <label for="ownerInput" class="form-label">Company Owner</label>
                                <input type="text" class="form-control" id="ownerInput" name="owner" placeholder="ex: Budi">
                            </div>
                            <div class="mb-3">
                                <label for="addressInput" class="form-label">Address</label>
                                <textarea type="text" class="form-control" id="addressInput" name="address" rows="3"></textarea>
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
            <div class="modal fade" id="editCompanyModal" tabindex="-1" aria-labelledby="editCompanyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <form method="post" action="/admin/companies/update">
                        <?= csrf_field() ?>
                        <input type="hidden" id="editId" name="id">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCompanyModalLabel">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="editName" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="editOwner" class="form-label">Company Owner</label>
                            <input type="text" class="form-control" id="editOwner" name="owner">
                        </div>
                        <div class="mb-3">
                            <label for="editAddress" class="form-label">Address</label>
                            <textarea type="text" class="form-control" id="editAddress" name="address" rows="3"></textarea>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        </div>
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
                        <li class="breadcrumb-item active" aria-current="page">Companies</li>
                    </ol>

                    <div class="d-flex justify-content-between mb-4">
                        <h3>Companies</h3>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newCompanyModal">Add Company</a>
                    </div>
                    <table class="table shadow-sm border table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Owner</th>
                                <th scope="col">Address</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data["companies"] as $key => $company): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $company['name'] ?></td>
                                <td><?= $company['owner'] ?></td>
                                <td><?= $company['address'] ?></td>
                                <td>
                                    <button class="btn btn-primary btn-edit" data-bs-toggle="modal"
                                    data-id="<?= $company['id'] ?>"
                                    data-name="<?= $company['name'] ?>"
                                    data-owner="<?= $company['owner'] ?>"
                                    data-address="<?= $company['address'] ?>"
                                    data-bs-target="#editCompanyModal" >Edit</button>
                                    <a href="/admin/companies/delete/<?= $company['id'] ?>" class="btn btn-danger">Delete</a>
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
                document.getElementById('editName').value = this.dataset.name;
                document.getElementById('editOwner').value = this.dataset.owner;
                document.getElementById('editAddress').value = this.dataset.address;
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