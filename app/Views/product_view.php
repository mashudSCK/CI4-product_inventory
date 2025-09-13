<?php
// Display session flashdata for errors or success
$session = session();
if ($session->getFlashdata('error')): ?>
    <div style="background:#ffe0e0;color:#b12704;padding:12px 18px;margin-bottom:18px;border-radius:5px;border:1px solid #f5c2c7;">
        <?= esc($session->getFlashdata('error')) ?>
    </div>
<?php endif; ?>
<?php if ($session->getFlashdata('success')): ?>
    <div style="background:#e6ffed;color:#1a7f37;padding:12px 18px;margin-bottom:18px;border-radius:5px;border:1px solid #b7ebc6;">
        <?= esc($session->getFlashdata('success')) ?>
    </div>
<?php endif; ?>
<style>
body {
    font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
    background: #f8fafb;
    margin: 0;
    padding: 0;
}
.header-bar {
    background: #fff;
    color: #232f3e;
    padding: 28px 0 14px 0;
    text-align: center;
    margin-bottom: 28px;
    border-bottom: 1px solid #ececec;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}
.header-bar h1 {
    margin: 0;
    font-size: 2.1rem;
    font-weight: 700;
    letter-spacing: 1px;
    color: #232f3e;
}
.inventory-container {
    max-width: 1080px;
    margin: 0 auto;
    padding: 0 12px 40px 12px;
}
.add-btn {
    background: #232f3e;
    color: #fff;
    border: none;
    padding: 12px 28px;
    border-radius: 6px;
    font-size: 16px;
    margin-bottom: 24px;
    cursor: pointer;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(35,47,62,0.04);
    transition: background 0.2s, box-shadow 0.2s;
    letter-spacing: 0.5px;
}
.add-btn:hover {
    background: #007185;
    box-shadow: 0 4px 16px rgba(0,113,133,0.08);
}
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 22px;
}
.product-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 1px 8px rgba(0,0,0,0.04);
    padding: 22px 16px 14px 16px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    position: relative;
    border: 1px solid #ececec;
    transition: box-shadow 0.15s, border 0.15s, transform 0.15s;
    min-height: 320px;
}
.product-card:hover {
    box-shadow: 0 6px 24px rgba(0,0,0,0.08);
    border: 1.5px solid #007185;
    transform: translateY(-2px) scale(1.01);
}
.product-card img {
    width: 100%;
    max-height: 120px;
    object-fit: cover;
    border-radius: 7px;
    margin-bottom: 10px;
    background: #f4f6f8;
}
.product-title {
    font-size: 17px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #232f3e;
    letter-spacing: 0.2px;
    line-height: 1.2;
}
.product-desc {
    font-size: 13px;
    color: #6b7280;
    margin-bottom: 10px;
    min-height: 32px;
    font-style: normal;
}
.product-price {
    font-size: 16px;
    color: #007185;
    font-weight: 600;
    margin-bottom: 12px;
    letter-spacing: 0.5px;
}
.product-meta {
    font-size: 12px;
    color: #888;
    margin-bottom: 8px;
}
.product-meta span {
    font-weight: 600;
}
.card-actions {
    margin-top: auto;
    width: 100%;
    display: flex;
    gap: 7px;
}
.edit-btn, .delete-btn {
    border: none;
    padding: 7px 16px;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    font-weight: 500;
    background: #f8fafb;
    color: #232f3e;
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    box-shadow: 0 1px 4px rgba(0,0,0,0.02);
}
.edit-btn {
    border: 1px solid #007185;
    background: #fff;
    color: #007185;
}
.edit-btn:hover {
    background: #007185;
    color: #fff;
}
.delete-btn {
    border: 1px solid #d7263d;
    background: #fff;
    color: #d7263d;
}
.delete-btn:hover {
    background: #d7263d;
    color: #fff;
}
.select-indicator {
    accent-color: #007185;
}

