<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= isset($user) ? 'Edit User' : 'Add User'; ?></title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #008B8B; /* Dark Blue  */
            color: #fff;
        }
        .form-container {
            background-color: #20B2AA; /* LightSeaGreen */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        .form-label {
            color: #fff; /* White labels */
        }
        .form-control, .form-select {
            border: 2px solid #fff;
            border-radius: 10px;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 10px rgba(255,255,255,0.5);
            border-color: #fff;
        }
    </style>
</head>
<body text>

<div class="container mt-5">
    <div class="form-container">
        <h2 class="mb-4"><?= isset($user) ? 'Edit User' : 'Add New User'; ?></h2>

        <form method="post" enctype="multipart/form-data" action="<?= isset($user) ? site_url('user/update/'.$user->id) : site_url('user/store') ?>">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="<?= isset($user) ? $user->name : '' ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= isset($user) ? $user->email : '' ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Education</label>
                <input type="text" name="education" class="form-control" value="<?= isset($user) ? $user->education : '' ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">City</label>
                <select name="city" class="form-select">
                    <option value="">-- Select City --</option>
                    <option value="Navi Mumbai" <?= isset($user) && $user->city == 'Navi Mumbai' ? 'selected' : '' ?>>Navi Mumbai</option>
                    <option value="Thane" <?= isset($user) && $user->city == 'Thane' ? 'selected' : '' ?>>Thane</option>
                    <option value="Pune" <?= isset($user) && $user->city == 'Pune' ? 'selected' : '' ?>>Pune</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" value="Male" <?= (isset($user->gender) && $user->gender == 'Male') ? 'checked' : '' ?>>
                    <label class="form-check-label text-white">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" value="Female" <?= (isset($user->gender) && $user->gender == 'Female') ? 'checked' : '' ?>>
                    <label class="form-check-label text-white">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" value="Other" <?= (isset($user->gender) && $user->gender == 'Other') ? 'checked' : '' ?>>
                    <label class="form-check-label text-white">Other</label>
                </div>
            </div>

    <div class="mb-3">
        <label class="form-label" >Upload 4 Images</label>
        <br>
        <label>Image 1:</label>
		
        <input type="file" name="image_1">
		<?php if (!empty($user->image_1)): ?>
		    <br><img src="<?= base_url('uploads/' . $user->image_1) ?>" width="100">
		<?php endif; ?>
		<br><br>

		<label>Image 2:</label>
		<input type="file" name="image_2">
		<?php if (!empty($user->image_2)): ?>
		    <br><img src="<?= base_url('uploads/' . $user->image_2) ?>" width="100">
		<?php endif; ?>
		<br><br>

		<label>Image 3:</label>
		<input type="file" name="image_3">
		<?php if (!empty($user->image_3)): ?>
		    <br><img src="<?= base_url('uploads/' . $user->image_3) ?>" width="100">
		<?php endif; ?>
		<br><br>

		<label>Image 4:</label>
		<input type="file" name="image_4">
		<?php if (!empty($user->image_4)): ?>
		    <br><img src="<?= base_url('uploads/' . $user->image_4) ?>" width="100">
		<?php endif; ?>
		<br><br>

    </div>

                    <hr>
        <h5>Address Details</h5>

        <div class="mb-3">
            <label for="address_line" class="form-label">Address Line</label>
            <input type="text" name="address_line" class="form-control" id="address_line"
                   value="<?= isset($address) ? $address->address_line : '' ?>">
        </div>

        <div class="row">
            <div class="mb-3 col-md-4">
                <label for="address_city" class="form-label">City</label>
                <input type="text" name="address_city" class="form-control" id="address_city"
                       value="<?= isset($address) ? $address->city : '' ?>">
            </div>
            <div class="mb-3 col-md-4">
                <label for="state" class="form-label">State</label>
                <input type="text" name="state" class="form-control" id="state"
                       value="<?= isset($address) ? $address->state : '' ?>">
            </div>
            <div class="mb-3 col-md-4">
                <label for="zipcode" class="form-label">Zipcode</label>
                <input type="text" name="zipcode" class="form-control" id="zipcode"
                       value="<?= isset($address) ? $address->postal_code : '' ?>">
            </div>
        </div>


            <button type="submit" class="btn btn-light text-dark" >Save</button>
            <a href="<?= site_url('user'); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
