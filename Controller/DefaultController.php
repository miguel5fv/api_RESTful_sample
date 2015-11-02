<?php

namespace Restful\SampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name, Request $request)
    {
        /**
         * HTTP response codes
         *  @see: https://github.com/symfony/http-foundation/blob/master/Response.php
         */
        $response       = new Response();
        if (empty($name)) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } else if( !$request->isMethod('GET')) {
            $response->setStatusCode(Response::HTTP_NOT_IMPLEMENTED);
        } else {
            $apiResponse    = array(
                'name'  => $name,
                '_self'  => $this->generateUrl(
                    'restful_sample_helloworld',
                    array('name' => $name)
                )
            );
            $response->setContent(json_encode($apiResponse));
        }

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
