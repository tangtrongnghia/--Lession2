<?php

namespace System\Core;

use Exception;

class Route
{
    protected $query = null;
    protected $controller = 'MainController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        #lấy thông tin query get
        $this->handleQuery();

        $fullcontroller = $this->handleController();
       

        if(!is_null($fullcontroller)){
            $fullcontrollerArray = explode('@', $fullcontroller);

            if(count($fullcontrollerArray) != 2)
            {
                throw new Exception('Format Controller Error', 500);
            }

            $this->controller = $fullcontrollerArray[0];
            $this->method = $fullcontrollerArray[1];

        }
    }


    protected function handleQuery(){
        if(isset($_GET['qQuery']) && !empty($_GET['qQuery'])){
            return $this->query = trim($_GET['qQuery'],'/');
        }
        return null;
    }

    protected function handleController(){
        #Nếu không có querytring thì trả về controller mặc định
        if(is_null($this->query))
        {
            return null;
        }

        #Kiểm tra query có nằm trong $_route hay không, nếu có thì trả về tên controller
        global $_Route;
        
        if(isset($_Route[$this->query]) && !empty($this->query)){
            return $_Route[$this->query];
        }


        #đếm số cấp trong url query
        $countQuery = count(explode('/', $this->query));
        foreach($_Route as $key => $value){
            $countKey = count(explode('/', $key));

            #nếu 2 giá trị cùng cấp với nhau thì kiểm tra
            if($countQuery == $countKey){

                #chuyển {name} và {id} về dạng regex cho $key
                $pregexString = preg_replace('/{(.*?)}/', '([a-zA-Z0-9\-]+)', $key);
                
                $pregexString = "/" . str_replace("/","\/",$pregexString) . "/i";

                #so sanh chuuỗi regex với query
                if(preg_match($pregexString, $this->query, $matches))
                {

                    #lây tham số từ route
                    preg_match_all('/{(.*?)}/i', $key, $pregexQuery);
                    
                    
                    #xóa bớt nội dung
                    unset($matches[0]);
                    
                    $this->params = array_combine($pregexQuery[1], array_values($matches));

                    return $value;
                    
                }
            }
        }
        return null;
    }
}