/* Modal Styles */
.modal-bg {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0; top: 0;
    width: 100%; height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.10);
}
.modal-content {
    background: #fff;
    margin: 5% auto;
    padding: 28px 22px 18px 22px;
    border: 1px solid #ececec;
    width: 340px;
    border-radius: 10px;
    position: relative;
    box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    animation: modalFadeIn 0.18s;
}
@keyframes modalFadeIn {
    from { opacity: 0; transform: translateY(-24px);}
    to { opacity: 1; transform: translateY(0);}
}
.close-modal {
    position: absolute;
    top: 10px;
    right: 18px;
    color: #bbb;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.2s;
}
.close-modal:hover {
    color: #d7263d;
}
.modal-content h2 {
    margin-top: 0;
    margin-bottom: 14px;
    color: #232f3e;
    font-size: 18px;
    font-weight: 700;
}
.modal-content label {
    display: block;
    margin-bottom: 4px;
    color: #232f3e;
    font-size: 13px;
    font-weight: 500;
}
.modal-content input[type="text"],
.modal-content input[type="number"] {
    width: 100%;
    padding: 7px 9px;
    margin-bottom: 12px;
    border: 1px solid #ececec;
    border-radius: 4px;
    font-size: 14px;
    background: #f8fafb;
    transition: border 0.2s;
}
.modal-content input[type="text"]:focus,
.modal-content input[type="number"]:focus {
    border: 1.5px solid #007185;
    outline: none;
}
.modal-content button[type="submit"] {
    background: #007185;
    color: #fff;
    border: none;
    padding: 8px 20px;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    margin-right: 8px;
    font-weight: 600;
    transition: background 0.2s;
}
.modal-content button[type="submit"]:hover {
    background: #232f3e;
}
.modal-content button[type="button"] {
    background: #ececec;
    color: #232f3e;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.2s;
}
.modal-content button[type="button"]:hover {
    background: #bbb;
    color: #fff;
}

/* Pagination Styles */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
    margin-top: 28px;
    font-size: 14px;
}
.pagination li {
    display: inline-block;
}
.pagination a, .pagination span {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 4px;
    color: #007185;
    background: #f8fafb;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.2s, color 0.2s;
    margin: 0 1px;
}
.pagination a:hover {
    background: #007185;
    color: #fff;
}
.pagination .active span,
.pagination .active a {
    background: #007185;
    color: #fff;
    pointer-events: none;
}
.filter-bar {
    display: flex;
    gap: 12px;
    align-items: center;
    margin-bottom: 22px;
    flex-wrap: wrap;
}
.filter-bar select, .filter-bar input[type="text"] {
    padding: 7px 14px;
    border-radius: 4px;
    border: 1px solid #ececec;
    font-size: 14px;
    background: #f8fafb;
    color: #232f3e;
}
.filter-bar button {
    background: #007185;
    color: #fff;
    border: none;
    padding: 8px 18px;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.2s;
}
.filter-bar button:hover {
    background: #232f3e;
}

/* Responsive Design */
@media (max-width: 900px) {
    .inventory-container {
        max-width: 100%;
        padding: 0 4px 24px 4px;
    }
    .products-grid {
        gap: 12px;
    }
    .modal-content {
        width: 98vw;
        min-width: 0;
        max-width: 400px;
        padding: 14px 4vw 14px 4vw;
    }
}
@media (max-width: 600px) {
    .header-bar {
        padding: 14px 0 8px 0;
        font-size: 1.1rem;
    }
    .header-bar h1 {
        font-size: 1.1rem;
    }
    .add-btn {
        width: 100%;
        padding: 12px 0;
        font-size: 14px;
    }
    .filter-bar {
        flex-direction: column;
        align-items: stretch;
        gap: 7px;
    }
    .products-grid {
        grid-template-columns: 1fr;
        gap: 8px;
    }
    .product-card {
        padding: 10px 4px 8px 4px;
    }
    .modal-content {
        width: 99vw;
        max-width: 99vw;
        padding: 8px 1vw 8px 1vw;
    }
    .pagination {
        font-size: 12px;
        gap: 1px;
    }
}
</style>

<div class="header-bar">
    <h1>🛒 Tindahan ni Taguro</h1>
</div>

