<?php
require_once 'vendors/mpdf-development/vendor/autoload.php';
use Mpdf\Mpdf;
/**
 * My Pdf
 */
class MyPdf extends Mpdf
{
    
    /**
     * summary
     */
    public function __construct(array $config = [],$scaleCons = '')
    {
        $this->fonttrans = array(
        	'arial' => 'arial',
        );
        $this->fontdata = array(
			"arial" => array(
				'R' => "ARIALN.ttf",
				'B' => "ARIALNB.ttf",
				'useOTL' => 0xFF,
				'useKashida' => 75,
			)
		);
    	$this->scale_cons = ($scaleCons!='') ? $scaleCons : $this->scaleCons;
        parent::__construct($config);
    }
}