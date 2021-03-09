<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Libraries NpwpFormatter
 *
 * This Libraries for ...
 * 
 * @package		CodeIgniter
 * @category	Libraries
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class NpwpFormatter
{

  // ------------------------------------------------------------------------

  public function __construct()
  {
    // 
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------

  public function npwp_format($npwp)
  {
    $str = substr($npwp, 0, 2);
    $str .= '.' . substr($npwp, 2, 3);
    $str .= '.' . substr($npwp, 5, 3);
    $str .= '.' . substr($npwp, 8, 1);
    $str .= '-' . substr($npwp, 9, 3);
    $str .= '.' . substr($npwp, 12, 3);
    return $str;
  }

  // ------------------------------------------------------------------------
}

/* End of file NpwpFormatter.php */
/* Location: ./application/libraries/NpwpFormatter.php */