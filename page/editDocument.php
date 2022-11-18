<div class="py-5 text-center">
    <h2>Ubah Dokumen</h2>
</div>

<div class="row g-3 justify-content-center">
    <div class="col-md-7 col-lg-8">
        <form class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
            <div class="row g-3">
                <div class="col-12">
                    <label for="nomor" class="form-label">Nomor Dokumen</label>
                    <input type="text" class="form-control" id="nomor" name="nomor" value="<?php echo $result->tbdoc_no_doc ?>" required>
                    <div class="invalid-feedback">
                        Nomor dokumen dibutuhkan.
                    </div>
                </div>

                <div class="col-12">
                    <label for="tanggal" class="form-label">Tanggal Dokumen</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d', strtotime($result->tbdoc_tgl_dibuat)) ?>" required>
                    <div class="invalid-feedback">
                        Tanggal dibuat dibutuhkan.
                    </div>
                </div>

                <div class="col-12">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $result->tbdoc_ket ?>" required>
                    <div class="invalid-feedback">
                        Keterangan dokumen dibutuhkan.
                    </div>
                </div>

                <div class="col-12">
                    <label for="isi" class="form-label">Isi Dokumen</label>
                    <textarea class="form-control" id="isi" name="isi" required><?php echo $result->tbdoc_isi ?></textarea>
                    <div class="invalid-feedback">
                        Isi dokumen dibutuhkan.
                    </div>
                </div>

                <div class="col-12">
                    <label for="isi" class="form-label">Dapat dilihat</label><br/>
                    <div class="row">
                        <?php
                        foreach ($used as $item) {
                            if ($item['status']) {
                                echo '
                                <div class="col-md-4 mb-2">
                                <input type="checkbox" class="form-check-input" id="role" name="role[]" value="' . $item['id'] . '" checked>
                                <label class="form-check-label col" for="role"></label>' . $item['name'] . '</label>
                                </div>
                                ';
                            } else {
                                echo '
                                <div class="col-md-4 mb-2">
                                <input type="checkbox" class="form-check-input" id="role" name="role[]" value="' . $item['id'] . '" >
                                <label class="form-check-label col" for="role"></label>' . $item['name'] . '</label>
                                </div>
                                ';
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="col-12">
                    <label for="role" class="form-label">Tipe Dokumen</label>
                    <select class="form-select mb-3" aria-label=".form-select-lg example" id="type" name="type" required>
                        <?php
                        foreach ($result2 as $type){
                            if ($type->doc_id == $result->tbdoc_jenis) {
                                echo "<option selected value = '" . $type->doc_id . "'>" . $type->doc_jenis . "</option>";
                            } else {
                                echo "<option value = '" . $type->doc_id . "'>" . $type->doc_jenis . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-12">
                    <label for="document" class="form-label">Dokumen</label>
                    <input type="file" class="form-control" id="document" name="document">
                </div>
            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" value="true" type="submit" name="btnSubmit">Simpan</button>
        </form>
    </div>
</div>