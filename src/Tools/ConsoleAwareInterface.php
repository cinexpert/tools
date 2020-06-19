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

use Laminas\Console\Adapter\AdapterInterface as Console;

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
     * @return Console
     */
    public function getConsole();

    /**
     * Set the console adapter
     *
     * @param Console $console
     *
     * @return self
     */
    public function setConsole(Console $console);

    /**
     * Verbose accessor
     *
     * @param null|bool $flag
     *
     * @return self|bool
     */
    public function verbose($flag = null);
}
