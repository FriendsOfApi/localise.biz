<?php

namespace FAPI\Localise\Model\Asset;

use FAPI\Localise\Model\CreatableFromArray;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Asset implements CreatableFromArray
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $context;

    /**
     * @var string
     */
    private $notes;

    /**
     * @var string
     */
    private $printf;

    /**
     * @var string
     */
    private $modified;

    /**
     * @var int
     */
    private $translated;

    /**
     * @var int
     */
    private $untranslated;

    /**
     * @var int
     */
    private $incomplate;

    /**
     * @var int
     */
    private $plural;

    /**
     * @var array
     */
    private $tags = [];

    private function __construct()
    {
    }

    /**
     * @return Asset
     */
    public static function createFromArray(array $data)
    {
        $self = new self();

        if (isset($data['id'])) {
            $self->setId($data['id']);
        }
        if (isset($data['type'])) {
            $self->setType($data['type']);
        }
        if (isset($data['name'])) {
            $self->setType($data['type']);
        }
        if (isset($data['context'])) {
            $self->setContext($data['context']);
        }
        if (isset($data['notes'])) {
            $self->setNotes($data['notes']);
        }
        if (isset($data['modified'])) {
            $self->setModified($data['modified']);
        }
        if (isset($data['translated'])) {
            $self->setTranslated($data['translated']);
        }
        if (isset($data['untranslated'])) {
            $self->setUntranslated($data['untranslated']);
        }
        if (isset($data['incomplete'])) {
            $self->setIncomplate($data['incomplete']);
        }
        if (isset($data['plurals'])) {
            $self->setPlurals($data['plurals']);
        }
        if (isset($data['tags'])) {
            $self->setTags($data['tags']);
        }
        if (isset($data['printf'])) {
            $self->setPrintf($data['printf']);
        }

        return $self;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    private function setId($id)
    {
        $this->id = $id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    private function setType($type)
    {
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    private function setName($name)
    {
        $this->name = $name;
    }

    public function getContext(): string
    {
        return $this->context;
    }

    /**
     * @param string $context
     */
    private function setContext($context)
    {
        $this->context = $context;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    private function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function getPrintf(): string
    {
        return $this->printf;
    }

    public function setPrintf(string $printf): void
    {
        $this->printf = $printf;
    }

    public function getModified(): string
    {
        return $this->modified;
    }

    /**
     * @param string $modified
     */
    private function setModified($modified)
    {
        $this->modified = $modified;
    }

    public function getTranslated(): int
    {
        return $this->translated;
    }

    /**
     * @param int $translated
     */
    private function setTranslated($translated)
    {
        $this->translated = $translated;
    }

    public function getUntranslated(): int
    {
        return $this->untranslated;
    }

    /**
     * @param int $untranslated
     */
    private function setUntranslated($untranslated)
    {
        $this->untranslated = $untranslated;
    }

    public function getIncomplate(): int
    {
        return $this->incomplate;
    }

    /**
     * @param int $incomplate
     */
    private function setIncomplate($incomplate)
    {
        $this->incomplate = $incomplate;
    }

    public function getPlurals(): int
    {
        return $this->plural;
    }

    /**
     * @param int $plural
     */
    private function setPlurals($plural)
    {
        $this->plural = $plural;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    private function setTags($tags)
    {
        $this->tags = $tags;
    }
}
