<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>

<div class="col-md-12">
    <div class="card card-outline">
        <div class="invoice col-sm-12 p-3 mb-3">
            <!--title row -->
            <div id="div1">
                <div class="row">
                    <div class="col-12">
                        <table>
                            <tr>
                                <td width=200>
                                    <img src="<?= base_url() ?>assets/images/LogoMasjid.png" width="100" alt="">
                                </td>
                                <td width=580>
                                    <center>
                                        <p>
                                        <h4>Masjid Baitussalam</h4>
                                        </p>
                                        <p>
                                        <h5>Komp Unand Blok D</h5>
                                        </p>
                                    </center>
                                </td>
                                <td width=200></td>
                            </tr>
                        </table>
                        <center>
                            <b>Tanggal Masuk : <?= date('d F Y', strtotime($tgla)) ?> Sampai Dengan
                                <?= date('d F Y', strtotime($tglb)) ?></b>
                        </center>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr role="row">
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Kas Masuk</th>
                                    <th>Jenis Kas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                $semua = 0;
                                foreach ($data as $val) {
                                    $s = $val['kas_masuk'];
                                    $semua = $s + $semua;
                                    $no++; ?>
                                    <tr role="row" class="odd">
                                        <td><?= $no; ?></td>
                                        <td><?= $val['tanggal'] ?></td>
                                        <td><?= $val['ket'] ?></td>
                                        <td><?= $val['kas_masuk'] ?></td>
                                        <td><?= $val['jenis_kas'] ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="3">Total Pemasukkan</td>
                                    <td><?= $semua ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <br><br><br><br>
                        Padang, <?= date('d / M / Y') ?>
                        <br><br><br>
                        Ketua <br>
                        DR. Ridho Rahman, S.Kom, M.Kom
                    </div>
                </div>
            </div>

            <div class="row no-print">
                <div class="col-12">
                    <button onclick="PrintContent('div1')" class="btn btn-primary"><i class="fa fa-print"></i>
                        Print
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function PrintContent(el) {
        var restorepage = document.body.innerHTML;
        var PrintContent = document.getElementById(el).innerHTML;
        document.body.innerHTML = PrintContent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>

<?= $this->endSection('') ?>