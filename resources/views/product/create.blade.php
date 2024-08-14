<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8 mt-2">
            <div class="card bg-dark" style="width: 26rem;">
                <div class="card-body">
                    <h5 class="card-title text-warning">Create New Product</h5>
                    <form action="<?= route('product.store') ?>" method="POST">
                        <div class="mb-3 input-group-sm">
                            <label class="form-label text-light">Name</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" name="name">
                        </div>
                        <div class="mb-3 input-group-sm">
                            <label class="form-label text-light">Qty</label>
                            <input type="number" class="form-control" aria-describedby="emailHelp" name="qty">
                        </div>
                        <div class="mb-3 input-group-sm">
                            <label class="form-label text-light">Category</label>
                            <input type="number" class="form-control" aria-describedby="emailHelp" name="category">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Submit</button>
                    </form>
                </div>
            </div>
            <a href="<?= route('product.index') ?>" class="btn btn-danger btn-sm mt-5 p-2"><i class="bi bi-skip-backward-fill"></i> BACK TO PRODUCTS</a>
        </div>
    </div>
</div>