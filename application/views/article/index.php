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
                        <div class="float-end"><a href="<?= base_url('Artikel/create') ?>" class="btn btn-primary btn-sm">Tambah Artikel</a></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">Tanggal</th>
                                    <th class="pt-0">Admin</th>
                                    <th class="pt-0">Judul</th>
                                    <th class="pt-0">Status</th>
                                    <th class="pt-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($artikel as $row) : ?>
                                    <td><?= $row['title'] ?></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['title'] ?></td>
                                    <td>
                                        <?php if (!$row['published_at'] && $row['deleted_at']) : ?>
                                            <span class="badge bg-danger">Unpublish</span>
                                        <?php elseif (!$row['published_at']) : ?>
                                            <span class="badge bg-primary">Draft</span>
                                        <?php else : ?>
                                            <span class="badge bg-success">Publish</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="<?= base_url() ?>/Artikel/show/<?= $row['article_id'] ?>" class="d-inline mx-1 text-dark">Detail</a>
                                            <a href="<?= base_url() ?>/Artikel/edit/<?= $row['article_id'] ?>" class="d-inline mx-1 text-primary">Edit</a>
                                            <a href="<?= base_url() ?>/Artikel/delete/<?= $row['article_id'] ?>" class="d-inline mx-1 text-danger">Delete</a>
                                            <div class="d-inline mx-1 dropdown">
                                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    status
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Draft</a></li>
                                                    <li><a class="dropdown-item" href="#">Publish</a></li>
                                                    <li><a class="dropdown-item" href="#">Unpublish</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->

</div>