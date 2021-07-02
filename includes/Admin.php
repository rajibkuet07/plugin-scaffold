<?php

namespace Plugin\Scaffold;

class Admin {
  /**
   * Constractor of the Admin class
   */
  public function __construct() {
    new Admin\Menu();
  }
}
