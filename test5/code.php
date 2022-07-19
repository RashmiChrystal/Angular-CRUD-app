<?php

require 'dbcon.php';

if(isset($_POST['save_item']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $price = mysqli_real_escape_string($con, $_POST['price']);

    if($name == NULL || $description == NULL || $location == NULL || $price == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO items (name,description,location,price) VALUES ('$name','$description','$location','$price')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Item Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Item Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_item']))
{
    $item_id = mysqli_real_escape_string($con, $_POST['item_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $price = mysqli_real_escape_string($con, $_POST['price']);

    if($name == NULL || $description == NULL || $location == NULL || $price == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE items SET name='$name', description='$description', location='$location', price='$price' 
                WHERE id='$item_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['item_id']))
{
    $item_id = mysqli_real_escape_string($con, $_GET['item_id']);

    $query = "SELECT * FROM items WHERE id='$item_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $item = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Item Fetch Successfully by id',
            'data' => $item
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Item Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_item']))
{
    $item_id = mysqli_real_escape_string($con, $_POST['item_id']);

    $query = "DELETE FROM items WHERE id='$item_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Item Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Item Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

?>
