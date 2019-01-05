<?php
/**
 * AwsConfig.php
 *
 * @date        27.02.2018
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        AwsConfig.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools;

/**
 * AwsConfig
 *
 * @package     Cinexpert  
 * @subpackage  Tools
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class AwsConfig
{
    /** @var string */
    protected $awsRegion;

    /** @var string */
    protected $awsKey;

    /** @var string */
    protected $awsSecret;

    /**
     * Set the AWS region.
     *
     * @param string $region
     * @return $this
     */
    public function setAwsRegion(string $region = null)
    {
        $this->awsRegion = $region;
        return $this;
    }

    /**
     * Get the AWS region.
     *
     * @return string
     */
    public function getAwsRegion()
    {
        return $this->awsRegion;
    }

    /**
     * Set the AWS key.
     *
     * @param string $key
     * @return $this
     */
    public function setAwsKey(string $key = null)
    {
        $this->awsKey = $key;
        return $this;
    }

    /**
     * Get the AWS key.
     *
     * @return string
     */
    public function getAwsKey()
    {
        return $this->awsKey;
    }

    /**
     * Set the AWS secret.
     *
     * @param string $secret
     * @return $this
     */
    public function setAwsSecret(string $secret = null)
    {
        $this->awsSecret = $secret;
        return $this;
    }

    /**
     * Get the AWS secret.
     *
     * @return string
     */
    public function getAwsSecret()
    {
        return $this->awsSecret;
    }

    /**
     * @return array The AWS config as expected by the SDK.
     */
    public function toArray()
    {
        $configArray = [];

        if ($this->getAwsRegion()) {
            $configArray['region'] = $this->getAwsRegion();
        }

        if ($this->getAwsKey() && $this->getAwsSecret()) {
            $configArray['credentials'] =
                [
                    'key' => $this->getAwsKey(),
                    'secret' => $this->getAwsSecret()
                ];
        }

        return $configArray;
    }
}
