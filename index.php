<?php

    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    $no_of_records_per_page = 10;
    
    $offset = ($pageno-1) * $no_of_records_per_page;


    include 'database.php';
    $b = new database();
    $b->select("sample_properties","*");
    $result = $b->sql;
    $total_rows = $result->num_rows;
    
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    
    $c = new database();
    $c->selectWithLimit("sample_properties","*", null, $offset, $no_of_records_per_page);
    $result_2 = $c->sql;
    $total_rows_2 = $result_2->num_rows;
    
?>

<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Properties Listing Sample</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/all.min.css" rel="stylesheet">

  </head>

  <body>

    <header>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <strong>Properties Listing Sample</strong>
          </a>
        </div>
      </div>
    </header>

    <main role="main">

      <div class="album py-2">
        <div class="container">

            <div class="row">
                <div class="col-md-3 mb-3 bg-light">
                    <h2 class="m-3">Search</h2>
                    <form>
                      <div class="form-group">
                        <input type="text" name="town" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Town">
                      </div>
                      <div class="form-group">
                        <input type="number" name="num_bedrooms" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Number of Bedrooms">
                      </div>
                      <div class="form-group">
                        <input type="number" name="price" class="form-control" id="price" aria-describedby="price" placeholder="Price">
                      </div>
                      <div class="form-group">
                        <select name="type" class="form-control">
                            <option>Select a type</option>
                            <option value="">Rent</option>
                            <option value="">Sell</option>
                        </select>
                      </div>
                      
                      <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
                <div class="col-md-9">
                <?php while ($row = mysqli_fetch_assoc($result_2)) { ?>
                <div class="card mb-3 bg-light">
                  <div class="row no-gutters">
                    <div class="col-md-4 mt-2 mb-2">
                      <img src="<?php echo $row['image_thumbnail']; ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $row['property_type_title']; ?></h5>
                        <h5 class="card-title"><?php echo $row['price']; ?></h5>
                        <p class="card-text"><?php echo $row['property_type_description']; ?></p>
                        <div class="fur-areea mt-2 mb-2">
                            <p class="card-text mt-0 mb-0"><strong><small class="text-muted"><i class="fa fa-location-check"></i> Location:</small></strong>
                                <small class="text-muted"><?php echo $row['address'].', '.$row['county']; ?></small>
                                <small class="text-muted"><?php echo $row['town'].', '.$row['country']; ?></small></p>
                        </div>
                        

                        <div class="fur-areea m-2">
                            <span class="text-muted mt-2 mb-2"><i class="fa fa-home"></i><?php echo $row['num_bedrooms']; ?> Bedrooms</span>
                            <span class="text-muted mt-2 mb-2"><i class="fa fa-toilet"></i><?php echo $row['num_bathrooms']; ?> Toilets</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
                </div>
                
            </div>
            <div class="row">
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-end">
                    <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                    <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                    </li>
                    <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                        <a class="page-link"href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                    </li>
                    <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                        <a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a>
                    </li>
                  </ul>
                </nav>
            </div>
        </div>
      </div>

    </main>
    
  </body>
</html>
