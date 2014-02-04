<?php

namespace Junior;

use Junior\Serverside\Request;
use Junior\Serverside\Response;
use Junior\Serverside\Adapter\AdapterInterface;
use Junior\Serverside\Adapter\StandardAdapter;

const ERROR_INVALID_REQUEST = -32600;
const ERROR_METHOD_NOT_FOUND = -32601;
const ERROR_INVALID_PARAMS = -32602;
const ERROR_EXCEPTION = -32099;

class Server {

    public $exposedInstance, $adapter;

    public function __construct($exposedInstance, AdapterInterface $adapter = null)
    {
        $this->exposedInstance = $exposedInstance;
        $this->adapter = $adapter ?: new StandardAdapter();
    }

    public function process()
    {
        $json = $this->adapter->receive();
        $request = $this->createRequest($json);
        $output = $this->invoke($request);
        $response = $this->createResponse($output);
        $this->adapter->respond($response);
    }

    public function createRequest($json)
    {
        return new Request($json);
    }

    public function invoke(Request $request)
    {
        //TODO
        return $request;
    }

    public function createResponse()
    {
        //TODO
        return new Response();
    }
}