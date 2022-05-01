<?php
require_once __DIR__ . '/bootstrap.php';

class Products extends ModelBase
{
    protected $table = 'products';

    protected $id;
    protected $description;
    protected $available;
    protected $barcode;
    protected $value;
    protected $deleted_at;
    protected $created_at;
    protected $updated_at;


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
        $query = $this->updateQuery([
            'description' => $this->description,
            'available' => $this->available,
            'barcode' => $this->barcode,
            'value' => $this->value,
        ]);

        return $this->run($query);
    }
}
