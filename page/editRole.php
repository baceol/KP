<div class="py-5 text-center">
    <h2>Ubah Jabatan Pengguna</h2>
</div>

<div class="row g-3 justify-content-center">
    <div class="col-md-7 col-lg-8">
        <form class="needs-validation" method="post" novalidate>
            <div class="row g-3">
                <div class="col-12">
                    <label for="name" class="form-label">Nama Jabatan</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $result->role_name ?>" required>
                    <div class="invalid-feedback">
                        Name dibutuhkan.
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" value="true" type="submit" name="btnSubmit">Simpan</button>
        </form>
    </div>
</div>
