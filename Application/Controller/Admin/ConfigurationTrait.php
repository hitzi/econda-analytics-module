<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\EcondaAnalyticsModule\Application\Controller\Admin;

/**
 * Trait used for some of the controllers to provide configuration variables functionality.
 */
trait ConfigurationTrait
{
    /**
     * @return string
     */
    public function render()
    {
        $aConfVars = $this->getConfVarsFromDatabase();
        foreach ($this->_aConfParams as $sType => $sParam) {
            if (is_array($aConfVars[$sType])) {
                foreach ($aConfVars[$sType] as $sName => $sValue) {
                    $this->_aViewData[$sName] = $sValue;
                }
            }
        }

        return parent::render();
    }

    /**
     * Return theme filter for config variables.
     *
     * @return string
     */
    protected function _getModuleForConfigVars()
    {
        return 'module:oeecondaanalytics';
    }

    /**
     * Get configuration variables from database.
     *
     * @return array
     */
    protected function getConfVarsFromDatabase()
    {
        $sShopId = $this->getEditObjectId();
        $aDbVariables = $this->loadConfVars($sShopId, $this->_getModuleForConfigVars());

        return $aDbVariables['vars'];
    }
}