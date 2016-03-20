<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/13/16
 * Time: 22:31
 */

class MobileController extends FrontendController {

    public function index()
    {


        $response = new CompositeActionResponse();

        $blocks = array('login', 'shippingAddress', 'billingAddress', 'payment', 'cart', 'shippingMethods', 'overview');
        $blocks = array_flip($blocks);

        foreach ($blocks as $block => $key)
        {
            $blockResponse = $this->$block();

            if ($blockResponse instanceof ActionResponse)
            {
                $blockResponse->set('user', $this->user->toArray());
                $response->addResponse($block, $blockResponse, $this, $block);
            }
        }

        $response->set('orderValues', $this->getOrderValues($this->order));

        return $response;
    }

}

?>