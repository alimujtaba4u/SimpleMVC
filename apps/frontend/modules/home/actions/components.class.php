<?php

/**
 * home actions.
 *
 * @package    easydvd
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeComponents extends BaseComponent {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function box2() {
        $this->guess = ($this->no % 2 == 0) ?'even':'odd';
    }

}
