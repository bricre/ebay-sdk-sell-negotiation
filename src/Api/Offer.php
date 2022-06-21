<?php

namespace Ebay\Sell\Negotiation\Api;

use Ebay\Sell\Negotiation\Model\CreateOffersRequest;
use Ebay\Sell\Negotiation\Model\PagedEligibleItemCollection;
use Ebay\Sell\Negotiation\Model\SendOfferToInterestedBuyersCollectionResponse;
use OpenAPI\Runtime\UnexpectedResponse;

class Offer extends AbstractAPI
{
    /**
     * This method evaluates a seller's current listings and returns the set of IDs
     * that are eligible for a seller-initiated discount offer to a buyer. A listing ID
     * is returned only when one or more buyers have shown an &quot;interest&quot; in
     * the listing. If any buyers have shown interest in a listing, the seller can
     * initiate a &quot;negotiation&quot; with them by calling
     * sendOfferToInterestedBuyers, which sends all interested buyers a message that
     * offers the listing at a discount. For details about how to create seller offers
     * to buyers, see Sending offers to buyers.
     *
     * @param array $queries options:
     *                       'limit'	string	This query parameter specifies the maximum number of items to
     *                       return from the result set on a page in the paginated response. Minimum: 1
     *                       &nbsp; &nbsp;Maximum: 200 Default: 10
     *                       'offset'	string	This query parameter specifies the number of results to skip in
     *                       the result set before returning the first result in the paginated response.
     *                       Combine offset with the limit query parameter to control the items returned in
     *                       the response. For example, if you supply an offset of 0 and a limit of 10, the
     *                       first page of the response contains the first 10 results from the complete list
     *                       of items retrieved by the call. If offset is 10 and limit is 20, the first page
     *                       of the response contains items 11-30 from the complete result set. Default: 0
     * @param array $headers options:
     *                       'X-EBAY-C-MARKETPLACE-ID'	string	The eBay marketplace on which you want to
     *                       search for eligible listings. For a complete list of supported marketplaces, see
     *                       Negotiation API requirements and restrictions.
     *
     * @return PagedEligibleItemCollection|UnexpectedResponse
     */
    public function findEligibleItems(array $queries = [], array $headers = [])
    {
        return $this->request(
        'findEligibleItems',
        'GET',
        'find_eligible_items',
        null,
        $queries,
        $headers
        );
    }

    /**
     * This method sends eligible buyers offers to purchase items in a listing at a
     * discount. When a buyer has shown interest in a listing, they become
     * &quot;eligible&quot; to receive a seller-initiated offer to purchase the
     * item(s). Sellers use findEligibleItems to get the set of listings that have
     * interested buyers. If a listing has interested buyers, sellers can use this
     * method (sendOfferToInterestedBuyers) to send an offer to the buyers who are
     * interested in the listing. The offer gives buyers the ability to purchase the
     * associated listings at a discounted price. For details about how to create
     * seller offers to buyers, see Sending offers to buyers.
     *
     * @param CreateOffersRequest $Model   send offer to eligible items request
     * @param array               $headers options:
     *                                     'X-EBAY-C-MARKETPLACE-ID'	string	The eBay marketplace on which your listings
     *                                     with &quot;eligible&quot; buyers appear. For a complete list of supported
     *                                     marketplaces, see Negotiation API requirements and restrictions.
     *
     * @return SendOfferToInterestedBuyersCollectionResponse|UnexpectedResponse
     */
    public function sendToInterestedBuyers(CreateOffersRequest $Model, array $headers = [])
    {
        return $this->request(
        'sendOfferToInterestedBuyers',
        'POST',
        'send_offer_to_interested_buyers',
        $Model->getArrayCopy(),
        [],
        $headers
        );
    }
}
