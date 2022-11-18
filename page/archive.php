<div class="row g-3 justify-content-center">
    <div class="col-md-7 col-lg-8">
        <form method="post">
            <div class="row g-3">

                <div class="col-4">
                    <label for="content" class="form-label">Isi Dokumen</label>
                    <input type="text" class="form-control" id="content" name="content">
                </div>

                <div class="col-4">
                    <label for="role" class="form-label">Tipe Dokumen</label>
                    <select class="form-select mb-3" aria-label=".form-select-lg example" id="type" name="type">
                        <option selected value="">Semua Tipe</option>
                        <?php

                        use Cassandra\Date;

                        foreach ($result2 as $type){
                            echo "<option value = '" . $type->doc_id . "'>" . $type->doc_jenis . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-4">
                    <label class="form-label"></label>
                    <button class="w-100 btn btn-primary btn-lg" value="true" type="submit" name="btnSubmit">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="bd-example">
    <table id="tableId" class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nomor Dokumen</th>
            <th scope="col">Keterangan</th>
            <th scope="col">File</th>
            <th scope="col">Tanggal Arsip</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($result as $document) {
            ?>
            <tr>
                <td><?php echo $document->tbdoc_no_doc ?></td>
                <td><?php echo $document->tbdoc_ket ?></td>
                <td><?php echo substr($document->tbdoc_storage, strpos($document->tbdoc_storage, '.', -strlen($document->tbdoc_storage)) + 1) ?></td>
                <td><?php echo date_format(date_create($document->tbdoc_tgl_arsip), 'Y-m-d') ?></td>
                <td class="col-3 text-end">
                    <?php
                    if (($_SESSION['session_user']->role_name == 'Ketua Divisi Sekretaris' || $_SESSION['session_user']->role_name == 'Anggota Divisi Sekretaris') && round((time() - strtotime($document->tbdoc_tgl_arsip)) / (60 * 60 * 24)) < 30) {
                        echo '<button type="button" class="btn btn-primary ms-2" title="undo" aria-label="undo" onclick="undoArchive(' . $document->tbdoc_id . ')"><i class="bi bi-arrow-counterclockwise"></i></button>';
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>