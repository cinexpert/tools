<?php

/**
 * Mail.php
 *
 * @date      04.08.2020
 * @author    Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file      Mail.php
 * @copyright Copyright (c) CineXpert - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\Mail;

use PhpMimeMailParser\Parser;
use IMAP\Connection;

/**
 * Mail
 *
 * @package     Cinexpert
 * @subpackage  Tools
 * @author      Pascal Paulis <pascal.paulis@vaconsulting.lu>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class Mail
{
    /** @var string|null */
    protected $inboxUsername;
    /** @var string|null */
    protected $inboxPassword;
    /** @var string|null */
    protected $inboxHost;
    /** @var string|null */
    protected $inboxEncryption;
    /** @var int|null */
    protected $inboxPort;
    /** @var string|null */
    protected $inboxType;
    /** @var Connection */
    protected $inbox;

    public const INBOX_TYPE_IMAP = 'imap';
    public const INBOX_TYPE_POP3 = 'pop3';

    public const IMAP_MAILBOX_FORMAT_STRING = '{%s:%s/%s/novalidate-cert}';

    public function connectToInbox(
        string $inboxUsername = null,
        string $inboxPassword = null,
        string $inboxHost = null,
        string $inboxEncryption = null,
        int $inboxPort = null,
        string $inboxType = null
    ): void {
        $this->inboxUsername   = $inboxUsername;
        $this->inboxPassword   = $inboxPassword;
        $this->inboxHost       = $inboxHost;
        $this->inboxEncryption = $inboxEncryption;
        $this->inboxPort       = $inboxPort;
        $this->inboxType       = $inboxType;

        if ($inboxUsername && $inboxPassword && $inboxHost && $inboxEncryption && $inboxPort && $inboxType) {
            switch ($inboxType) {
                case self::INBOX_TYPE_IMAP:
                    $this->inbox = \imap_open(
                        sprintf(
                            $this->getImapInboxFormatString() . 'INBOX',
                            $this->inboxHost,
                            $this->inboxPort,
                            $this->inboxEncryption
                        ),
                        $this->inboxUsername,
                        $this->inboxPassword
                    );

                    if ($lastImapError = imap_last_error()) {
                        throw new \Exception($lastImapError);
                    }

                    break;
                default:
                    throw new \Exception('Currently only IMAP is implemented.');
            }
        }
    }

    protected function getImapInboxFormatString(): string
    {
        return sprintf(
            self::IMAP_MAILBOX_FORMAT_STRING,
            $this->inboxHost,
            $this->inboxPort,
            $this->inboxEncryption
        );
    }

    /**
     * Check if the given folder already exists.
     *
     * @param string $folder
     * @return bool
     */
    public function folderExists(string $folder): bool
    {
        $list = imap_list($this->inbox, $this->getImapInboxFormatString(), "*");

        return in_array($this->getImapInboxFormatString() . $folder, $list);
    }

    /**
     * Return the number of unread messages in the inbox.
     *
     * @return int The number of unread messages.
     * @throws \Exception If the inbox is not configured.
     */
    public function getNumberOfUnreadMessages()
    {
        if ($this->inbox === null) {
            throw new \Exception("Inbox not configured. Please provide inbox credentials.");
        }

        $check = imap_mailboxmsginfo($this->inbox);

        return $check->Unread;
    }

    /**
     * Get the list of unread messages in the inbox.
     *
     * @return MailMessage[]
     */
    public function getUnreadMessages(): array
    {
        if (!$unreadInboxMessages = imap_search($this->inbox, 'UNSEEN')) {
            return [];
        }

        return $this->parseMessages($unreadInboxMessages);
    }

    /**
     * Get the list of all messages in the inbox.
     *
     * @return MailMessage[]
     */
    public function getInboxMessages(): array
    {
        $mc = imap_check($this->inbox);

        if ($mc->Nmsgs === 0) {
            return [];
        }

        $overview = imap_fetch_overview($this->inbox, "1:{$mc->Nmsgs}", 0);

        return $this->parseMessages(array_column($overview, 'msgno'));
    }

    protected function parseMessages(array $messages): array
    {
        rsort($messages);

        $unreadMessages = [];

        foreach ($messages as $i) {
            $message = imap_fetchheader($this->inbox, $i) . imap_body($this->inbox, $i);
            $headers = imap_headerinfo($this->inbox, $i);

            $parser = new Parser();
            $parser->setText($message);

            $text = $parser->getMessageBody('html') ?
                $this->removeQuoteOfPreviousEmails($parser->getMessageBody('html')) :
                $parser->getMessageBody('text');

            $unreadMessage = new MailMessage();
            $unreadMessage
                ->setId($i)
                ->setSubject($parser->getHeader('subject'))
                ->setFrom($parser->getHeader('from'))
                ->setText($text);

            if (property_exists($headers, 'cc') && is_array($headers->cc)) {
                foreach ($headers->cc as $ccAddress) {
                    $unreadMessage->addCcAddress($ccAddress->mailbox . '@' . $ccAddress->host);
                }
            }

            // Handle all non-inline attachments
            $attachments = $parser->getAttachments();

            foreach ($attachments as $attachment) {
                $mailMessageAttachment = new MailMessageAttachment();
                $mailMessageAttachment
                    ->setFilename($attachment->getFilename())
                    ->setContentType($attachment->getContentType())
                    ->setContent($attachment->getContent())
                    ->setContentId($attachment->getContentID());

                $attachment->getContentDisposition() === 'attachment' ?
                    $unreadMessage->addAttachment($mailMessageAttachment) :
                    $unreadMessage->addInlineAttachment($mailMessageAttachment);
            }

            $unreadMessages[] = $unreadMessage;
        }

        return $unreadMessages;
    }

    /**
     * Remove the quoting of previous emails by removing the <blockquote> tag.
     *
     * @param string $htmlText
     * @return string
     */
    protected function removeQuoteOfPreviousEmails(string $htmlText): string
    {
        $doc = new \DOMDocument();
        $doc->loadHTML(mb_convert_encoding($htmlText, 'HTML-ENTITIES', 'UTF-8'));
        $list = $doc->getElementsByTagName('blockquote');

        $listLength = $list->length;
        while ($listLength > 0) {
            /** @var \DOMElement|null $blockquote */
            $blockquote = $list->item(0);

            if ($blockquote && strpos($blockquote->getAttribute('class'), 'gmail_quote') !== false) {
                $blockquote->parentNode->removeChild($blockquote);
            }

            $listLength--;
        }

        return $doc->saveHTML();
    }

    /**
     * Create the folder if it doesn't exist yet.
     *
     * @param string $folder
     * @throws \Exception
     */
    public function createFolder(string $folder): void
    {
        if ($this->inboxType === self::INBOX_TYPE_IMAP) {
            if (!imap_listmailbox($this->inbox, $this->getImapInboxFormatString(), $folder)) {
                imap_createmailbox($this->inbox, imap_utf7_encode($this->getImapInboxFormatString() . $folder));
            }
        } else {
            // TODO Implement move for other protocols
            throw new \Exception('Creating a folder is currently only implemented for IMAP inboxes.');
        }
    }

    /**
     * Close the connection to the Mailbox.
     *
     * @throws \Exception
     */
    public function closeConnection(): void
    {
        if ($this->inboxType === self::INBOX_TYPE_IMAP) {
            imap_close($this->inbox);
        } else {
            // TODO Implement move for other protocols
            throw new \Exception('Closing the connection is currently only implemented for IMAP inboxes.');
        }
    }

    /**
     * Move the given message to the given folder.
     *
     * @param MailMessage $message
     * @param string $folder
     * @throws \Exception
     */
    public function moveMessageToFolder(MailMessage $message, string $folder): void
    {
        if ($this->inboxType === self::INBOX_TYPE_IMAP) {
            imap_mail_move($this->inbox, $message->getId(), imap_utf7_encode($folder));
            imap_expunge($this->inbox);
        } else {
            // TODO Implement move for other protocols
            throw new \Exception('Moving an email is currently only implemented for IMAP inboxes.');
        }
    }
}
