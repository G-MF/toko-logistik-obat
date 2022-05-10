<!-- Modal Tambah-->
<div class="modal fade" id="modal-tambah" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Tambah Item Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="proses" method="POST">
                <div class="modal-body">

                    <input type="hidden" name="no_nota" value="<?= $data['no_nota'] ?>" readonly>

                    <div class="form-group">
                        <label for="kode_obat">Kode Obat</label>
                        <select name="kode_obat" id="kode_obat" class="form-control select2" required data-placeholder="Pilih">
                            <option value=""></option>
                            <?php
                            $obat = $koneksi->query("SELECT kode_obat, nama_obat FROM stok_obat");
                            foreach ($obat as $item) {
                            ?>
                                <option value="<?= $item['kode_obat'] ?>"><?= $item['kode_obat'] . ' - ' . $item['nama_obat'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_obat">Nama Obat</label>
                        <input type="text" class="form-control" name="nama_obat" id="nama_obat" required readonly>
                    </div>

                    <!-- HARGA BELI -->
                    <input type="hidden" class="form-control" name="harga_pembelian" id="harga_pembelian" readonly>

                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="text" class="form-control" name="harga_jual" id="harga_jual" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="jenis_obat">Jenis Obat</label>
                        <input type="text" class="form-control" name="jenis_obat" id="jenis_obat" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="jumlah_stok">Jumlah Stok Tersedia</label>
                        <input type="text" class="form-control" name="jumlah_stok" id="jumlah_stok" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="banyak_beli">Banyak Beli</label>
                        <input type="text" class="form-control" name="banyak_beli" id="banyak_beli" required>
                    </div>

                    <div class="form-group">
                        <label for="sub_total">Sub Total</label>
                        <input type="text" class="form-control" name="sub_total" id="sub_total" required readonly>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn bg-gradient-primary text-white" type="submit" name="tambah">
                        <i class="fa fa-save"> Simpan</i>
                    </button>
                    <button class="btn bg-gradient-secondary text-white" type="button" data-dismiss="modal">
                        <i class="fa fa-times"> Batal</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>