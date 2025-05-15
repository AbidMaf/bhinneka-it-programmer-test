<h5>Facture: <?= esc($invoice['invoice_number']) ?></h5>
<p><strong>Company:</strong> <?= esc($invoice['company_name']) ?></p>
<p><strong>Date:</strong> <?= date('d F Y', strtotime($invoice['created_at'])) ?></p>
<p><strong>Place:</strong> <?= esc($invoice['created_place']) ?></p>

<hr>
<h6>Items:</h6>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Code</th>
      <th>Product</th>
      <th>Qty</th>
      <th>Price</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($invoiceItems as $item): ?>
      <tr>
        <td><?= esc($item['product_code']) ?></td>
        <td><?= esc($item['product_name']) ?></td>
        <td><?= $item['quantity'] ?></td>
        <td>Rp<?= number_format($item['product_price'], 0, ',', '.') ?></td>
        <td>Rp<?= number_format($item['total_price'], 0, ',', '.') ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="w-100 d-flex justify-content-around">
    <div class="d-flex flex-column align-items-center gap-5">
        <span>Purchasing</span>
        <strong><?= $invoice['first_name'] ?></strong>
    </div>
    <div class="d-flex flex-column align-items-center gap-5">
        <span><?= $invoice['created_place'].', '.date('d F Y', strtotime($invoice['created_at'])) ?></span>
        <strong><?= $invoice['company_owner'] ?></strong>
    </div>
</div>