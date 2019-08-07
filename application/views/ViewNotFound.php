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
        <form method="post" enctype="multipart/form-data"
              action="<?php echo base_url('filter') ?>">
            <select class="form-control" required="" onChange="changeTextBox();" name="kat"
                    style="padding: 5px">
                <option value="">--Tampilkan Berdasarkan Website--</option>
                <?php foreach ($website

                as $data): ?>
                <option value="<?php echo $data; ?>"><?php echo $data;
                    endforeach; ?></option>
            </select>
            <input type="submit" name="submit" class="btn btn-primary pull-right" style="padding: 5px"
                   value="Tampilkan">
            <i class="glyphicon glyphicon-edit"></i>
            <?php
            if (isset($_POST['submit'])) {
                $selected_val = $_POST['kat'];  // Storing Selected Value In Variable
            }
            ?>
        </form>
        <br><br>
        <h3><b>Artikel Yang Anda Cari Tidak Ditemukan</b></h3>
        <p>Silahkan cari dengan keyword pencarian yang lain.</p>
    </section>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</div>