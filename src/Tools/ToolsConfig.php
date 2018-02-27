<?php
/**
 * ToolsConfig.php
 *
 * @date        27.02.2018
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        ToolsConfig.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools;

/**
 * Class ToolsConfig
 *
 * Config object for Tools
 *
 * @package     Cinexpert
 * @subpackage  Model
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class ToolsConfig
{
    /** @var string */
    protected $awsRegion;

    /** @var string */
    protected $awsKey;

    /** @var string */
    protected $awsSecret;

    /**
     * @return string
     */
    public function getAwsRegion(): string
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
    public function getAwsKey(): string
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
    public function getAwsSecret(): string
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
}