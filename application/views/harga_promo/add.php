<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Input Harga Promo
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('harga_promo') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open('', [], ['id_harga_promo' => $id_harga_promo, 'user_id' => $this->session->userdata('login_session')['user']]); ?>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="id_harga_promo">ID Harga Promo</label>
                    <div class="col-md-4">
                        <input value="<?= $id_harga_promo; ?>" type="text" readonly="readonly" class="form-control">
                        <?= form_error('id_harga_promo', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tanggal_keluar">Tanggal Keluar</label>
                    <div class="col-md-4">
                        <input value="<?= set_value('tanggal_keluar', date('Y-m-d')); ?>" name="tanggal_keluar" id="tanggal_keluar" type="text" class="form-control date" placeholder="Tanggal Masuk...">
                        <?= form_error('tanggal_keluar', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="barang_id">Barang</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="barang_id" id="barang_id" class="custom-select">
                                <option value="" selected disabled>Pilih Barang</option>
                                <?php foreach ($barang as $b) : ?>
                                    <option value="<?= $b['id_barang'] ?>"><?= $b['id_barang'] . ' | ' . $b['nama_barang'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('barang/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('barang_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
               <!--  <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="harga">Harga</label>
                    <div class="col-md-5">
                        <input readonly="readonly" id="harga" type="number" class="form-control">
                    </div>
                </div>  !-->
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="jumlah_harga_promo">Promo</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('jumlah_harga_promo'); ?>" name="jumlah_harga_promo" id="jumlah_harga_promo" type="number" class="form-control" placeholder="Promo...">
                            <div class="input-group-append">
                                <span class="input-group-text" id="mata">%</span>
                            </div>
                        </div>
                        <?= form_error('jumlah_harga_promo', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
               <!--  <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="total_harga">Total Harga</label>
                    <div class="col-md-5">
                        <input readonly="readonly" id="total_harga" type="number" class="form-control">
                    </div>
                </div>   !-->
                <div class="row form-group">
                    <div class="col offset-md-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>