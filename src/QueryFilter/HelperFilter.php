<?php

namespace eloquentFilter\QueryFilter;

use Illuminate\Support\Arr;

/**
 * Trait HelperFilter.
 */
trait HelperFilter
{
    /**
     * @param array $arr
     *
     * @return bool
     */
    public function isAssoc(array $arr)
    {
        if ([] === $arr) {
            return false;
        }

        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    /**
     * @param       $field
     * @param array $args
     *
     * @return array|null
     */
    private function convertRelationArrayRequestToStr($field, array $args)
    {
        $out = null;
        if (method_exists($this->builder->getModel(), $field)) {
            $out = Arr::dot($args, $field . '.');
        }

        return $out;
    }

    /**
     * @param array|null $request
     */
    public function setRequest($request): void
    {
        $this->request = $request;
    }

    /**
     * @return array|null
     */
    public function getRequest(): ?array
    {
        return $this->request;
    }

    /**
     * @param array|null $ignore_request
     *
     * @return array|null
     */
    public function filters(array $ignore_request = null): ?array
    {
        if (!empty($ignore_request)) {
            $this->setRequest(Arr::except($this->getRequest(), $ignore_request));
        }

        return $this->getRequest();
    }
}
