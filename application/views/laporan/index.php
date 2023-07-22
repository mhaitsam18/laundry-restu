<div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0"><?= $title ?></h4>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body p-5">
                    <h3 class=" mb-3">Pilih Tahun dan Bulan</h3>
                    <div class="row">
                        <div class="col-lg-3">
                            <form action="<?= base_url('Laundry/Laporan/print') ?>" method="post" target="_blank ">
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <input type="number" class="form-control" name="tahun" id="tahun" required value="<?= date('Y') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="bulan" class="form-label">Bulan</label>
                                    <select class="form-select" name="bulan" id="bulan" required>
                                        <option value="" selected disabled>Pilih Bulan</option>
                                        <option <?= (date('m') == '1') ? 'selected' : '' ?> value="1">Januari</option>
                                        <option <?= (date('m') == '2') ? 'selected' : '' ?> value="2">Februari</option>
                                        <option <?= (date('m') == '3') ? 'selected' : '' ?> value="3">Maret</option>
                                        <option <?= (date('m') == '4') ? 'selected' : '' ?> value="4">April</option>
                                        <option <?= (date('m') == '5') ? 'selected' : '' ?> value="5">Mei</option>
                                        <option <?= (date('m') == '6') ? 'selected' : '' ?> value="6">Juni</option>
                                        <option <?= (date('m') == '7') ? 'selected' : '' ?> value="7">Juli</option>
                                        <option <?= (date('m') == '8') ? 'selected' : '' ?> value="8">Agustus</option>
                                        <option <?= (date('m') == '9') ? 'selected' : '' ?> value="9">September</option>
                                        <option <?= (date('m') == '10') ? 'selected' : '' ?> value="10">Oktober</option>
                                        <option <?= (date('m') == '11') ? 'selected' : '' ?> value="11">November</option>
                                        <option <?= (date('m') == '12') ? 'selected' : '' ?> value="12">Desember</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary float-end">Cetak</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>\