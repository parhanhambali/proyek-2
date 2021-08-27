<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Mata Uang Barang
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('mata') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open('', [], ['id_mata' => $mata['id_mata']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_mata">Nama Mata Uang</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('nama_mata', $mata['nama_mata']); ?>" name="nama_mata" id="nama_mata" type="text" class="form-control" placeholder="Nama Mata Uang ...">
                        <?= form_error('nama_mata', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>