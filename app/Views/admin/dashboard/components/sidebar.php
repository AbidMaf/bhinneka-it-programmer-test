<div class="sidebar col-2 h-100 rounded-end shadow bg-white py-4 z-3">
    <img src="<?= base_url('assets/images/logo-bhinneka.png') ?>" alt="Logo" class="img-fluid mx-auto d-block w-75" style="max-height: 72px; object-fit: cover;" />
    <ul class="navbar-nav flex-column mt-4 px-3 d-flex flex-col gap-2">
        <li class="ps-2 nav-item <?= uri_string() == 'admin/dashboard' || uri_string() == 'admin/' ? 'text-bg-primary rounded' : '' ?>">
            <a class="nav-link" href="/admin">Dashboard</a>
        </li>
        <li class="ps-2 nav-item <?= uri_string() == 'admin/invoices' ? 'text-bg-primary rounded' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/invoices') ?>">Invoices</a>
        </li>
        <li class="ps-2 nav-item <?= uri_string() === 'admin/products' ? 'text-bg-primary rounded' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/products') ?>">Products</a>
        </li>
        <li class="ps-2 nav-item <?= uri_string() == 'admin/companies' ? 'text-bg-primary rounded' : '' ?>">
            <a class="nav-link" href="<?= base_url(relativePath: 'admin/companies') ?>">Companies</a>
        </li>
    </ul>
</div>