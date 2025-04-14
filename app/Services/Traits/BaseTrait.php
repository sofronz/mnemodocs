<?php
namespace App\Services\Traits;

use Illuminate\Database\Eloquent\Model;

trait BaseTrait
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param array $data
     *
     * @return Model
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param string $id
     *
     * @return bool
     */
    public function update(array $data, string $id)
    {
        $model = $this->model->find('id', $id);
        $model->update($data);

        return $model;
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function delete(string $id)
    {
        $model = $this->find('id', $id);
        $model->delete();

        return true;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function builder()
    {
        return $this->model->newQuery();
    }

    /**
     * @param string $field
     * @param string $value
     *
     * @return Model
     */
    public function find(string $field, string $value)
    {
        return $this->model->where($field, $value);
    }
}
