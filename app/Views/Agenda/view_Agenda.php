<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>

<head>
    <!-- DataTables -->
    <link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
</head>
<div class="col-sm-12">
    <div class="page-content-wrapper">


        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <ul class="list-inline float-left mb-0">
                            <h4 class="mt-e header-title">Data Agenda</h4>
                        </ul>
                        <ul class="list-inline float-right mb-0">
                            <!-- Jam -->
                            <h6>
                                <?php
                                date_default_timezone_set("Asia/Bangkok");
                                ?>

                                <script type="text/javascript">
                                    function date_jam(id) {
                                        date = new Date;
                                        year = date.getFullYear();
                                        month = date.getMonth();
                                        months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                                        d = date.getDate();
                                        day = date.getDay();
                                        days = new Array('Ahad', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
                                        h = date.getHours();
                                        if (h < 10) {
                                            h = "0" + h;
                                        }
                                        m = date.getMinutes();
                                        if (m < 10) {
                                            m = "0" + m;
                                        }
                                        s = date.getSeconds();
                                        if (s < 10) {
                                            s = "0" + s;
                                        }
                                        result = '' + days[day] + ' ' + d + ' ' + months[month] + ' ' + year + ' ' + h + ':' + m + ':' + s;
                                        document.getElementById(id).innerHTML = result;
                                        setjamout('date_jam("' + id + '");', '1000');
                                        return true;
                                    }
                                </script>

                                <span id="date_jam"></span>
                                <script type="text/javascript">
                                    window.onload = date_jam('date_jam');
                                </script>
                                <!-- Batas jam -->
                            </h6>
                        </ul>
                    </div>
                    <div class="col-sm-12">
                        <div class="page-content-wrapper">


                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-header">
                                            <h4 class="mt-e header-title">Data Agenda</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-sm btn-warning" data-target="#addModal" data-toggle="modal">Tambah Data</button>
                                            </div>
                                            <br>
                                            <div id="datatable_wrapper" class="dataTables repper container-fluid dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table class="table table-sm table-secondary " id="dataagenda">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th>No</th>
                                                                    <th>Id Agenda</th>
                                                                    <th>Nama Kegiatan</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Jam</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $no = 0;
                                                                foreach ($agenda as $val) {
                                                                    $no++; ?>
                                                                    <tr role="row" class="odd">
                                                                        <td><?= $no; ?></td>
                                                                        <td><?= $val['id_agenda'] ?></td>
                                                                        <td><?= $val['nama_kegiatan'] ?></td>
                                                                        <td><?= $val['tanggal'] ?></td>
                                                                        <td><?= $val['jam'] ?></td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-warning btn-sm btn-edit" data-id_agenda="<?= $val['id_agenda']; ?>" data-nama="<?= $val['nama_kegiatan']; ?>" data-tanggal="<?= $val['tanggal']; ?>" data-jam="<?= $val['jam']; ?>">
                                                                                <i class=" fa fa-tags"></i>
                                                                            </button>
                                                                            <button type="button" class="btn btn-success btn-sm btn-delete" data-id_agenda="<?= $val['id_agenda']; ?>">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Delete -->

                    <form action="/agenda/delete" method="post">
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus agenda</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h3>Apakah Yakin Menghapus Data Ini? </h3>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" class="id">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Form Edit -->
                    <form action="/agenda/update" method="post">
                        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Data agenda</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <label>Id Agenda</label>
                                            <input type="text" class="form-control id" name="id">
                                        </div>
                                        <div class="col-md-12">
                                            <label><b>Nama Kegiatan</b></label>
                                            <input type="text" class="form-control nama_kegiatan" name="nama_kegiatan">
                                        </div>
                                        <div class="col-md-12">
                                            <label><b>Tanggal</b></label>
                                            <input type="date" class="form-control tanggal" name="tanggal">
                                        </div>
                                        <div class="col-md-12">
                                            <label><b>Jam</b></label>
                                            <input type="time" class="form-control jam" name="jam">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-warning">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Form Tambah -->

                    <form action="/agenda/save" method="post">
                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h4>Periksa Entrian Form</h4>
                                </hr />
                                <?php echo session()->getFlashdata('error'); ?>
                                <button type="button" id="addModal" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">&jams;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">agenda</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <label>Id Agenda</label>
                                            <input type="text" class="form-control" name="id_agenda" placeholder=id agenda>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Nama Kegiatan</label>
                                            <input type="text" class="form-control" name="nama_kegiatan" placeholder=nama agenda>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal" placeholder=tanggal>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Jam</label>
                                            <input type="time" class="form-control" name="jam" placeholder=jam>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-warning">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script>
                        //script delete
                        $('.btn-delete').on('click', function() {
                            const id = $(this).data('id_agenda');
                            $('.id').val(id);
                            $('#deleteModal').modal('show');
                        });

                        $('.btn-edit').on('click', function() {
                            const id = $(this).data('id_agenda');
                            const namakegiatan = $(this).data('nama');
                            const tanggal = $(this).data('tanggal');
                            const jam = $(this).data('jam');

                            $('.id').val(id);
                            $('.nama_kegiatan').val(namakegiatan);
                            $('.tanggal').val(tanggal);
                            $('.jam').val(jam).trigger('change');
                            $('#updateModal').modal('show');
                        });
                        //script datatable
                        $(document).ready(function() {
                            $('#dataagenda').DataTable();
                        });
                    </script>
                    <?= $this->endSection('') ?>