<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User List</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #4682B4; /* SteelBlue */
            color: #fff;
        }
        .content-section {
            background-color: #87CEEB; /* SkyBlue  */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        h2, .table th {
            color: #fff;
        }
        .table td {
            background-color: #eafafa;
            color: #000;
        }
        .btn-primary, .btn-warning, .btn-danger {
            border-radius: 8px;
        }
        .custom-table tbody tr:nth-child(odd) {
                background-color: #e0f7fa; /* light cyan */
        }

        .custom-table tbody tr:nth-child(even) {
                background-color: #f0ffff; /* even lighter cyan */
        }

        .custom-table th {
                background-color: #003366; /* dark navy */
                color: white;
        }

        .custom-table {
                border-radius: 1rem;
                overflow: hidden;
        }

    </style>
</head>
<body>

<div class="container mt-5 content-section">
    <h2 class="mb-4">User List</h2>
    
    <a href="<?php echo site_url('user/create'); ?>" class="btn btn-primary mb-3">+ Add New User</a>

    <div class="table-responsive rounded-4 overflow-hidden border">
    <table class="table custom-table mb-0 table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Education</th>
                <th>Education Level</th>
                <th>Institute</th>
                <th>City</th>
                <th>Gender</th>
                <th>Images</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) : ?>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= isset($user->education) ? $user->education : '-' ?></td>
                    <td><?= isset($user->education_level) ? $user->education_level : '-' ?></td>
                    <td><?= isset($user->institute) ? $user->institute : '' ?></td>
                    <td><?= isset($user->city) ? $user->city:'-' ?></td>
                    <td><?= isset($user->gender) ? $user->gender : '-' ?></td>
                    
                    <td>
                      <?php if (!empty($user->image_1)): ?>
                          <img src="<?= base_url('uploads/' . $user->image_1) ?>" width="50" height="50" class="img-thumbnail me-1 mb-1">
                      <?php endif; ?>
                      <?php if (!empty($user->image_2)): ?>
                          <img src="<?= base_url('uploads/' . $user->image_2) ?>" width="50" height="50" class="img-thumbnail me-1 mb-1">
                      <?php endif; ?>
                      <?php if (!empty($user->image_3)): ?>
                          <img src="<?= base_url('uploads/' . $user->image_3) ?>" width="50" height="50" class="img-thumbnail me-1 mb-1">
                      <?php endif; ?>
                      <?php if (!empty($user->image_4)): ?>
                          <img src="<?= base_url('uploads/' . $user->image_4) ?>" width="50" height="50" class="img-thumbnail me-1 mb-1">
                      <?php endif; ?>

                    </td>
                    
                    <td>
                        <a href="<?= site_url('user/edit/' . $user->id); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= site_url('user/delete/' . $user->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</a>
                        <a href="<?= site_url('address/index/'.$user->id) ?>" class="btn btn-sm btn-info">Addresses</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8" class="text-center">No users found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
  </div>
</div>

<!-- Bootstrap JS Bundle (for future components like modal, dropdown) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
