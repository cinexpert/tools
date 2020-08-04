<?php

namespace Cinexpert\Tools\Mail;

class MailMessageAttachment
{
    /** @var string */
    protected $filename;
    /** @var string */
    protected $contentType;
    /** @var string */
    protected $content;
    /** @var string|null */
    protected $contentId;

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     * @return MailMessageAttachment
     */
    public function setFilename(string $filename): MailMessageAttachment
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     * @return MailMessageAttachment
     */
    public function setContentType(string $contentType): MailMessageAttachment
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return MailMessageAttachment
     */
    public function setContent(string $content): MailMessageAttachment
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContentId(): ?string
    {
        return $this->contentId;
    }

    /**
     * @param string|null $contentId
     * @return MailMessageAttachment
     */
    public function setContentId(?string $contentId): MailMessageAttachment
    {
        $this->contentId = $contentId;
        return $this;
    }
}
