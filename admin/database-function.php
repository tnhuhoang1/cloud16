<?php
    require_once('database-connection.php');

    function insertTable($tableName, $data){
        global $conn;
        $sql = "insert into $tableName set ". array_key_first($data) .'= ?';
            foreach($data as $k => $v){
                if($k != array_key_first($data)){
                    $sql = $sql . ", $k = ?";
                }
            }
        echo $sql;
        $types = '';
        foreach($data as $v){
            if(is_int($v)){
                $types = $types.'i';
            }else if(is_double($v)){
                $types = $types.'d';
            }else{
                $types = $types.'s';
            }
        }
        
        $values = array_values($data);
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param($types, ...$values);
        $stmt -> execute();
        return $stmt; // return statement  
    }
    function selectWithAnd($tableName,$cols, $condition = [], $limit = 0){
        // limit = 0 => 0 limit
        global $conn;
        $sql = 'select ';
        foreach($cols as $k => $v){
            if($k == array_key_last($cols)){
                $sql = $sql ."$v ";
            }else{
                $sql = $sql ."$v, ";
            }
        }
        $sql = $sql ."from $tableName ";
        if(count($condition) > 0){
            $sql = $sql ."where ";
            foreach($condition as $k => $v){
                if($k == array_key_last($condition)){
                    $sql = $sql ."$k = ?";
                }else{
                    $sql = $sql ."$k = ? and ";
                }
                
            }
            $types = '';
            foreach($condition as $v){
                if(is_int($v)){
                    $types = $types.'i';
                }else if(is_double($v)){
                    $types = $types.'d';
                }else{
                    $types = $types.'s';
                }
            }
            $values = array_values($condition);
            
        }
        if($limit > 0){
            $sql = $sql ." limit $limit";
        }
        $stmt = $conn -> prepare($sql);
        if(count($condition) > 0){
            
            $stmt -> bind_param($types, ...$values);
        }
        $stmt -> execute();
        $record = $stmt -> get_result() ->fetch_all(MYSQLI_ASSOC);
        return $record;
    }
    function selectWithOr($tableName,$cols, $condition = [], $limit = 0){
        // limit = 0 => 0 limit
        global $conn;
        $sql = 'select ';
        foreach($cols as $k => $v){
            if($k == array_key_last($cols)){
                $sql = $sql ."$v ";
            }else{
                $sql = $sql ."$v, ";
            }
        }
        $sql = $sql ."from $tableName ";
        if(count($condition) > 0){
            $sql = $sql ."where ";
            foreach($condition as $k => $v){
                if($k == array_key_last($condition)){
                    $sql = $sql ."$k = ?";
                }else{
                    $sql = $sql ."$k = ? or ";
                }
                
            }
            $types = '';
            foreach($condition as $v){
                if(is_int($v)){
                    $types = $types.'i';
                }else if(is_double($v)){
                    $types = $types.'d';
                }else{
                    $types = $types.'s';
                }
            }
            $values = array_values($condition);
            
        }
        if($limit > 0){
            $sql = $sql ." limit $limit";
        }
        $stmt = $conn -> prepare($sql);
        if(count($condition) > 0){
            
            $stmt -> bind_param($types, ...$values);
        }
        $stmt -> execute();
        $record = $stmt -> get_result() ->fetch_all(MYSQLI_ASSOC);
        return $record;
    }
    

    function simpleQuery($sql, bool $isGet = true, $params = []){
        // is get = true => get else set
        // warning: it will throws fatal error if you dont know how to use it
        global $conn;
        $stmt = $conn -> prepare($sql);
        if(count($params) > 0){
            
            $types = '';
            foreach($params as $v){
                if(is_int($v)){
                    $types = $types.'i';
                }else if(is_double($v)){
                    $types = $types.'d';
                }else{
                    $types = $types.'s';
                }
            }
            $values = array_values($params);
            $stmt -> bind_param($types, ...$values);
            
        }
        $stmt -> execute();
        if($isGet){
            $record = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
            return $record;
        }else{
            return $stmt;
        }
    }
    function cout($value){
        echo "<pre>". print_r($value,true)."</pre>";
    }
?>