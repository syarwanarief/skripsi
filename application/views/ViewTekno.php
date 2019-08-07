<style>
    table {
        width: 100%;
    }

    table, th, td {
        border: 1px solid #888888;
        border-collapse: collapse;
    }

    th {
        padding: 10px;
        text-align: center;
    }

    td {
        padding: 10px;
        text-align: left;
    }

    table#t01 tr:nth-child(even) {
        background-color: #eee;
    }

    table#t01 tr:nth-child(odd) {
        background-color: #fff;
    }

    table#t01 th {
        background-color: black;
        color: white;
    }
</style>
<div class="content-wrapper" style="border: 5px solid #dedede; height:fit-content">
    <section class="content">
        <div class="col-md-12">
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
            <br>
            <div class="table-responsive">
                <table class="table table-bordered align-center">

                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Jurnal</th>
                        <th>Abstract</th>
                        <th>Penulis</th>
                        <th>ISSUE</th>
                        <th>Sumber Jurnal</th>
                        <th>Link Download</th>
                    </tr>
                    </thead>

                    <?php
                    $no = 1;
                    foreach ($tekno

                    as $data):

                    if ($data->judul == "" || $data->penulis == null || $data->penerbit == " "){
                        echo "<tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Not Found</td>
                                        <td>Not Found</td>
                                        <td>Not Found</td>
                                        <td>Not Found</td>
                                        <td>Not Found</td>
                                        <td>Not Found</td>
                                    </tr>
                              </tbody>";
                    }else{
                    ?>

                    <tbody>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data->judul ?></td>
                        <td><a target="_blank" href=" <?php echo $data->abstract ?>">Abstract</a></td>
                        <td><?php echo $data->penulis ?></td>
                        <td><?php echo $data->penerbit ?></td>
                        <td><?php echo $data->sumber ?></td>
                        <?php
                        $search = 'scholar';
                        $zero = '0';
                        $url = $data->link;
                        if (preg_match("/{$search}/i", $url) || $url == null || preg_match("/{$zero}/i", $url)) {
                            echo "<td>Link Tidak Tersedia</td>";
                        } else {
                            echo "<td><a target=\"_blank\" href ='" . $url . "'>Download(PDF)</td>";
                        } ?>
                    </tr>
                    <?php }
                    endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</div>
