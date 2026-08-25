<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Class ilVimpPageComponentPlugin
 * @author Theodor Truffer <tt@studer-raimann.ch>
 */
class ilVimpPageComponentPlugin extends ilPageComponentPlugin
{
    public const PLUGIN_NAME = 'VimpPageComponent';
    public const TABLE_NAME = "copg_pgcp_vpco_config";
    public const CTYPE = 'Services';
    public const CNAME = 'COPage';
    public const SLOT_ID = 'pgcp';
    public const PLUGIN_ID = 'vpco';
    private static ?\ilVimpPageComponentPlugin $instance = null;

    public function __construct()
    {
        global $DIC;
        $this->db = $DIC->database();
        parent::__construct($this->db, $DIC["component.repository"], self::PLUGIN_ID);
    }

    public static function getInstance() : ilVimpPageComponentPlugin
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function setValue($setting, $value, $type) : void
    {
        global $DIC;
        $db = $DIC->database();

        $db->replace(
            ilVimpPageComponentPlugin::TABLE_NAME,
            ['name' => ['text', $setting]],
            ['value' => [$type, $value]]
        );
    }

    public static function getValue($setting)
    {
        global $DIC;
        $db = $DIC->database();
        $set = $db->query(
            "SELECT value FROM " . ilVimpPageComponentPlugin::TABLE_NAME .
            " WHERE name = " . $db->quote($setting, "text")
        );

        if ($rec = $set->fetchRow()) {
            return $rec['value'];
        }
        return null;
    }

    /**
     * Get plugin name
     */
    public function getPluginName() : string
    {
        return self::PLUGIN_NAME;
    }

    /**
     * Get plugin name
     */
    public function isValidParentType($a_parent_type) : bool
    {
        return true;
    }
    public function getAspectRatio(int $width, int $height) : string
    {
        $greatestCommonDivisor = static function($width, $height) use (&$greatestCommonDivisor) {
            return ($width % $height) ? $greatestCommonDivisor($height, $width % $height) : $height;
        };

        $divisor = $greatestCommonDivisor($width, $height);

        return $width / $divisor . '/' . $height / $divisor;
    }

}
