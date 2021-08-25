<?php

final class Currency
{
    private $code;

    private function __construct(string $code)
    {
        $this->code = strtoupper($code);
    }

    public static function fromCode(string $code)
    {
        if (strlen($code) !== 3) {
            throw new InvalidArgumentException('Currency code should be 3 letter ISO code');
        }

        return new self($code);
    }

    public function code(): string
    {
        return $this->code;
    }

    public function equals(Currency $other)
    {
        return $this->code === $other->code;
    }

    public function __toString(): string
    {
        return $this->code;
    }
}
