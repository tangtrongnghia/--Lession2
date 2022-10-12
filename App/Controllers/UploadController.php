<?php

namespace App\Controllers;

use System\Core\Controller;

class UploadController extends Controller
{
    public $path = 'uploads/';

    public function store()
    {
        $this->isMethod('POST');
        #kiểm tra có chọn file này không
        if ($_FILES['file']['name'] == '') {
            return json(['error' => true, 'message' => 'Vui lòng chọn file']);
        }

        #Nếu upload file hình ảnh
        if (!getimagesize($_FILES['file']['tmp_name'])) {
            return json(['error' => true, 'message' => 'Vui lòng chọn đúng file ảnh']);
        }

        #kiểm tra dung lượng file
        if ($_FILES['file']['size'] > 2024000) #2MB
        {
            return json(['error' => true, 'message' => 'Dung lượng tối đá 2MB']);
        }

        #tạo đường dẩn upoload tạm
        $targetFile = $this->path . basename($_FILES['file']['name']);

        #kiểm tra file có tồn tại hay không
        if (file_exists($targetFile)) {
            $targetFile = $this->path . rand(11111, 99999999) . basename($_FILES['file']['name']);
        }

        #kiểm tra định dạng file
        $fileType   = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $typeArray  = $this->hasType($this->input('type'));

        if (!in_array($fileType, $typeArray)) {
            return json(['error' => true, 'message' => 'File không đúng định dạng cho phép ' . implode('.', $typeArray)]);
        }

        #upload file
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            return json(['error' => false, 'url' => $targetFile]);
        }

        return json(['error' => true, 'message' => 'Có lỗi, vui lòng thử lại!']);
    }

    protected function hasType($type = '')
    {
        switch($type)
        {
            case 'images':
                return $this->hasTypeImage();
                break;
            default: return [];
        }
    }

    protected function hasTypeImage()
    {
        return ['jpg', 'jpeg', 'png', 'rar', 'txt', 'gif'];
    }
}
