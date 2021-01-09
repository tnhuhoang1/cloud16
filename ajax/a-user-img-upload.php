<?php
if(isset($_POST['uploadSubmit'])){
    $targetDir = "./userImages/";
    $targetFile = $targetDir . $_FILES['userImage']['name'];
    $update = 1;
    $typeOfFile = pathinfo($_FILES['userImage']['name'], PATHINFO_EXTENSION);
    // getImage
    if($typeOfFile == 'jpg' || $typeOfFile == 'png' || $typeOfFile == 'jpeg' || $typeOfFile == 'gif'){
        if(file_exists($targetFile)){
            echo "File da ton tai";
            $update = 0;
            }else{
            if($_FILES['userImage']['size'] > 1500000){
                echo "Dung luong file qua lon, vui long cho anh khac";
                $update = 0;
            }else{
                if($update == 1){
                    if(move_uploaded_file($_FILES['userImage']['tmp_name'], $targetFile)){
                        echo "Upload thanh cong";
                    }else{
                        echo "loi xay ra";
                    }
                }
            }
        }
    }else{
        echo "K phai file hinh anh";
        $update = 0;
    }
}

?>