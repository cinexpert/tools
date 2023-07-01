<?php

/**
 * ToolsConfig.php
 *
 * @date      27.02.2018
 * @author    Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file      ToolsConfig.php
 * @copyright Copyright (c) CineXpert - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools;

/**
 * Class ToolsConfig
 *
 * Config object for Tools
 *
 * @package    Cinexpert
 * @subpackage Tools
 * @author     Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright  Copyright (c) CineXpert - All rights reserved
 * @license    Unauthorized copying of this source code, via any medium is strictly
 *             prohibited, proprietary and confidential.
 */
class ToolsConfig
{
    /** @var string */
    protected $awsRegion;

    /** @var string */
    protected $awsKey;

    /** @var string */
    protected $awsSecret;

    /** @var string */
    protected $publisherKey;

    /** @var string */
    protected $subscriberKey;

    /**
     * @return string
     */
    public function getAwsRegion(): ?string
    {
        return $this->awsRegion;
    }

    /**
     * @param string $awsRegion
     * @return ToolsConfig
     */
    public function setAwsRegion(string $awsRegion): ToolsConfig
    {
        $this->awsRegion = $awsRegion;
        return $this;
    }

    /**
     * @return string
     */
    public function getAwsKey(): ?string
    {
        return $this->awsKey;
    }

    /**
     * @param string $awsKey
     * @return ToolsConfig
     */
    public function setAwsKey(string $awsKey): ToolsConfig
    {
        $this->awsKey = $awsKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getAwsSecret(): ?string
    {
        return $this->awsSecret;
    }

    /**
     * @param string $awsSecret
     * @return ToolsConfig
     */
    public function setAwsSecret(string $awsSecret): ToolsConfig
    {
        $this->awsSecret = $awsSecret;
        return $this;
    }

    /**
     * @return string
     */
    public function getPublisherKey(): string
    {
        return $this->publisherKey;
    }

    /**
     * @param string $publisherKey
     * @return ToolsConfig
     */
    public function setPublisherKey(string $publisherKey): ToolsConfig
    {
        $this->publisherKey = $publisherKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubscriberKey(): string
    {
        return $this->subscriberKey;
    }

    /**
     * @param string $subscriberKey
     * @return ToolsConfig
     */
    public function setSubscriberKey(string $subscriberKey): ToolsConfig
    {
        $this->subscriberKey = $subscriberKey;
        return $this;
    }
}
