<div class="py-5 text-center">
    <h2>Ubah Pengguna</h2>
</div>

<div class="row g-3 justify-content-center">
    <div class="col-md-7 col-lg-8">
        <form class="needs-validation" method="post" novalidate>
            <div class="row g-3">
                <div class="col-12">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $result->tbuser_nama ?>" required>
                    <div class="invalid-feedback">
                        Name dibutuhkan.
                    </div>
                </div>

                <div class="col-12">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>

                <div class="col-12">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select mb-3" aria-label=".form-select-lg example" id="role" name="role">
                        <?php
                        foreach ($result2 as $role){
                            if ($role->role_id == $result->tbuser_role) {
                                echo "<option selected value = '". $role->role_id ."'>". $role->role_name ."</option>";
                            } else {
                                echo "<option value = '". $role->role_id ."'>". $role->role_name ."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" value="true" type="submit" name="btnSubmit">Simpan</button>
        </form>
    </div>
</div>
