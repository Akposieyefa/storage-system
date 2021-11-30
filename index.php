<?php 
    require_once __DIR__.'/vendor/autoload.php';

    use App\DotEnv;
    use App\FileSystem;

    (new DotEnv(__DIR__ . '/.env'))->load();

    $fileSystem = new FileSystem();

    $response = array();
    
    //provide the user_image and user_id
    if (isset($_FILES['user_image']['tmp_name']) && $_POST['user_id']) {
        $tmp_file = $_FILES['user_image']['tmp_name'];
        $img_name = $_FILES['user_image']['name'];
        $upload_dir = "./uploads/".$img_name;
        $user_id = $_POST['user_id'];

        $query = $fileSystem->create($user_id,$img_name);

        if (move_uploaded_file($tmp_file,$upload_dir) && $query) {
            $response['message'] = 'Image uploaded successfully';
            $response['status_code'] = 200;
        }else {
            $response['message'] = 'Error something went wrong';
            $response['status_code'] = 404;
        }
    }

    echo json_encode($response);
