<?php
namespace App\Library\Client\Polygon;

use App\Library\Client\BaseRequest;
use Exception;

class Client extends BaseRequest
{
    /**
     * @param string $query
     * @param array $params
     * @param string $verb
     * @throws Exception
     */
    public function __construct(string $query, array $params = [], string $verb = 'GET' )
    {
        $headers = [
            'Authorization' => 'Bearer ' . env('POLYGON_API_KEY')
        ];

        $url = env('POLYGON_HTTP_URL');

        $this->setHeaders($headers);
        $this->setParams($params);
        $this->setVerb($verb);
        parent::__construct($url, $query);
    }

}
