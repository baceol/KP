<div class="py-5 text-center">
    <h2>Tambah Dokumen</h2>
</div>

<div class="row g-3 justify-content-center">
    <div class="col-md-7 col-lg-8">
        <form class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
            <div class="row g-3">

                <div class="col-12">
                    <label for="nomor" class="form-label">Nomor Dokumen</label>
                    <input type="text" class="form-control" id="nomor" name="nomor" required>
                    <div class="invalid-feedback">
                        Nomor dokumen dibutuhkan.
                    </div>
                </div>

                <div class="col-12">
                    <label for="tanggal" class="form-label">Tanggal Dokumen</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    <div class="invalid-feedback">
                        Tanggal dibuat dibutuhkan.
                    </div>
                </div>

                <div class="col-12">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                    <div class="invalid-feedback">
                        Keterangan dokumen dibutuhkan.
                    </div>
                </div>

                <div class="col-12">
                    <label for="isi" class="form-label">Isi Dokumen</label>
                    <textarea class="form-control" id="isi" name="isi" required></textarea>
                    <div class="invalid-feedback">
                        Isi dokumen dibutuhkan.
                    </div>
                </div>

                <div class="col-12">
                    <label for="role" class="form-label">Dapat dilihat</label><br/>
                    <div class="row">
                    <?php
                    foreach ($result as $role) {
                        if ($role->role_id == 1) {
                            echo '
                            <div class="col-md-4 mb-2">
                            <input checked type="checkbox" class="form-check-input" id="role" name="role[]" value="' . $role->role_id . '">
                            <label class="form-check-label col" for="role"></label>' . $role->role_name . '</label>
                            </div>
                            ';
                        } else {
                            echo '
                            <div class="col-md-4 mb-2">
                            <input type="checkbox" class="form-check-input" id="role" name="role[]" value="' . $role->role_id . '">
                            <label class="form-check-label col" for="role"></label>' . $role->role_name . '</label>
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
                        <option selected disabled value="">Pilih Tipe</option>
                        <?php
                        foreach ($result2 as $type){
                            echo "<option value = '". $type->doc_id ."'>". $type->doc_jenis ."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-12">
                    <label for="document" class="form-label">Dokumen</label>
                    <input type="file" class="form-control" id="document" name="document" required>
                    <div class="invalid-feedback">
                        File dokumen dibutuhkan.
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" value="true" type="submit" name="btnSubmit">Simpan</button>
        </form>
    </div>
</div>