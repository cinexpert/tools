<?php

namespace Cinexpert\Tools\Mail;

class MailMessage
{
    /** @var string */
    protected $subject;
    /** @var string */
    protected $id;
    /** @var string */
    protected $text;
    /** @var string */
    protected $from;
    /** @var MailMessageAttachment[] */
    protected $attachments;
    /** @var MailMessageAttachment[] */
    protected $inlineAttachments;
    /** @var string[] */
    protected $ccAddresses;

    public function __construct()
    {
        $this->attachments       = [];
        $this->inlineAttachments = [];
        $this->ccAddresses       = [];
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return MailMessage
     */
    public function setSubject(string $subject): MailMessage
    {
        $this->subject = $subject;
        return $this;
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
     * @return MailMessage
     */
    public function setId(string $id): MailMessage
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return MailMessage
     */
    public function setText(string $text): MailMessage
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @param string $from
     * @return MailMessage
     */
    public function setFrom(string $from): MailMessage
    {
        $this->from = $from;
        return $this;
    }

    public function getSenderEmailAddress(): string
    {
        $pattern = '/[a-z0-9_\-\+\.]+@(([a-z][a-z0-9-]+)\.){0,3}(?2)/i';
        preg_match($pattern, $this->from, $matches);

        return strtolower($matches[0]);
    }

    public function getSenderEmailFirstname(): ?string
    {
        if (preg_match('/([^",]+) ([^"]+)["]{0,1} \<(.+)\>/', $this->from, $matches)) {
            return $matches[1];
        } elseif (preg_match('/([^",]+)[,]{0,1} ([^"]+)["]{0,1} \<(.+)\>/', $this->from, $matches)) {
            return $matches[2];
        }

        return null;
    }

    public function getSenderEmailLastname(): ?string
    {
        if (preg_match('/([^",]+) ([^"]+)["]{0,1} \<(.+)\>/', $this->from, $matches)) {
            return $matches[2];
        } elseif (preg_match('/([^",]+)[,]{0,1} ([^"]+)["]{0,1} \<(.+)\>/', $this->from, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * @return MailMessageAttachment[]
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * @param MailMessageAttachment $attachment
     * @return MailMessage
     */
    public function addAttachment(MailMessageAttachment $attachment): MailMessage
    {
        $this->attachments[] = $attachment;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getAttachmentFilenames(): array
    {
        $filenames = [];

        foreach ($this->getAttachments() as $attachment) {
            $filenames[] = $attachment->getFilename();
        }

        return $filenames;
    }

    /**
     * @return MailMessageAttachment[]
     */
    public function getInlineAttachments(): array
    {
        return $this->inlineAttachments;
    }

    /**
     * @param MailMessageAttachment $inlineAttachment
     * @return MailMessage
     */
    public function addInlineAttachment(MailMessageAttachment $inlineAttachment): MailMessage
    {
        $this->inlineAttachments[] = $inlineAttachment;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getCcAddresses(): array
    {
        return $this->ccAddresses;
    }

    /**
     * @param string $ccAddress
     * @return MailMessage
     */
    public function addCcAddress(string $ccAddress): MailMessage
    {
        $this->ccAddresses[] = $ccAddress;
        return $this;
    }
}
