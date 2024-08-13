<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <?php if ( sessionHas('success') ) : ?>
                <div class="alert alert-success" role="alert">
                   <?= session('success') ?>
                </div>
            <?php endif; ?>
           
            <?php if ( sessionHas('error') ) : ?>
                <div class="alert alert-danger" role="alert">
                   <?= session('error') ?>
                </div>
            <?php endif; ?>

            <div class="text-end">
                <a href="<?= route('user.create') ?>" class="btn btn-success btn-sm mb-3 fw-bold"><i class="bi bi-plus-circle-dotted mx-1"></i> CREATE USER</a>
            </div>
            <div class="table-responsive" style="border-radius: 5px;">
                <table class="table table-striped text-center shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Umur</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $index => $user) : ?>
                            <tr>
                                <th scope="row"><?= $index + 1 ?></th>
                                <td><?= $user->nama ?></td>
                                <td><?= $user->umur ?></td>
                                <td>
                                    <span class="badge text-bg-secondary">
                                        <?= $user->email ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= route('user.show', ['id' => $user->id]) ?>" class="btn btn-sm btn-primary text-light"><i class="bi bi-eye"></i></a>
                                    <a href="<?= route('user.edit', ['id' => $user->id]) ?>" class="btn btn-sm btn-warning text-light"><i class="bi bi-pencil"></i></a>
                                    <form method="POST" action="<?= route('user.destroy', ['id' => $user->id]) ?>" class="d-inline">
                                        <input type="hidden" name="_method" value="delete"/>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>