<?php

/**
 * ConsoleAwareInterface.php
 *
 * @date        27.02.2018
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        ConsoleAwareInterface.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ConsoleAwareInterface
 *
 * @package     Cinexpert
 * @subpackage  Tools
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
interface ConsoleAwareInterface
{
    /**
     * Get the console adapter
     *
     * @return OutputInterface|null
     */
    public function getConsole(): ?OutputInterface;

    /**
     * Set the console adapter
     *
     * @param OutputInterface $console
     * @return self
     */
    public function setConsole(OutputInterface $console): self;

    /**
     * Verbose accessor
     *
     * @param bool|null $flag
     * @return self|bool
     */
    public function verbose(bool $flag = null): self|bool;
}
