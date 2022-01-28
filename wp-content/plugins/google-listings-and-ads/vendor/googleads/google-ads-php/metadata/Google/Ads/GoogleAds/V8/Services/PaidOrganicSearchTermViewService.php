<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v8/services/paid_organic_search_term_view_service.proto

namespace GPBMetadata\Google\Ads\GoogleAds\V8\Services;

class PaidOrganicSearchTermViewService
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();
        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Api\Http::initOnce();
        \GPBMetadata\Google\Api\Annotations::initOnce();
        \GPBMetadata\Google\Api\FieldBehavior::initOnce();
        \GPBMetadata\Google\Api\Resource::initOnce();
        \GPBMetadata\Google\Api\Client::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
Egoogle/ads/googleads/v8/resources/paid_organic_search_term_view.proto!google.ads.googleads.v8.resourcesgoogle/api/resource.protogoogle/api/annotations.proto"�
PaidOrganicSearchTermViewQ
resource_name (	B:�A�A4
2googleads.googleapis.com/PaidOrganicSearchTermView
search_term (	B�AH �:��A�
2googleads.googleapis.com/PaidOrganicSearchTermViewccustomers/{customer_id}/paidOrganicSearchTermViews/{campaign_id}~{ad_group_id}~{base64_search_term}B
_search_termB�
%com.google.ads.googleads.v8.resourcesBPaidOrganicSearchTermViewProtoPZJgoogle.golang.org/genproto/googleapis/ads/googleads/v8/resources;resources�GAA�!Google.Ads.GoogleAds.V8.Resources�!Google\\Ads\\GoogleAds\\V8\\Resources�%Google::Ads::GoogleAds::V8::Resourcesbproto3
�
Lgoogle/ads/googleads/v8/services/paid_organic_search_term_view_service.proto google.ads.googleads.v8.servicesgoogle/api/annotations.protogoogle/api/client.protogoogle/api/field_behavior.protogoogle/api/resource.proto"x
#GetPaidOrganicSearchTermViewRequestQ
resource_name (	B:�A�A4
2googleads.googleapis.com/PaidOrganicSearchTermView2�
 PaidOrganicSearchTermViewService�
GetPaidOrganicSearchTermViewE.google.ads.googleads.v8.services.GetPaidOrganicSearchTermViewRequest<.google.ads.googleads.v8.resources.PaidOrganicSearchTermView"T���></v8/{resource_name=customers/*/paidOrganicSearchTermViews/*}�Aresource_nameE�Agoogleads.googleapis.com�A\'https://www.googleapis.com/auth/adwordsB�
$com.google.ads.googleads.v8.servicesB%PaidOrganicSearchTermViewServiceProtoPZHgoogle.golang.org/genproto/googleapis/ads/googleads/v8/services;services�GAA� Google.Ads.GoogleAds.V8.Services� Google\\Ads\\GoogleAds\\V8\\Services�$Google::Ads::GoogleAds::V8::Servicesbproto3'
        , true);
        static::$is_initialized = true;
    }
}

