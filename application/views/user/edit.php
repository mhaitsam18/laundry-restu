<!-- End of Main Content -->
<div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0"><?= $title ?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- Page Heading -->
                    <?= $this->session->flashdata('message'); ?>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>" data-objek="Profil"></div>
                    <?= form_error('password', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <div class="row">
                        <div class="col-lg-8">
                            <form action="<?= base_url('user/edit') ?>" method="post" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="gender" id="gender">
                                            <option>Select Gender</option>
                                            <?php if ($user['gender'] == 'Laki-laki') : ?>
                                                <option value="Laki-laki" selected>Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            <?php elseif ($user['gender'] == 'Perempuan') : ?>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan" selected>Perempuan</option>
                                            <?php endif ?>
                                        </select>
                                        <?= form_error('gender', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="birthday" class="col-sm-2 col-form-label">Birth Day</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $user['birthday'] ?>">
                                        <?= form_error('birthday', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="phone_number" name="phone_number" value="<?= $user['phone_number'] ?>">
                                        <?= form_error('phone_number', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Address"><?= $user['address'] ?></textarea>
                                        <?= form_error('address', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-2">Picture</div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <?php
                                                $image = base_url("assets/img/$user[image]");
                                                ?>
                                                <img src="<?= $image ?>" class="img-thumbnail img-preview">
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input img-input" id="image" name="image" onchange="previewImg()">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm">
                                        <button type="submit" class="btn btn-primary float-right">Save</button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-danger btn-block" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Delete Account</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->

    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="deleteAccountModalLabel">Are You Sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('User/delete') ?>" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <?= form_error('password', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImg() {
            const picture = document.querySelector('.img-input');
            const imgPreview = document.querySelector('.img-preview');
            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(picture.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>