<div class="inventory-container">
    <!-- Filter Bar -->
    <form method="get" class="filter-bar" action="">
        <select name="category">
            <option value="">All Categories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= esc($cat) ?>" <?= ($selectedCategory ?? '') === $cat ? 'selected' : '' ?>>
                    <?= esc($cat) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="search" placeholder="Search product..." value="<?= esc($search ?? '') ?>">
        <button type="submit">Filter</button>
        <?php if (!empty($selectedCategory) || !empty($search)): ?>
            <a href="<?= base_url('products') ?>" style="margin-left:8px;color:#007185;text-decoration:underline;">Reset</a>
        <?php endif; ?>
    </form>

    <!-- Create Product Button -->
    <button class="add-btn" onclick="document.getElementById('createModal').style.display='block'">+ Add Product</button>

    <!-- Modal for Create Product Form -->
    <div id="createModal" class="modal-bg">
        <div class="modal-content">
            <span class="close-modal" onclick="document.getElementById('createModal').style.display='none'">&times;</span>
            <h2>Add Product</h2>
            <form action="/ci-4/public/products/create" method="post" enctype="multipart/form-data">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" required>
                <label for="description">Description</label>
                <input type="text" name="description" required>
                <label for="category">Category</label>
                <input type="text" name="category" required placeholder="e.g. Electronics, Food">
                <label for="price">Price</label>
                <input type="number" name="price" step="0.01" required>
                <label for="stock">Stock</label>
                <input type="number" name="stock" min="0" required>
                <label for="image">Image</label>
                <input type="file" name="image" accept="image/*">
                <button type="submit">Add</button>
                <button type="button" onclick="document.getElementById('createModal').style.display='none'">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Modal for Edit Product Form -->
    <div id="editModal" class="modal-bg">
        <div class="modal-content">
            <span class="close-modal" onclick="document.getElementById('editModal').style.display='none'">&times;</span>
            <h2>Edit Product</h2>
            <form id="editForm" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit_id">
                <label for="edit_product_name">Product Name</label>
                <input type="text" name="product_name" id="edit_product_name" required>
                <label for="edit_description">Description</label>
                <input type="text" name="description" id="edit_description" required>
                <label for="edit_category">Category</label>
                <input type="text" name="category" id="edit_category" required>
                <label for="edit_price">Price</label>
                <input type="number" name="price" id="edit_price" step="0.01" required>
                <label for="edit_stock">Stock</label>
                <input type="number" name="stock" id="edit_stock" min="0" required>
                <label for="edit_image">Image</label>
                <input type="file" name="image" id="edit_image" accept="image/*">
                <div id="currentImage" style="margin-bottom:10px;"></div>
                <button type="submit">Update</button>
                <button type="button" onclick="document.getElementById('editModal').style.display='none'">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Product Details Modal -->
    <div id="detailsModal" class="modal-bg">
        <div class="modal-content" style="max-width:400px;">
            <span class="close-modal" onclick="document.getElementById('detailsModal').style.display='none'">&times;</span>
            <h2 id="detailsTitle">Product Details</h2>
            <div id="detailsImage" style="margin-bottom:12px;"></div>
            <div style="margin-bottom:8px;"><strong>Name:</strong> <span id="detailsName"></span></div>
            <div style="margin-bottom:8px;"><strong>Description:</strong> <span id="detailsDesc"></span></div>
            <div style="margin-bottom:8px;"><strong>Category:</strong> <span id="detailsCategory"></span></div>
            <div style="margin-bottom:8px;"><strong>Price:</strong> ₱<span id="detailsPrice"></span></div>
            <div style="margin-bottom:8px;"><strong>Stock:</strong> <span id="detailsStock"></span></div>
        </div>
    </div>

    <form id="bulkActionForm" method="post" action="/ci-4/public/products/bulk_action" style="margin-bottom:18px;">
        <div style="display:flex;align-items:center;gap:10px;">
            <select id="bulkActionSelect" name="bulk_action" required style="padding:7px 14px;border-radius:4px;border:1px solid #ececec;font-size:15px;">
                <option value="">Bulk Actions</option>
                <option value="delete">Delete Selected</option>
                <!-- Add more actions as needed -->
            </select>
            <button type="submit" style="background:#d7263d;color:#fff;border:none;padding:8px 18px;border-radius:4px;font-size:15px;cursor:pointer;font-weight:600;">Apply</button>
        </div>
        <div class="products-grid">
            <!-- Master checkbox, only visible when bulk action is selected -->
            <div id="masterCheckboxContainer" style="display:none;width:100%;margin-bottom:8px;">
                <label style="cursor:pointer;font-size:15px;">
                    <input type="checkbox" id="masterCheckbox" style="transform:scale(1.2);margin-right:6px;">
                    Select/Deselect All
                </label>
            </div>
            <?php foreach ($products as $product): ?>
            <div class="product-card">
                <!-- Individual checkbox, hidden by default, shown when bulk action is selected -->
                <input type="checkbox" class="select-indicator" name="selected_ids[]" value="<?= $product['id'] ?>" style="position:absolute;top:16px;right:16px;transform:scale(1.3);display:none;">
                <?php if (!empty($product['image'])): ?>
                    <img src="<?= base_url('uploads/products/' . $product['image']); ?>" alt="Product Image" style="width:100%;max-height:140px;object-fit:cover;border-radius:8px;margin-bottom:12px;">
                <?php endif; ?>
                <div class="product-title"><?= htmlspecialchars($product['product_name']); ?></div>
                <div class="product-desc"><?= htmlspecialchars($product['description']); ?></div>
                <div style="font-size:13px;color:#888;margin-bottom:6px;">
                    Category: <span style="color:#007185;font-weight:600;"><?= htmlspecialchars($product['category']); ?></span>
                </div>
                <div class="product-price">₱<?= number_format($product['price'], 2, '.', ','); ?></div>
                <div style="font-size:13px;color:#888;margin-bottom:10px;">
                    Stock: <span style="color:<?= ($product['stock'] <= 5) ? '#d7263d' : '#007185' ?>;font-weight:600;">
                        <?= (int)$product['stock'] ?>
                    </span>
                    <?php if ($product['stock'] <= 5): ?>
                        <span style="color:#d7263d;font-weight:600;">(Low!)</span>
                    <?php endif; ?>
                </div>
                <div class="card-actions">
                    <button class="edit-btn"
                        type="button"
                        onclick="openEditModal(<?= htmlspecialchars(json_encode($product), ENT_QUOTES, 'UTF-8'); ?>)">Edit</button>
                    <button class="edit-btn"
                        type="button"
                        style="background:#f4f6f8;color:#232f3e;border:1px solid #ececec;"
                        onclick="openDetailsModal(<?= htmlspecialchars(json_encode($product), ENT_QUOTES, 'UTF-8'); ?>)">View</button>
                    <a class="delete-btn" href="/ci-4/public/products/delete/<?= $product['id']; ?>"
                       onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </form>

    <!-- Pagination Links -->
    <?php if (isset($pager) && $pager): ?>
        <div>
            <?= $pager->links('products', 'default_full', [
    'query' => [
        'category' => $selectedCategory ?? '',
        'search' => $search ?? ''
    ]
]) ?>
        </div>
    <?php endif; ?>
