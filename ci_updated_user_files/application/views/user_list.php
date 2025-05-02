
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #4682B4; color: #fff; }
        .content-section { background-color: #87CEEB; padding: 30px; border-radius: 15px; box-shadow: 0 0 15px rgba(0,0,0,0.2); }
        h2, .table th { color: #fff; }
        .table td { background-color: #eafafa; color: #000; }
        .btn-primary, .btn-warning, .btn-danger { border-radius: 8px; }
        .custom-table tbody tr:nth-child(odd) { background-color: #e0f7fa; }
        .custom-table tbody tr:nth-child(even) { background-color: #f0ffff; }
        .custom-table th { background-color: #003366; color: white; }
        .custom-table { border-radius: 1rem; overflow: hidden; }
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
                <th>ID</th><th>Name</th><th>Email</th><th>Education</th><th>City</th><th>Gender</th><th>Images</th><th>Action</th>
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
                    <td><?= isset($user->city) ? $user->city : '-' ?></td>
                    <td><?= isset($user->gender) ? $user->gender : '-' ?></td>
                    <td>
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <?php $img = 'image_' . $i; if (!empty($user->$img)): ?>
                                <img src="<?= base_url('uploads/' . $user->$img) ?>" width="50" height="50">
                            <?php endif; ?>
                        <?php endfor; ?>
                    </td>
                    <td>
                        <a href="<?= site_url('user/edit/' . $user->id); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= site_url('user/delete/' . $user->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</a>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
