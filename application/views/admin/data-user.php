<div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0"><?= $title ?></h4>
        </div>
    </div>
    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors(); ?>
        </div>
    <?php endif ?>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>" data-objek="Data User"></div>
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Projects</h6>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($user_data as $key) : ?>
                                    <tr>
                                        <th scope="row"><?= $no ?></th>
                                        <td><?= $key['name'] ?></td>
                                        <td><?= $key['email'] ?></td>
                                        <td><?= $key['role'] ?></td>
                                        <td>
                                            <?php
                                            if ($key['is_active'] == 1) {
                                                echo "Active";
                                            } else {
                                                echo "Deactive";
                                            }
                                            ?>
                                        </td>
                                        <td><?= $key['date_created'] ?></td>

                                        <td><img src="<?= base_url("assets/img/$key[image]") ?>" class="img-thumbnail"></td>
                                        <td>
                                            <a href="" class="badge bg-warning setRoleButton" data-bs-toggle="modal" data-bs-target="#setRoleModal" data-id="<?= $key['uid'] ?>">Set Role</a>
                                        </td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->

</div>

<!-- Modal -->
<div class="modal fade" id="setRoleModal" tabindex="-1" aria-labelledby="setRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="setRoleModalLabel">Set Role pengguna</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/setRole/') ?>" method="post">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="">Role</label>
                        <select class="form-select" name="role_id" id="role_id">
                            <option value="">Pilih Role</option>
                            <?php foreach ($role as $r) : ?>
                                <option value="<?= $r['id'] ?>"><?= $r['role'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>