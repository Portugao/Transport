<?php
/**
 * PostNuke Application Framework
 *
 * @copyright (c) 2007, PostNuke Development Team
 * @link http://www.postnuke.com
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @package PostNuke_Generated_Modules
 * @subpackage MUTransport
 * @author Michael Ueberschaer
 * @url mu-t-beratung.de
 */

/*
 * generated at Sat Dec 12 18:12:57 CET 2009 by ModuleStudio 0.4.3 (http://modulestudio.de)
 */


class FilterUtil_Common {

    /**
     * Table name in pntable.php
     */
    protected $pntable;

    /**
     * Table name
     */
    protected $table;

    /**
     * Table columns
     */
    protected $column;

    /**
     * Constructor
     * Set parameters each Class could need
     *
     * @param string $args['table'] Tablename
     */
    public function __construct($args = array()) {
        if (isset($args['table'])) {
            $this->setTable($args['table']);
        }
    }

    /**
     * Set table
     *
     * @access public
     * @param string $table Table name
     * @return bool true on success, false otherwise
     */
    public function setTable($table)
    {
        $pntable =& pnDBGetTables();

        if (!isset($pntable[$table]) || !isset($pntable[$table . '_column'])) {
            return false;
        }

        $this->pntable = $table;
        $this->table = $pntable[$table];
        $this->column =& $pntable[$table . '_column'];

        return true;
    }

    /**
     * Field exists?
     *
     * @access private
     * @param string $field Field name
     * @return bool true if the field exists, else if not
     */
    protected function fieldExists($field)
    {
        if (!isset($this->column[$field]) || empty($this->column[$field])) {
            return false;
        }

        return true;
    }

    /**
     * Add common config variables to config array
     *
     * @access protected
     * @param array $config Config array
     * @return array Config array including common config
     */
    protected function addCommon($config = array())
    {
        $config['table'] = $this->pntable;
        return $config;
    }
}
