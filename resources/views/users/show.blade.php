<div class="container mt-5">
    <div class="row">
        <div class="col-lg-5 mt-5">
            <ul class="list-group shadow">
                <li class="list-group-item list-group-item-dark active fw-bold" aria-current="true">
                    DETAIL USER : <?= $user->nama ?>
                </li>
                <li class="list-group-item">Nama  : <?= $user->nama ?></li>
                <li class="list-group-item">Email : <?= $user->email ?></li>
                <li class="list-group-item">Umur  : <?= $user->umur ?></li>
            </ul>
            <a href="<?= route('user.index') ?>" class="btn btn-danger btn-sm mt-5 p-2"><i class="bi bi-skip-backward-fill"></i> BACK TO USERS</a>
        </div>
    </div>
</div>