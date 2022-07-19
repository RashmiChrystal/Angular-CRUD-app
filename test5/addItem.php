<html>
    <body>
    <!-- Add Item modal-->
    <div class="modal fade" id="itemAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>

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

    <div>
            <h4>Items Catalogue
            </h4>
        </div>
        <div class="card-body">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
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
                        <button type="submit" class="btn btn-primary">Save Item</button>
                    </div>
                </form>
            </div>

    </div>

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
                        
                    } else if (res.status == 200) {

                        $('#saveItem')[0].reset();
                        alert(res.message);

                    } else if (res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        </script>
    </body>
</html>