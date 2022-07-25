<?php

include __DIR__ . '/bootstrap.php';

include __DIR__ . '/PropertyService.php';

$PropertyService = new PropertyService();

$data = $PropertyService->getDBProperties();

$properties = $data['properties'];
$params = $data['params'];

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Properties</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Properties</h1>
    <form method="get" class="row m-3">
        <label class="col-sm-1 col-form-label col-form-label-sm">Sort By</label>
        <div class="col-sm-2">
        <select name="sort_by" class="form-select" onchange="this.form.submit()">
                <option selected>Sort By</option>
                <option value="town">Town</option>
                <option value="num_bedrooms">No. of bedrooms</option>
                <option value="price">Price</option>
                <option value="type">Property Tyoe</option>
            </select>
        </div>
    </form>

    <table class="table table-light table-striped">
        <thead>
            <tr>
                <th scope="col">&nbsp;</th>
                <th scope="col">County</th>
                <th scope="col">Country</th>
                <th scope="col">Town</th>
                <th scope="col">Description</th>
                <th scope="col">Address</th>
                <th scope="col">No. of Bedrooms</th>
                <th scope="col">No. of Bathrooms</th>
                <th scope="col">Price</th>
                <th scope="col">Sale / Rent</th>
                <th scope="col">Property Type</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($properties as $property) { ?>
            <tr>
                <td><img src="<?php echo $property->image_thumbnail ?>" class="img-responsive"></td>
                <td><?php echo $property->county ?></td>
                <td><?php echo $property->country ?></td>
                <td><?php echo $property->town ?></td>
                <td><?php echo $property->description ?></td>
                <td><?php echo $property->address ?></td>
                <td><?php echo $property->num_bedrooms ?></td>
                <td><?php echo $property->num_bathrooms ?></td>
                <td><?php echo $property->price ?></td>
                <td><?php echo $property->type ?></td>
                <td><?php echo $property->property_type_id ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="/?page=<?php echo $params['prev_page']; ?>">Previous</a></li>
            <li class="page-item"><a class="page-link" href="/?page=<?php echo $params['next_page']; ?>">Next</a></li>
        </ul>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
