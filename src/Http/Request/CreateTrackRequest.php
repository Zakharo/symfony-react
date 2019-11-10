<?php

namespace App\Http\Request;


use App\Http\ParamConverter\RequestObject;
use Symfony\Component\Validator\Constraints as Assert;

class CreateTrackRequest extends RequestObject
{
    /**
     * @return null|Assert\Collection
     */
    public function rules()
    {
        return new Assert\Collection([
            'allowExtraFields' => true,
            'fields' => [
                'singer' => [
                    new Assert\NotBlank(),
                    new Assert\Required(),
                    new Assert\Type(['type' => 'string']),
                    new Assert\Length(['max' => 255]),
                ],
                'name' => [
                    new Assert\NotBlank(),
                    new Assert\Required(),
                    new Assert\Type(['type' => 'string']),
                    new Assert\Length(['max' => 255]),
                ],
                'genre' => [
                    new Assert\NotBlank(),
                    new Assert\Required(),
                    new Assert\Type(['type' => 'string']),
                    new Assert\Length(['max' => 255]),
                ],
                'year' => [
                    new Assert\NotBlank(),
                    new Assert\Required(),
                    new Assert\Type(['type' => 'numeric']),
                    new Assert\Range(['max' => PHP_INT_MAX]),
                ],
            ]
        ]);
    }

    /**
     * @return mixed|null
     */
    public function getSinger()
    {
        return $this->get('singer');
    }

    /**
     * @return mixed|null
     */
    public function getName()
    {
        return $this->get('name');
    }

    /**
     * @return mixed|null
     */
    public function getGenre()
    {
        return $this->get('genre');
    }

    /**
     * @return mixed|null
     */
    public function getYear()
    {
        return $this->get('year');
    }
}
