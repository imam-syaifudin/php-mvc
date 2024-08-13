<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8 mt-2">
            <div class="card bg-dark" style="width: 26rem;">
                <div class="card-body">
                    <h5 class="card-title text-warning">Create New User</h5>
                    <form action="<?= route('user.store') ?>" method="POST">
                        <div class="mb-3 input-group-sm">
                            <label class="form-label text-light">Nama</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" name="nama">
                        </div>
                        <div class="mb-3 input-group-sm">
                            <label class="form-label text-light">Umur</label>
                            <input type="number" class="form-control" aria-describedby="emailHelp" name="umur">
                        </div>
                        <div class="mb-3 input-group-sm">
                            <label class="form-label text-light">Email address</label>
                            <input type="email" class="form-control" aria-describedby="emailHelp" name="email">
                            <p id="emailHelp" class="form-text text-danger fst-italic text-decoration-underline">* We'll never share your email with anyone else.</p>
                        </div>
                        <div class="mb-3 input-group-sm">
                            <label class="form-label text-light">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Submit</button>
                    </form>
                </div>
            </div>
            <a href="<?= route('user.index') ?>" class="btn btn-danger btn-sm mt-5 p-2"><i class="bi bi-skip-backward-fill"></i> BACK TO USERS</a>
        </div>
    </div>
</div>