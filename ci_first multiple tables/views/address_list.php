<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Addresses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
            background-color: #DAA520; /* Goldern Rod */
            color: #fff;
        }
        .card {
            background-color: #FFD700; /* Gold  */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

</style>
<body >

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-4">Addresses of User ID: <?= isset($user_id) ? $user_id : '-' ?></h2>
        <a href="<?echo site_url('address/create/'.$user_id) ?>" class="btn btn-primary mb-3">+ Add New Address</a>

        <a href="<?echo site_url('user') ?>" class="btn btn-secondary mb-3 ms-2">← Back to User List</a>

        <div class="table-responsive rounded">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Address Line</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Postal Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($addresses)): ?>
                        <?php foreach ($addresses as $address): ?>
                        <tr>
                            <td><?= $address->id ?></td>
                            <td><?= $address->address_line ?></td>
                            <td><?= $address->city ?></td>
                            <td><?= $address->state ?></td>
                            <td><?= $address->postal_code ?></td>
                            <td>
                                <a href="<? echo site_url('address/edit/'.$address->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<? echo site_url('address/delete/'.$address->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this address?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No addresses found for this user.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
<!--
echo "<pre>USER ID: "; print_r($user_id); echo "</pre>";
echo "<pre>ADDRESSES: "; print_r($addresses); echo "</pre>";
-->