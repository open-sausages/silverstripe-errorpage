<?php

namespace SilverStripe\ErrorPage;

use SilverStripe\ErrorPage\ErrorPage;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponseException;
use SilverStripe\Core\Extension;

/**
 * Enhances error handling for a controller with ErrorPage generated output
 */
class ErrorPageControllerExtension extends Extension
{

    /**
     * Used by {@see RequestHandler::httpError}
     *
     * @param int $statusCode
     * @param HTTPRequest $request
     * @throws HTTPResponseException
     */
    public function onBeforeHTTPError($statusCode, $request)
    {
        if (Director::is_ajax()) {
            return;
        }
        $response = ErrorPage::response_for($statusCode);
        if ($response) {
            throw new HTTPResponseException($response, $statusCode);
        }
    }
}
