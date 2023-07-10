
<section class="row">
    <?= $this->session->flashdata('message'); ?>
    <?= form_error('content', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>" data-objek="Data Konten"></div>
    <div class="row">
        <div class="col-lg-12">
            <a href="" class="btn btn-primary mb-3 newKontenModalButton" data-toggle="modal" data-target="#newKontenModal">Add New Content</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Header</th>
                        <th scope="col">Content</th>
                        <th scope="col">Footer</th>
                        <th scope="col">Last Updated</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($content as $key) : ?>
                        <tr>
                            <th scope="row"><?= $no ?></th>
                            <td><?= $key['title'] ?></td>
                            <td><?= $key['header'] ?></td>
                            <td><?= $key['content'] ?></td>
                            <td><?= $key['footer'] ?></td>
                            <td><?= $key['last_updated'] ?></td>
                            <td>
                                <a href="<?= base_url("DataMaster/updateKonten/$key[id]"); ?>" class="badge bg-success updateKontenModalButton" data-toggle="modal" data-target="#newKontenModal" data-id="<?= $key['id'] ?>">Edit</a>
                                <a href="<?= base_url("DataMaster/deleteKonten/$key[id]"); ?>" class="badge bg-danger tombol-hapus" data-hapus="Konten">Hapus</a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>


</section>
    <!-- /.container-fluid -->
<!-- Modal -->
<div class="modal fade" id="newKontenModal" tabindex="-1" aria-labelledby="newKontenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newKontenModalLabel">Tambah konten baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('DataMaster/konten') ?>" method="post">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                        <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="header" name="header" placeholder="Header">
                        <?= form_error('header', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="konten" name="content" rows="3"></textarea>
                        <?= form_error('content', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="footer" name="footer" placeholder="Footer">
                        <?= form_error('footer', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>