<?php

/* 
 * 
 * 
 * 
 */
require_once("../" . PAYU_FILES . "PurchaseResult.php");

class PayUMoney {
    const TEST_URL = 'https://test.payu.in/_payment';
    const PRODUCTION_URL = 'https://secure.payu.in/_payment';
    
    /**
     * @var string
     */
    private $merchantId;
    private $secretKey;
    
    /**
     * @var bool
     */
    private $testMode;
    
    /**
     * @var array for string config
     */
    
    
    public function __construct(array $options) {
        $this->merchantId = $options['merchantId'];
        $this->secretKey = $options['secretKey'];
        $this->testMode = $options['testMode'];
        
    }
    
    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }
    
    /**
     * @return bool
     */
    public function getTestMode()
    {
        return $this->testMode ;
    }

    /**
     * @return string
     */
    public function getServiceUrl()
    {
        return $this->testMode ? self::TEST_URL : self::PRODUCTION_URL;
    }
    
    /**
     * @return array
     */
    public function getChecksumParams()
    {
        return array_merge(
            ['key','txnid', 'amount', 'productinfo', 'firstname', 'email'],
            array_map(function ($i) {
                return "udf{$i}";
            }, range(1, 10))
        );
    }
    
    /**
     * @param array $params
     *
     * @return string
     */
    private function getChecksum(array $params)
    {
        $values = array_map(
            function ($field) use ($params) {
                return isset($params[$field]) ? $params[$field] : '';
            },
            $this->getChecksumParams()
        );

        //$values = array_merge([$this->getMerchantId()], $values, [$this->getSecretKey()]);
            //AS we added merchant key in default values
            $values = array_merge($values, [$this->getSecretKey()]);

        return hash('sha512', implode('|', $values));
    }
    
    /**
     * @param array $params
     *
     * @throws \InvalidArgumentException
     *
     * @return Response
     */
    public function initializePurchase(array $params)
    {
        $requiredParams = ['key','txnid', 'amount', 'productinfo','firstname', 'email', 'phone',  'surl', 'furl'];
        
        foreach ($requiredParams as $requiredParam) {
            if (!isset($params[$requiredParam])) {
                throw new InvalidArgumentException(sprintf('"%s" is a required param.', $requiredParam));
            }
        }
        
        //AS i initiated with mandatory key 
        //$params = array_merge(['key' => $this->getMerchantId(), 'hash' => $this->getChecksum($params)], $params);
        $params = array_merge(['hash' => $this->getChecksum($params)], $params);
        $params = array_map(function ($param) {
            return htmlentities($param, ENT_QUOTES, 'UTF-8', false);
        }, $params);
        

        $output = sprintf('<form id="payuForm" method="POST" action="%s" name="payuForm">', $this->getServiceUrl());

        foreach ($params as $key => $value) {
            $output .= sprintf('<input type="hidden" name="%s" value="%s" />', $key, $value);
        }

        $output .= '<input type="hidden" name="service_provider" value="payu_paisa" size="64" />';

        $output .= '<div id="redirect_info" style="display: none">Redirecting...</div>
                <input id="payment_form_submit" type="submit" value="Proceed to PayUMoney" />
            </form>
            <script>
                document.getElementById(\'redirect_info\').style.display = \'block\';
                document.getElementById(\'payment_form_submit\').style.display = \'none\';
                document.getElementById(\'payuForm\').submit();
            </script>';
        

//        return Response::create($output, 200, [
//            'Content-type' => 'text/html; charset=utf-8',
//        ]);
        return $output;
        //echo $output;
    }
    
    public function completePurchase(array $params)
    {
        return new PurchaseResult($this, $params);
    }
    
}