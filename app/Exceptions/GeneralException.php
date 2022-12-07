<?php

namespace App\Exceptions;

use App\Exceptions\Base\BaseException;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class GeneralException extends BaseException
{
    /**
     * @param string|null $exceptionMessage
     * @param string|null $exceptionErrorCode
     * @param int|null $exceptionStatusCode
     * @param array|null $exceptionErrors
     * @param array|null $exceptionHeaders
     */
    public function __construct(
        protected ?string $exceptionMessage = null,
        protected ?string $exceptionErrorCode = null,
        protected ?int $exceptionStatusCode = null,
        protected ?array $exceptionErrors = [],
        protected ?array $exceptionHeaders = [],
    ) {
        $this->setExceptionBag($exceptionErrorCode, $this->getExceptionBag());
        parent::__construct();
    }

    /**
     * @return array[]
     */
     #[ArrayShape([
         self::INTERNAL_SERVER_ERROR => "array",
         self::NOT_FOUND_ERROR => "array",
         self::NOT_ENABLED_ERROR => "array"
     ])] protected function getExceptionBag(): array
    {
        return [
            self::INTERNAL_SERVER_ERROR => [
                self::STATUS_CODE_INDEX => $this->getExceptionStatusCode() ?? ResponseAlias::HTTP_INTERNAL_SERVER_ERROR,
                self::ERROR_CODE_INDEX => self::INTERNAL_SERVER_ERROR,
                self::MESSAGE_INDEX => $this->getExceptionMessage() ?: __(
                    'messages.http.error.' . self::INTERNAL_SERVER_ERROR
                ),
            ],
            self::NOT_FOUND_ERROR => [
                self::STATUS_CODE_INDEX => $this->getExceptionStatusCode() ?? ResponseAlias::HTTP_NOT_FOUND,
                self::ERROR_CODE_INDEX => self::NOT_FOUND_ERROR,
                self::MESSAGE_INDEX => $this->getExceptionMessage() ?: __(
                    'messages.http.error.' . self::NOT_FOUND_ERROR
                ),
            ],
            self::NOT_ENABLED_ERROR => [
                self::STATUS_CODE_INDEX => $this->getExceptionStatusCode() ?? ResponseAlias::HTTP_CONFLICT,
                self::ERROR_CODE_INDEX => self::NOT_ENABLED_ERROR,
                self::MESSAGE_INDEX => $this->getExceptionMessage() ?: __(
                    'messages.http.error.' . self::NOT_ENABLED_ERROR
                ),
            ],
        ];
    }
}
