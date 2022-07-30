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
 * ConsoleAwareTrait
 *
 * @package     Cinexpert
 * @subpackage  Tools
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 *
 * @codeCoverageIgnore
 */
trait ConsoleAwareTrait
{
    protected ?OutputInterface $console = null;

    /** @var bool */
    protected bool $verbose = false;

    /**
     * Get the console adapter
     *
     * @return OutputInterface|null
     */
    public function getConsole(): ?OutputInterface
    {
        return $this->console;
    }

    /**
     * Set the console adapter
     *
     * @param OutputInterface $console
     * @return self
     */
    public function setConsole(OutputInterface $console): self
    {
        $this->console = $console;
        return $this;
    }

    /**
     * Verbose accessor
     *
     * @param bool|null $flag
     * @return self|bool
     */
    public function verbose(bool $flag = null)
    {
        if (is_null($flag)) {
            return $this->verbose;
        } else {
            $this->verbose = (bool)$flag;
            return $this;
        }
    }
}
