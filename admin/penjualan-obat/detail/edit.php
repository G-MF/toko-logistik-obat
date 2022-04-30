<!-- Modal edit-->
<div class="modal fade" id="modal-edit" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Edit Item Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="proses" method="POST">
                <div class="modal-body">

                    <input type="hidden" name="id_detail" id="edit_id_detail" readonly>
                    <input type="hidden" name="no_nota" id="edit_no_nota" readonly>

                    <div class="form-group">
                        <label for="kode_obat">Kode Obat</label>
                        <input type="text" class="form-control" id="edit_kode_obat" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="nama_obat">Nama Obat</label>
                        <input type="text" class="form-control" id="edit_nama_obat" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="text" class="form-control" id="edit_harga_jual" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="jenis_obat">Jenis Obat</label>
                        <input type="text" class="form-control" id="edit_jenis_obat" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="jumlah_stok">Jumlah Stok Tersedia</label>
                        <input type="text" class="form-control" name="jumlah_stok" id="edit_jumlah_stok" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="banyak_beli">Banyak Beli</label>
                        <input type="text" class="form-control" name="banyak_beli" id="edit_banyak_beli" required>
                    </div>

                    <div class="form-group">
                        <label for="sub_total">Sub Total</label>
                        <input type="text" class="form-control" name="sub_total" id="edit_sub_total" required readonly>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn bg-gradient-primary text-white" type="submit" name="edit">
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