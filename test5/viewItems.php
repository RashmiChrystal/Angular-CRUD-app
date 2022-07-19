<html>
    <body>
    <!-- Edit Student Modal -->
    <div class="modal fade" id="itemEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>
        <div>
            <h4>Items Summary</h4>
            <table id="summaryTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item Name</th>
                        <th>Item Description</th>
                        <th>Item Location</th>
                        <th>Item Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                            <?php
                                require 'dbcon.php';
    
                                $query = "SELECT * FROM items";
                                $query_run = mysqli_query($con, $query);
    
                                if(mysqli_num_rows($query_run) > 0)
                                {
                                    foreach($query_run as $item)
                                    {
                                        ?>
                            <tr>
                                <td>
                                    <?= $item['id'] ?>
                                </td>
                                <td>
                                    <?= $item['name'] ?>
                                </td>
                                <td>
                                    <?= $item['description'] ?>
                                </td>
                                <td>
                                    <?= $item['location'] ?>
                                </td>
                                <td>
                                    <?= $item['price'] ?>
                                </td>
                                <td>
                                    <button type="button" value="<?=$item['id'];?>" class="editItemBtn btn btn-success btn-sm">Edit</button>
                                    <button type="button" value="<?=$item['id'];?>" class="deleteItemBtn btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <?php
                                    }
                                }
                                ?>

                        </tbody>
            </table>
        </div>
        <script>
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

                        } else if (res.status == 200) {

                            $('#itemEditModal').modal('hide');
                            $('#updateItem')[0].reset();
                            $('#summaryTable').load(location.href + "#summaryTable");
                            alert(res.message);

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

                                $('#summaryTable').load(location.href + "#summaryTable");
                                alert(res.message);
                            }
                        }
                    });
                }
            });
        </script>
    </body>
    
</html>