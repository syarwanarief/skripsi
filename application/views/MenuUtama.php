<div class="content-wrapper" style="border: 5px solid #dedede; height: 100%">
    <section class="content">
        <div class="col-md-12">
            <font size="4" style="padding-left:20px" color="#000000"><b><br><br> Sumber Jurnal : </b></font>


            <p align="center"><img src="../../../ijostLogo.jpg" width="300px" height="100px"
                                   style="float:left; margin-left: 20px"/>
                <img src="../../../LOGO_GARUDA.gif" width="100px" height="100px"/>
                <img src="../../../UNIVERSITASTEKNOKRAT.png" width="100px" height="100px"
                     style="float:right;padding-right:20px"/></p>


            <fieldset style="padding:40px; margin:20px">
                <form method="post" enctype="multipart/form-data" action="<?php echo base_url('HasilPencarian/scraping') ?>">
                    Jurnal Yang Dicari :
                    <input name="Cari" type="text" style="width:50%; padding:5px" required="">
                        <input type="submit" name="submitCari" class="btn btn-primary pull-right" style="padding: 5px" value="Cari">
                            <i class="glyphicon glyphicon-edit"></i>
                </form>
            </fieldset>
        </div>
    </section>
</div>