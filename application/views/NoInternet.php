<div class="content-wrapper" style="border: 5px solid #dedede; height:100%">
    <section class="content">
        <div class="col-md-12">
            <form method="post" enctype="multipart/form-data"
                  action="<?php echo base_url('HasilPencarian/scraping') ?>">
                Jurnal Yang Dicari :
                <input name="Cari" type="text" style="width:50%; padding:5px" required="">
                <input type="submit" name="submitCari" class="btn btn-primary pull-right" style="padding: 5px"
                       value="Cari">
                <i class="glyphicon glyphicon-edit"></i>
            </form>
        </div>
        <br>
        <br><br>
        <h3><b>Tidak Terhubung Ke Internet</b></h3>
        <p>Silahkan Hubungkan Perangkat Anda Dengan Internet dan Masukkan Kembali Kata Kunci Yang Anda Cari</p>
    </section>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</div>