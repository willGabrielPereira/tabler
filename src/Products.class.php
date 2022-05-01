<?php
require_once __DIR__ . '/bootstrap.php';

class Products extends ModelBase
{
    protected $table = 'products';

    public $id;
    public $description;
    public $available;
    public $barcode;
    public $value;
    public $deleted_at;
    public $created_at;
    public $updated_at;


    public function insert()
    {
        $query = $this->insertQuery([
            'description' => $this->description,
            'available' => $this->available,
            'barcode' => $this->barcode,
            'value' => $this->value,
        ]);

        return $this->run($query);
    }

    public function update()
    {
        $query = $this->where('id', '=', $this->id)->updateQuery([
            'description' => $this->description,
            'available' => $this->available,
            'barcode' => $this->barcode,
            'value' => $this->value,
        ]);

        return $this->run($query);
    }
}
