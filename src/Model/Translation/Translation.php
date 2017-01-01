<?php

namespace FAPI\Localise\Resource\Api\Translation;

use FAPI\Localise\Model\CreatableFromArray;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Translation implements CreatableFromArray
{
    /**
     * @var string
     */
    private $id = '';

    /**
     * @var string
     */
    private $type = '';

    /**
     * @var bool
     */
    private $translated = false;

    /**
     * @var bool
     */
    private $flagged = false;

    /**
     * @var string
     */
    private $status = '';

    /**
     * @var string
     */
    private $translation = '';

    /**
     * @var int
     */
    private $revision = 0;

    /**
     * @var int
     */
    private $comments = 0;

    /**
     * @var string
     */
    private $modified = '';

    /**
     * @var array
     */
    private $author = [];

    /**
     * @var array
     */
    private $flagger = [];

    /**
     * @var array
     */
    private $locale = [];

    /**
     * @var array
     */
    private $plurals = [];

    private function __construct()
    {
    }

    /**
     * @param array $data
     *
     * @return Translation
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
        if (isset($data['translated'])) {
            $self->setTranslated($data['translated']);
        }
        if (isset($data['flagged'])) {
            $self->setFlagged($data['flagged']);
        }
        if (isset($data['status'])) {
            $self->setStatus($data['status']);
        }
        if (isset($data['translation'])) {
            $self->setTranslation($data['translation']);
        }
        if (isset($data['revision'])) {
            $self->setRevision($data['revision']);
        }
        if (isset($data['comments'])) {
            $self->setComments($data['comments']);
        }
        if (isset($data['modified'])) {
            $self->setModified($data['modified']);
        }
        if (isset($data['author'])) {
            $self->setAuthor($data['author']);
        }
        if (isset($data['flagger'])) {
            $self->setFlagger($data['flagger']);
        }
        if (isset($data['locale'])) {
            $self->setLocale($data['locale']);
        }
        if (isset($data['plurals'])) {
            $self->setPlurals($data['plurals']);
        }

        return $self;
    }

    /**
     * @return string
     */
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

    /**
     * @return string
     */
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

    /**
     * @return string
     */
    public function getTranslated(): bool
    {
        return $this->translated;
    }

    /**
     * @param bool $translated
     */
    private function setTranslated($translated)
    {
        $this->translated = (bool) $translated;
    }

    /**
     * @return string
     */
    public function getFlagged(): bool
    {
        return $this->flagged;
    }

    /**
     * @param bool $flagged
     */
    private function setFlagged($flagged)
    {
        $this->flagged = (bool) $flagged;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    private function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getTranslation(): string
    {
        return $this->translation;
    }

    /**
     * @param string $translation
     */
    private function setTranslation($translation)
    {
        $this->translation = $translation;
    }

    /**
     * @return string
     */
    public function getRevision(): int
    {
        return $this->revision;
    }

    /**
     * @param int $revision
     */
    private function setRevision(int $revision)
    {
        $this->revision = $revision;
    }

    /**
     * @return int
     */
    public function getComments(): int
    {
        return $this->comments;
    }

    /**
     * @param int $comments
     */
    private function setComments(int $comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return string
     */
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

    /**
     * @return array
     */
    public function getAuthor(): array
    {
        return $this->author;
    }

    /**
     * @param array $author
     */
    private function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return array
     */
    public function getFlagger(): array
    {
        return $this->flagger;
    }

    /**
     * @param array $flagger
     */
    private function setFlagger($flagger)
    {
        $this->flagger = $flagger;
    }

    /**
     * @return array
     */
    public function getLocale(): array
    {
        return $this->locale;
    }

    /**
     * @param array $locale
     */
    private function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return array
     */
    public function getPlurals(): array
    {
        return $this->plurals;
    }

    /**
     * @param array $plurals
     */
    private function setPlurals($plurals)
    {
        $this->plurals = $plurals;
    }
}
