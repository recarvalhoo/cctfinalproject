<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class CategoryJobs
 * @package Source\Models
 */
class CategoryJobs extends Model
{
    /**
     * Category constructor.
     */
    public function __construct()
    {
        parent::__construct("categories_jobs", ["id"], ["title", "description"]);
    }

    /**
     * @param string $uri
     * @param string $columns
     * @return null|Category
     */
    public function findByUri(string $uri, string $columns = "*"): ?CategoryJobs
    {
        $find = $this->find("uri = :uri", "uri={$uri}", $columns);
        return $find->fetch();
    }

    /**
     * @return Job
     */
    public function posts(): Job
    {
        return (new Job())->find("category = :id", "id={$this->id}");
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        $checkUri = (new CategoryJobs())->find("uri = :uri AND id != :id", "uri={$this->uri}&id={$this->id}");

        if ($checkUri->count()) {
            $this->uri = "{$this->uri}-{$this->lastId()}";
        }

        return parent::save();
    }
}
