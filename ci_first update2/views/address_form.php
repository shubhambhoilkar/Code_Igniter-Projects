<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= isset($address) ? 'Edit' : 'Add' ?> Address</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-4"><?= isset($address) ? 'Edit' : 'Add' ?> Address</h2>

        <form action="<?= isset($address) ? site_url('address/update/'.$address->id) : site_url('address/store/'.$user_id) ?>" method="post">
            
            <div class="mb-3">
                <label for="address_line" class="form-label">Address Line</label>
                <input type="text" class="form-control" name="address_line" required 
                       value="<?= isset($address) ? $address->address_line : '' ?>">
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" name="city" required 
                       value="<?= isset($address) ? $address->city : '' ?>">
            </div>

            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" name="state" required 
                       value="<?= isset($address) ? $address->state : '' ?>">
            </div>

            <div class="mb-3">
                <label for="postal_code" class="form-label">Postal Code</label>
                <input type="text" class="form-control" name="postal_code" required 
                       value="<?= isset($address) ? $address->postal_code : '' ?>">
            </div>

            <button type="submit" class="btn btn-success"><?= isset($address) ? 'Update' : 'Add' ?> Address</button>
            <a href="<?= isset($address) 
                ? site_url('address/index/'.$address->user_id) 
                : site_url('user') ?>" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
</div>

</body>
</html>
