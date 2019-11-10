<?php

namespace App\Http\ParamConverter;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class RequestObject
{
    private $payload = [];

    public function setPayload(array $payload = [])
    {
        $this->payload = $payload;
    }

    public function rules()
    {
        return null;
    }

    /**
     * @param string $name
     * @param null $default
     * @return mixed|null
     */
    public function get($name, $default = null)
    {
        return $this->has($name) ? $this->payload[$name] : $default;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return array_key_exists($name, $this->payload);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->payload;
    }

    /**
     * @param ConstraintViolationListInterface $errors
     * @return JsonResponse
     */
    public function getErrorResponse(ConstraintViolationListInterface $errors): JsonResponse
    {
        return new JsonResponse(
            [
                'code' => 422,
                'message' => 'Invalid data in request body',
                'errors' => array_map(function (ConstraintViolation $violation) {
                    return [
                        'field' => trim(str_replace('][', '.', $violation->getPropertyPath()), '[]'),
                        'message' => $violation->getMessage(),
                    ];
                }, iterator_to_array($errors)),
            ],
            422
        );
    }
}
