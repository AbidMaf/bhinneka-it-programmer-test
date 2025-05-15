<form method="post" action="/admin/invoices/update">
  <?= csrf_field() ?>
  <input type="hidden" name="invoice_id" id="edit_invoice_id">

  <select name="company_id" id="edit_company" class="form-select" required>
    <?php foreach ($data['companies'] as $c): ?>
      <option value="<?= $c['id'] ?>"><?= esc($c['name']) ?></option>
    <?php endforeach ?>
  </select>

  <input type="text" class="form-control" name="place" id="edit_place">

  <div id="edit_product_items"> ... </div>
</form>
