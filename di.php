<?php
class Database {
    protected $adapter;
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }
}


//定義一個Adapter 介面: 去規範繼承的介面一定都要執行哪些函式
interface Adapter{

}


class MysqlAdapter implements Adapter{

}

class PagAdapter implements Adapter{
    
}