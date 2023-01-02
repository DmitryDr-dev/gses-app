<?php

declare(strict_types=1);

namespace App\UI\Shared\Http\Request;

use App\UI\Shared\Http\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BaseRequest
{
    private const VALIDATION_FAILED = 'validation_failed';

    public function __construct(protected ValidatorInterface $validator)
    {
        $this->populate();
    }

    public function validate(): void
    {
        $errors = $this->validator->validate($this);
        $result = [
            'status' => self::VALIDATION_FAILED,
            'errors' => [],
        ];

        foreach ($errors as $error) {
            $result['errors'][] = [
                'property' => $error->getPropertyPath(),
                'value' => $error->getInvalidValue(),
                'message' => $error->getMessage(),
            ];
        }

        if (count($result['errors']) > 0) {
            throw BadRequestException::create(json_encode($result));
        }
    }

    public function convertToArray(): array
    {
        return $this->getRequest()->toArray();
    }

    public function getRequest(): Request
    {
        return Request::createFromGlobals();
    }

    private function populate(): void
    {
        foreach ($this->convertToArray() as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}
