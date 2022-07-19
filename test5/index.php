<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous">

    <title>
        AngularJS CRUD
    </title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.3/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.30/angular-ui-router.min.js" integrity="sha512-HdDqpFK+5KwK5gZTuViiNt6aw/dBc3d0pUArax73z0fYN8UXiSozGNTo3MFx4pwbBPldf5gaMUq/EqposBQyWQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="controller.js"></script>
</head>

<body>
    <!-- Add Item modal-->
    <!-- <div class="modal fade" id="itemAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="saveItem">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="">Description</label>
                            <input type="text" name="description" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="">Location</label>
                            <input type="text" name="location" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="">Price</label>
                            <input type="number" name="price" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

    <!-- Edit Student Modal -->
    <!-- <div class="modal fade" id="itemEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateItem">
                    <div class="modal-body">

                        <input type="hidden" name="item_id" id="item_id">

                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Description</label>
                            <input type="text" name="description" id="description" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Location</label>
                            <input type="text" name="location" id="location" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Price</label>
                            <input type="number" name="price" id="price" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

    <div ng-app="mainApp" ng-controller="CRUDController">
        
        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <a ui-sref="home" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Home</a>
                        <a ui-sref="viewItems" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">View Your Items</a>
                        <a ui-sref="addItem" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Add New Items</a>
                        
                    </div>
                </div>
                <div>
                    <div ui-view></div>
                </div> 
            </div>
        </div>
    </div>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).on('submit', '#saveItem', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_item", true);
            console.log(formData);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 422) {
                        alert(res.message);
                        // $('#errorMessage').removeClass('d-none');
                        // $('#errorMessage').text(res.message);

                    } else if (res.status == 200) {

                        // $('#errorMessage').addClass('d-none');
                        $('#itemAddModal').modal('hide');
                        $('#saveItem')[0].reset();
                        alert(res.message);
                        // alertify.set('notifier', 'position', 'top-right');
                        // alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    } else if (res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editItemBtn', function () {

            var item_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "code.php?item_id=" + item_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {

                        $('#item_id').val(res.data.id);
                        $('#name').val(res.data.name);
                        $('#description').val(res.data.description);
                        $('#location').val(res.data.location);
                        $('#price').val(res.data.price);

                        $('#itemEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateItem', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_item", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    
                    if (res.status == 422) {
                        alert(res.message);
                        // $('#errorMessageUpdate').removeClass('d-none');
                        // $('#errorMessageUpdate').text(res.message);

                    } else if (res.status == 200) {

                        // $('#errorMessageUpdate').addClass('d-none');

                        // alertify.set('notifier', 'position', 'top-right');
                        // alertify.success(res.message);

                        $('#itemEditModal').modal('hide');
                        $('#updateItem')[0].reset();
                        alert(res.message);
                        $('#myTable').load(location.href + " #myTable");

                    } else if (res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });


        $(document).on('click', '.deleteItemBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var item_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_item': true,
                        'item_id': item_id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            // alertify.set('notifier', 'position', 'top-right');
                            // alertify.success(res.message);
                            alert(res.message);
                            $('#myTable').load(location.href + " #myTable");
                        }
                    }
                });
            }
        });</script>
</body>

</html>