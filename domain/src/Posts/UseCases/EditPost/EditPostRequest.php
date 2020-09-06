<?php

namespace Domain\SSN\Posts\UseCases\EditPost;

use Assert\Assertion;
use Ramsey\Uuid\UuidInterface;

class EditPostRequest
{
    private UuidInterface $id;
    private string $content;

    /**
     * EditPostRequest constructor.
     * @param UuidInterface $id
     * @param string $content
     */
    public function __construct(UuidInterface $id, string $content)
    {
        $this->id = $id;
        $this->content = $content;
    }

    public function validate()
    {
        Assertion::notBlank($this->content);
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
