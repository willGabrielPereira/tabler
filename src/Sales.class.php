<?php
require_once __DIR__ . '/bootstrap.php';

class Sales extends ModelBase
{
    protected $table = 'sales';

    public function product()
    {
        if (!$this->id) // Se ainda a venda ainda não foi capturada, não é possível capturar o produto relacionado
            return false;

        dd('aa');
    }

    public function insert()
    {
    }

    public function update()
    {
    }
}
