<div class="container mt-5">
    <div class="row">
        <div class="col-lg-5 mt-5">
            <ul class="list-group shadow">
                <li class="list-group-item list-group-item-dark active fw-bold" aria-current="true">
                    DETAIL PRODUCT : <?= $product->name ?>
                </li>
                <li class="list-group-item">Nama  : <?= $product->name ?></li>
                <li class="list-group-item">Qty   : <?= $product->qty ?></li>
                <li class="list-group-item">Category : <?= $product->category ?></li>
            </ul>
            <a href="<?= route('product.index') ?>" class="btn btn-danger btn-sm mt-5 p-2"><i class="bi bi-skip-backward-fill"></i> BACK TO PRODUCTS</a>
        </div>
    </div>
</div>