<?php

namespace Maximuspoder\Banner\Model\Data;

interface BannerRepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * @return mixed
     */
    public function getByActive();
}