</div>

<script>
// Show/hide checkboxes and master checkbox based on bulk action selection
document.getElementById('bulkActionSelect').addEventListener('change', function() {
    var show = this.value !== '';
    var indicators = document.querySelectorAll('.select-indicator');
    var masterContainer = document.getElementById('masterCheckboxContainer');
    indicators.forEach(function(cb) {
        cb.style.display = show ? 'block' : 'none';
        if (!show) cb.checked = false;
    });
    masterContainer.style.display = show ? 'block' : 'none';
    document.getElementById('masterCheckbox').checked = false;
});

// Master checkbox logic
document.getElementById('masterCheckbox').addEventListener('change', function() {
    var checked = this.checked;
    var indicators = document.querySelectorAll('.select-indicator');
    indicators.forEach(function(cb) {
        if (cb.style.display === 'block') cb.checked = checked;
    });
});

// Optional: Uncheck master if any individual is unchecked
document.querySelectorAll('.select-indicator').forEach(function(cb) {
    cb.addEventListener('change', function() {
        if (!this.checked) {
            document.getElementById('masterCheckbox').checked = false;
        }
    });
});

// Close modal when clicking outside the modal content
window.onclick = function(event) {
    var createModal = document.getElementById('createModal');
    var editModal = document.getElementById('editModal');
    var detailsModal = document.getElementById('detailsModal');
    if (event.target == createModal) {
        createModal.style.display = "none";
    }
    if (event.target == editModal) {
        editModal.style.display = "none";
    }
    if (event.target == detailsModal) {
        detailsModal.style.display = "none";
    }
}

// Open Edit Modal and populate form
function openEditModal(product) {
    document.getElementById('edit_id').value = product.id;
    document.getElementById('edit_product_name').value = product.product_name;
    document.getElementById('edit_description').value = product.description;
    document.getElementById('edit_category').value = product.category;
    document.getElementById('edit_price').value = product.price;
    document.getElementById('edit_stock').value = product.stock;
    document.getElementById('editForm').action = '/ci-4/public/products/update/' + product.id;
    // Show current image if exists
    var currentImageDiv = document.getElementById('currentImage');
    if (product.image) {
        currentImageDiv.innerHTML = '<img src="<?= base_url('uploads/products/'); ?>' + product.image + '" style="width:100%;max-height:100px;object-fit:cover;border-radius:6px;margin-bottom:8px;">';
    } else {
        currentImageDiv.innerHTML = '';
    }
    document.getElementById('editModal').style.display = 'block';
}

// Product Details Modal logic
function openDetailsModal(product) {
    document.getElementById('detailsTitle').textContent = "Product Details";
    document.getElementById('detailsName').textContent = product.product_name;
    document.getElementById('detailsDesc').textContent = product.description;
    document.getElementById('detailsCategory').textContent = product.category;
    document.getElementById('detailsPrice').textContent = parseFloat(product.price).toLocaleString('en-US', {minimumFractionDigits:2});
    document.getElementById('detailsStock').textContent = product.stock;
    var imgDiv = document.getElementById('detailsImage');
    if (product.image) {
        imgDiv.innerHTML = '<img src="<?= base_url('uploads/products/'); ?>' + product.image + '" style="width:100%;max-height:160px;object-fit:cover;border-radius:8px;">';
    } else {
        imgDiv.innerHTML = '';
    }
    document.getElementById('detailsModal').style.display = 'block';
}
</script>