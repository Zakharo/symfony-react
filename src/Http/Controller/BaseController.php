<?php

namespace App\Http\Controller;

use App\Http\Transformer\ModelTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends AbstractController
{
    /**
     * @param $data
     * @param ModelTransformer $transformer
     * @return JsonResponse
     */
    public function collection($data, ModelTransformer $transformer): JsonResponse
    {
        $result = [
            'success' => true,
            'data' => []
        ];

        if (is_iterable($data)) {
            foreach ($data as $value) {
                $result['data'][] = $transformer->transform($value);
            }
        }

        return $this->json($result);
    }

    public function flushChanges()
    {
        $this->getDoctrine()->getManager()->flush();
    }
}
