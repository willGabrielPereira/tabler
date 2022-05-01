<?php

class ModelBase
{
    private $connection;
    protected $table;
    private $columns;
    private $where;
    private $orderBy;
    private $limit;
    private $model;
    private $debug = false;

    public function __construct($attr = null)
    {
        $this->connection = new Conexao('tabler');
        $this->connection->setConexao();
        $this->model = get_called_class();

        if ($attr)
            $this->fill($attr);
    }


    public function fill($attr)
    {
        foreach ($attr as $key => $value)
            $this->{$key} = $value;
    }

    public function run($query, $isSelect = false)
    {
        $results = $this->connection->query($query, !$isSelect);
        if (!$isSelect) return $results;

        $resultArray = [];
        $results = $this->connection->getArrayResults();

        foreach ($results as $row)
            $resultArray[] = new $this->model($row);

        return $resultArray;
    }


    public function get()
    {
        return $this->run($this->selectQuery(), true);
    }

    public function actives()
    {
        $this->whereRaw('deleted_at is null');
        return $this->run($this->selectQuery(), true);
    }

    public function deleteds()
    {
        $this->whereRaw('deleted_at is not null');
        return $this->run($this->selectQuery(), true);
    }


    ######################
    ### QUERY DEFAULTS ###
    ######################

    protected function selectQuery()
    {
        return 'SELECT ' . $this->getColumns() .
            ' FROM ' . $this->table .
            $this->getWhere() .
            ($this->orderBy ? ' ORDER BY ' . implode(', ', $this->orderBy) : '') .
            ($this->limit ? ' LIMIT ' . $this->limit : '') .
            ';';
    }

    protected function insertQuery($attrs)
    {
        $keys = implode(', ', array_flip($attrs));
        $values = '"' . implode('", "', $attrs) . '"';

        return 'INSERT INTO ' . $this->table . '(' . $keys . ') VALUES (' . $values . ');';
    }

    protected function updateQuery($attrs, $id = null)
    {
        if (!count($this->where))
            throw new \Exception('Não é possível fazer um UPDATE sem WHERE');

        $sets = [];
        foreach ($attrs as $key => $val)
            $sets[] = $key . ' = "' . $val . '"';

        return 'UPDATE ' . $this->table . ' SET ' .
            implode(', ', $sets) .
            ', updated_at = "' . date('Y-m-d H:m:s') . '"' .
            $this->getWhere();
    }

    /**
     * Função responsável por colocar os registros na lixeira (define uma data de exclusão)
     * 
     * @param null $id ID do registro que será colocado na lixeira
     * 
     * @return mixed
     */
    protected function deleteQuery($id = null)
    {
        if (!$id && !$this->id)
            throw new \Exception('É necessário passar um ID para que seja deletado!');

        $this->where('id', '=', $id ?: $this->id); // Adiciona o ID à instancia WHERE para ter certeza que será removido corretamente

        return $this->updateQuery([
            'deleted_at' => date('Y-m-d H:m:s')
        ]);
    }



    #####################
    ### QUERY BUILDER ###
    #####################

    public function select(...$columns)
    {
        foreach ($columns as $column)
            $this->columns[] = $column;
        return $this;
    }

    public function where($attr, $operation, $value, $andOr = 'and')
    {
        if (!in_array(strtolower($andOr), ['and', 'or']))
            $andOr = 'and';

        $this->where[] = strtoupper($andOr) . ' ' . $attr . ' ' . $operation . ' "' . $value . '"';
        return $this;
    }

    public function whereRaw($where, $andOr = 'and')
    {
        if (!in_array(strtolower($andOr), ['and', 'or']))
            $andOr = 'and';

        $this->where[] = strtoupper($andOr) . ' ' . $where;
        return $this;
    }

    public function orderBy($attribute, $descAsc = 'asc')
    {
        if (!in_array(strtolower($descAsc), ['desc', 'asc']))
            $descAsc = 'asc';

        $this->orderBy[] = $attribute . ' ' . $descAsc;
    }

    public function limit($limit)
    {
        $this->limit = $limit;
    }


    protected function getColumns()
    {
        if (!$this->columns)
            return '*';

        return implode(', ', $this->columns);
    }

    protected function getWhere()
    {
        if (!count($this->where))
            return '';

        return ' WHERE ' . substr(implode(' ', $this->where), 3);
    }
}
