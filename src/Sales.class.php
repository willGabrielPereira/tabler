<?php
require_once __DIR__ . '/bootstrap.php';

class Sales extends ModelBase
{
    protected $table = 'sales';

    public $id;
    private $product;
    public $product_id;
    public $amount;
    public $unit_value;
    public $deleted_at;
    public $created_at;
    public $updated_at;

    public function product()
    {
        if (!$this->product_id)
            return false;

        if ($this->product && $this->product->id == $this->product_id)
            return $this->product;

        $this->product = (new Products())->where('id', '=', $this->product_id)->get()[0];
        return $this->product;
    }

    public function insert()
    {
        if (isset($this->update_amount) && $this->update_amount == 'true') {
            $this->product()->value = $this->unit_value;
            $this->product()->update();
        }

        $query = $this->insertQuery([
            'product_id' => $this->product_id,
            'amount' => $this->amount,
            'unit_value' => $this->unit_value,
        ]);

        return $this->run($query);
    }

    public function update()
    {
        $query = $this->where('id', '=', $this->id)->updateQuery([
            'product_id' => $this->product_id,
            'amount' => $this->amount,
            'unit_value' => $this->unit_value,
        ]);

        return $this->run($query);
    }
}
