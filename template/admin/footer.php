<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <u>TOKO ARIF FAJAR TABALONG</u> 2022</span>
        </div>
    </div>
</footer>

<!-- Delete Modal-->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="<?= base_url('assets/img/trash.png') ?>" class="mb-3" style="width: 120px; height: 150px;">
                <h5><b>Data "<span id="name" style="text-decoration: underline;"></span>" Akan Dihapus, Lanjutkan?</b></h5>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="#" class="btn bg-gradient-danger text-white tombol-delete">
                    <i class="fa fa-check"> Ya</i>
                </a>
                <button class="btn bg-gradient-secondary text-white" type="button" data-dismiss="modal">
                    <i class="fa fa-times"> Batal</i>
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Report Modal-->
<div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Cetak Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group">

                    <div class="accordion mb-3" id="accordionExample">
                        <div class="card">
                            <button class="list-group-item list-group-item-action list-group-item-info text-center" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Tanaman Obat
                            </button>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form action="<?= base_url('admin/laporan/tanaman-obat') ?>" method="POST" target="_blank">
                                        <div class="form-group">
                                            <label for="kelompok">Cetak Berdasarkan Kelompok</label>
                                            <select class="form control select2" name="kelompok" id="kelompok" data-placeholder="Pilih" style="width: 100%;">
                                                <option value=""></option>
                                                <?php
                                                $kel = $koneksi->query("SELECT * FROM kelompok_tanaman ORDER BY id_kelompok DESC");
                                                foreach ($kel as $item) {
                                                ?>
                                                    <option value="<?= $item['nama'] ?>"><?= $item['nama'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <button type="submit" name="cetak" class="btn bg-gradient-primary btn-icon-split">
                                            <span class="icon text-white">
                                                <i class="fas fa-print"></i>
                                            </span>
                                            <span class="text text-white">Cetak</span>
                                        </button>
                                        <button type="submit" name="cetak_semua" class="btn bg-gradient-info btn-icon-split">
                                            <span class="icon text-white">
                                                <i class="fas fa-print"></i>
                                            </span>
                                            <span class="text text-white">Cetak Semua Data</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="<?= base_url('admin/laporan/obat-tradisional') ?>" target="blank" class="list-group-item list-group-item-action list-group-item-success text-center" aria-current="true">
                        Obat Tradisional
                    </a>

                </div>


            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn bg-gradient-dark text-white btn-block" type="button" data-dismiss="modal">
                    <i class="fa fa-times"> Batal</i>
                </button>
            </div>
        </div>
    </div>
</div>



<?php
if (isset($_SESSION['alert_ubah_pw'])) {
    echo "<script>toastr.$_SESSION[sts]('$_SESSION[alert_ubah_pw]')</script>";
    unset($_SESSION['sts']);
    unset($_SESSION['alert_ubah_pw']);
}
?>
<!-- Ubah Passowrd Modal-->
<div class="modal fade" id="modal-edit-pw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/edit-password') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pass_lama">Password Lama</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="pass_lama" id="pass_lama" minlength="5" maxlength="10" required>
                            <div class="input-group-append" id="btn_lama">
                                <button type="button" class="btn bg-gradient-dark" onclick="lihatpass('pass_lama');" title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass_baru">Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="pass_baru" id="pass_baru" minlength="5" maxlength="10" required>
                            <div class="input-group-append" id="btn_baru">
                                <button type="button" class="btn bg-gradient-dark" onclick="lihatpass('pass_baru');" title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted font-italic">*Password Minimal 5 Karakter | Maksimal 10 Karakter</small>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn bg-gradient-primary text-white" type="submit" name="edit-pw">
                        <i class="fa fa-save"> Simpan</i>
                    </button>
                    <button class="btn bg-gradient-dark text-white" type="button" data-dismiss="modal">
                        <i class="fa fa-times"> Batal</i>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>


<?php
if (isset($_SESSION['alert_ubah_username'])) {
    echo "<script>toastr.$_SESSION[sts]('$_SESSION[alert_ubah_username]')</script>";
    unset($_SESSION['sts']);
    unset($_SESSION['alert_ubah_username']);
}
?>
<!-- Ubah Username Modal-->
<div class="modal fade" id="modal-edit-username" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Ubah Username</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/edit-username') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <?php
                        $cek_username = $koneksi->query("SELECT username FROM admin WHERE id_admin = '$_SESSION[id_admin]'")->fetch_array();
                        ?>
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= $cek_username['username'] ?>" maxlength="10" required>
                    </div>
                    <div class="form-group">
                        <label for="konfirmasi_pass">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="konfirmasi_pass" id="konfirmasi_pass" minlength="5" maxlength="10" required>
                            <div class="input-group-append" id="btn_konfirmasi_pass">
                                <button type="button" class="btn bg-gradient-dark" onclick="lihatpass('konfirmasi_pass');" title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn bg-gradient-primary text-white" type="submit" name="edit-username">
                        <i class="fa fa-save"> Simpan</i>
                    </button>
                    <button class="btn bg-gradient-dark text-white" type="button" data-dismiss="modal">
                        <i class="fa fa-times"> Batal</i>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>


<!-- Logout Modal-->
<div class="modal fade" id="modal-logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="<?= base_url('assets/img/logout-icon.png') ?>" class="mb-3" style="width: 120px; height: 150px;">
                <h5>Anda Akan Keluar Dari Aplikasi, Lanjutkan?</h5>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="<?= base_url('logout') ?>" class="btn bg-gradient-danger text-white tombol-delete">
                    <i class="fa fa-check"> Ya</i>
                </a>
                <button class="btn bg-gradient-secondary text-white" type="button" data-dismiss="modal">
                    <i class="fa fa-times"> Batal</i>
                </button>
            </div>
        </div>
    </div>
</div>