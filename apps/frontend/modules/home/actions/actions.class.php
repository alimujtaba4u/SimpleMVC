<?php

/**
 * home actions.
 *
 * @package    easydvd
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends BaseAction {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex() {
        $this->text = 'This example just showing its temnplate system! but wait thats not enough it has some more amazing things ! ';
    }

    public function executeFeatures() {
    }
    
}
