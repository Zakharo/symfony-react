<?php

namespace App\Http\Transformer;

use App\ModelInterface;

/**
 * Class ModelTransformer
 * @package App\Http\Transformer
 */
class ModelTransformer
{
    /**
     * @param ModelInterface $data
     * @return array
     */
    public function transform($data): array
    {
        return $data->toArray();
    }

    /**
     * @return array
     */
    public function metadata(): array
    {
        return [];
    }
}
