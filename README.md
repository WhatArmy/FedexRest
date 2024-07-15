![CI](https://github.com/WhatArmy/FedexRest/workflows/CI/badge.svg)

# General Information
Fedex has offered a new Rest API that will replace the already obsolete WSDL and SOAP-based Web Services in the future. The goal of this library is to offer a convenient and easy to use wrapper to this service.

FedEx Rest API documentation https://developer.fedex.com/api/en-us/get-started.html

## Todo
### Services
- [ ] Ship API
   - [x] Create Shipment ([docs](https://developer.fedex.com/api/en-us/catalog/ship/docs.html#operation/Create%20Shipment))
   - [x] Cancel Shipment ([docs](https://developer.fedex.com/api/en-us/catalog/ship/docs.html#operation/Cancel%20Shipment))
   - [x] Create Tag ([docs](https://developer.fedex.com/api/en-us/catalog/ship/docs.html#operation/Create%20Tag))
   - [ ] Cancel Tag ([docs](https://developer.fedex.com/api/en-us/catalog/ship/docs.html#operation/CancelTag))
- [ ] Track API
   - [x] [By Tracking Number](#track-by-tracking-number) ([docs](https://developer.fedex.com/api/en-us/catalog/track/v1/docs.html#operation/Track%20by%20Tracking%20Number))
   - [ ] Track Document
   - [ ] Track Multiple Piece Shipment
   - [ ] Send Notification
   - [ ] Track By Tracking Control Number
   - [ ] Track By References
- [x] [Address Validation API](#address-validation) ([docs](https://developer.fedex.com/api/en-us/catalog/address-validation/v1/docs.html#operation/Validate%20Address))
- [x] Locations Search API
   - [x] [Location Search API](#find-locations) ([docs](https://developer.fedex.com/api/en-us/catalog/locations/v1/docs.html))
- [ ] Ground End of Day Close API
- [ ] Pickup Request API
- [ ] Postal Code Validation API
- [x] Rate Quotes API
- [ ] Service Availability API

### Other
- [x] [oAuth authorization](#authorization)

### Usage

| Library Version | Fedex Rest Api Version |
|-----------------|------------------------|
| ^0.5            | v1                     |

#### Installation
`composer require whatarmy/fedex-rest "^0.5"`
#### Authorization
###### Example
```php
$auth = (new \FedexRest\Authorization\Authorize())
            ->setClientId('some Client ID')
            ->setClientSecret('some Client Secret')
            ->authorize();
```

###### Sample Response
<details>
  <summary>Show Response</summary>


 ```php
object(stdClass)#85 (4) {
  ["access_token"] => string(980) "eyJhbGciOiJiUzI1NiIsInR5cCIdIkpXVCJ9.eyJzY29wZSI0WyJDWFMiLCJTRUNVUkUiXSwiUGF5bG9hZCI6ImFLcEpEZEJ1MXN4WmY3bEpFOUxxd2g3OEFCZ3FCSzcxa2hvdkRnWHpWWUtTWkR4RjI4Wk5aREtlK1J2U04zaWY2VGJLTTFDdk9wb21ya0JZNHJHTVFtTUlOdVdFWHZVSEdlTUdkMU43bDMxSnpXSVAwQlF4UlFsN0FCMjJOdUNwZHVnNTNuV0d0RzVFQTltR3lET2NCcityeSswMkpUd0c4R3RDS1BYa05uQS8zZmpQWmFkR3JmcE5Na1VvVm9CVkpWaktNOVZ3NGNVSGM1VHZpd1MxSXpVeHY5Y0hzMEIzdnV3cUlRbXFiSlBSVVAyaWljS1JyY3RYTHczOWZqdFZXTHVud1FHZ0xtYk5YMWVyb21oSVEvaHJRQzZMWTJwTHd0bGFaRkdRVzNFPSIsImV4cCI6MTYwMjU5MTg2NiwianRpIjoiNWQ2YzJjOWEtMTAxMy00N2E4LWEwM2UtOTAyZDdmNzhlYjdjIiwiY2xpZW50X2lkIjoibDc2YWMxODQ0YzU2MzA0OGU1ODJhNzkxODcxZjUxZjFmNSJ9.cBjvx6icIl1nx7MnQ9SOvlnlBd_C20maBmMyjJGqIVRMcz5fH3eHiIQ3SkUqCXGo1oCGTG4nBqW9YoPd1aZQt6r8TrbOM3F8vc8jFSMPB9Vd4aYM_9IrDYHeqe43iZcYOJ0kcUzkXA52fxtNhAQ94JzwEeMfWRsAdUK9xt-Ed-_ZYSxEiFPRpcCUDOOv2Qj9DM4sfXnG9v-6XGbQNu02dCXYrfD3LZ7M6nFSfzbSHQ4e6Gvb8CSBh4Q6RI2dOQl7J_qyC37kR1XihlJ7TrNKC5XPn08c2Pzp89jAL_3wTlhBRCSxpJfbgoKocdoBmOCY78YeqtBrTZFQ86wvb2XIqg"
  ["token_type"] => string(6) "bearer"
  ["expires_in"] => int(3599)
  ["scope"] => string(10) "CXS SECURE"
}
```
</details>

> **_NOTE:_**  
> It is good practice to save/cache an access token for future use. A token is valid for one hour. You don't need to generate a new one for every request. The token must be renewed before it expires or after it has expired. Generating a new access token for each request will slow down the library.


#### Track API
##### Track by Tracking Number
###### Example
```php
$response = (new \FedexRest\Services\Track\TrackByTrackingNumberRequest())
            ->setTrackingNumber('020207021381215') //set tracking number
            ->setAccessToken('some_access_token') //oAuth access token
->request();
```
###### Sample Response
<details>
  <summary>Show Response</summary>

```php
object(stdClass)#64 (2) {
  ["transactionId"]=>
  string(36) "6ff3eeba-5e2a-4459-9aeb-2761bb109511"
  ["output"]=>
  object(stdClass)#103 (1) {
    ["completeTrackResults"]=>
    array(1) {
      [0]=>
      object(stdClass)#67 (2) {
        ["trackingNumber"]=>
        string(15) "020207021381215"
        ["trackResults"]=>
        array(1) {
          [0]=>
          object(stdClass)#58 (18) {
            ["trackingNumberInfo"]=>
            object(stdClass)#384 (3) {
              ["trackingNumber"]=>
              string(15) "020207021381215"
              ["trackingNumberUniqueId"]=>
              string(26) "12013~020207021381215~FDEG"
              ["carrierCode"]=>
              string(4) "FDXG"
            }
            ["additionalTrackingInfo"]=>
            object(stdClass)#50 (2) {
              ["packageIdentifiers"]=>
              array(2) {
                [0]=>
                object(stdClass)#54 (2) {
                  ["type"]=>
                  string(18) "GROUND_SHIPMENT_ID"
                  ["values"]=>
                  array(1) {
                    [0]=>
                    string(8) "53089528"
                  }
                }
                [1]=>
                object(stdClass)#48 (2) {
                  ["type"]=>
                  string(26) "TRACKING_NUMBER_OR_DOORTAG"
                  ["values"]=>
                  array(1) {
                    [0]=>
                    string(14) "DT706344197515"
                  }
                }
              }
              ["hasAssociatedShipments"]=>
              bool(false)
            }
            ["shipperInformation"]=>
            object(stdClass)#57 (1) {
              ["address"]=>
              object(stdClass)#71 (5) {
                ["city"]=>
                string(9) "HEMINGWAY"
                ["stateOrProvinceCode"]=>
                string(2) "SC"
                ["countryCode"]=>
                string(2) "US"
                ["residential"]=>
                bool(false)
                ["countryName"]=>
                string(13) "United States"
              }
            }
            ["recipientInformation"]=>
            object(stdClass)#74 (1) {
              ["address"]=>
              object(stdClass)#73 (5) {
                ["city"]=>
                string(9) "JEFFERSON"
                ["stateOrProvinceCode"]=>
                string(2) "GA"
                ["countryCode"]=>
                string(2) "US"
                ["residential"]=>
                bool(false)
                ["countryName"]=>
                string(13) "United States"
              }
            }
            ["latestStatusDetail"]=>
            object(stdClass)#75 (5) {
              ["code"]=>
              string(2) "PU"
              ["derivedCode"]=>
              string(2) "PU"
              ["statusByLocale"]=>
              string(9) "Picked up"
              ["description"]=>
              string(9) "Picked up"
              ["scanLocation"]=>
              object(stdClass)#76 (5) {
                ["city"]=>
                string(9) "Jefferson"
                ["stateOrProvinceCode"]=>
                string(2) "GA"
                ["countryCode"]=>
                string(2) "US"
                ["residential"]=>
                bool(false)
                ["countryName"]=>
                string(13) "United States"
              }
            }
            ["dateAndTimes"]=>
            array(2) {
              [0]=>
              object(stdClass)#77 (2) {
                ["type"]=>
                string(13) "ACTUAL_PICKUP"
                ["dateTime"]=>
                string(25) "2016-08-01T00:00:00-06:00"
              }
              [1]=>
              object(stdClass)#78 (2) {
                ["type"]=>
                string(4) "SHIP"
                ["dateTime"]=>
                string(25) "2020-08-15T00:00:00-06:00"
              }
            }
            ["packageDetails"]=>
            object(stdClass)#80 (5) {
              ["packagingDescription"]=>
              object(stdClass)#79 (2) {
                ["type"]=>
                string(14) "YOUR_PACKAGING"
                ["description"]=>
                string(7) "Package"
              }
              ["physicalPackagingType"]=>
              string(7) "PACKAGE"
              ["sequenceNumber"]=>
              string(1) "1"
              ["count"]=>
              string(1) "1"
              ["weightAndDimensions"]=>
              object(stdClass)#83 (1) {
                ["weight"]=>
                array(2) {
                  [0]=>
                  object(stdClass)#81 (2) {
                    ["value"]=>
                    string(3) "4.4"
                    ["unit"]=>
                    string(2) "LB"
                  }
                  [1]=>
                  object(stdClass)#82 (2) {
                    ["value"]=>
                    string(3) "2.0"
                    ["unit"]=>
                    string(2) "KG"
                  }
                }
              }
            }
            ["shipmentDetails"]=>
            object(stdClass)#84 (1) {
              ["possessionStatus"]=>
              bool(true)
            }
            ["scanEvents"]=>
            array(1) {
              [0]=>
              object(stdClass)#85 (8) {
                ["date"]=>
                string(25) "2014-01-06T10:18:00-05:00"
                ["eventType"]=>
                string(2) "PU"
                ["eventDescription"]=>
                string(9) "Picked up"
                ["scanLocation"]=>
                object(stdClass)#86 (7) {
                  ["streetLines"]=>
                  array(1) {
                    [0]=>
                    string(0) ""
                  }
                  ["city"]=>
                  string(8) "FLORENCE"
                  ["stateOrProvinceCode"]=>
                  string(2) "SC"
                  ["postalCode"]=>
                  string(5) "29506"
                  ["countryCode"]=>
                  string(2) "US"
                  ["residential"]=>
                  bool(false)
                  ["countryName"]=>
                  string(13) "United States"
                }
                ["locationId"]=>
                string(4) "0295"
                ["locationType"]=>
                string(15) "PICKUP_LOCATION"
                ["derivedStatusCode"]=>
                string(2) "PU"
                ["derivedStatus"]=>
                string(9) "Picked up"
              }
            }
            ["availableNotifications"]=>
            array(3) {
              [0]=>
              string(11) "ON_DELIVERY"
              [1]=>
              string(12) "ON_EXCEPTION"
              [2]=>
              string(21) "ON_ESTIMATED_DELIVERY"
            }
            ["deliveryDetails"]=>
            object(stdClass)#87 (3) {
              ["deliveryAttempts"]=>
              string(1) "0"
              ["deliveryOptionEligibilityDetails"]=>
              array(4) {
                [0]=>
                object(stdClass)#88 (2) {
                  ["option"]=>
                  string(26) "INDIRECT_SIGNATURE_RELEASE"
                  ["eligibility"]=>
                  string(10) "INELIGIBLE"
                }
                [1]=>
                object(stdClass)#89 (2) {
                  ["option"]=>
                  string(28) "REDIRECT_TO_HOLD_AT_LOCATION"
                  ["eligibility"]=>
                  string(10) "INELIGIBLE"
                }
                [2]=>
                object(stdClass)#90 (2) {
                  ["option"]=>
                  string(7) "REROUTE"
                  ["eligibility"]=>
                  string(10) "INELIGIBLE"
                }
                [3]=>
                object(stdClass)#91 (2) {
                  ["option"]=>
                  string(10) "RESCHEDULE"
                  ["eligibility"]=>
                  string(10) "INELIGIBLE"
                }
              }
              ["destinationServiceArea"]=>
              string(14) "EDDUNAVAILABLE"
            }
            ["originLocation"]=>
            object(stdClass)#94 (1) {
              ["locationContactAndAddress"]=>
              object(stdClass)#93 (1) {
                ["address"]=>
                object(stdClass)#92 (5) {
                  ["city"]=>
                  string(8) "FLORENCE"
                  ["stateOrProvinceCode"]=>
                  string(2) "SC"
                  ["countryCode"]=>
                  string(2) "US"
                  ["residential"]=>
                  bool(false)
                  ["countryName"]=>
                  string(13) "United States"
                }
              }
            }
            ["lastUpdatedDestinationAddress"]=>
            object(stdClass)#95 (5) {
              ["city"]=>
              string(9) "Jefferson"
              ["stateOrProvinceCode"]=>
              string(2) "GA"
              ["countryCode"]=>
              string(2) "US"
              ["residential"]=>
              bool(false)
              ["countryName"]=>
              string(13) "United States"
            }
            ["serviceCommitMessage"]=>
            object(stdClass)#96 (2) {
              ["message"]=>
              string(50) "No scheduled delivery date available at this time."
              ["type"]=>
              string(35) "ESTIMATED_DELIVERY_DATE_UNAVAILABLE"
            }
            ["serviceDetail"]=>
            object(stdClass)#97 (3) {
              ["type"]=>
              string(20) "GROUND_HOME_DELIVERY"
              ["description"]=>
              string(19) "FedEx Home Delivery"
              ["shortDescription"]=>
              string(2) "HD"
            }
            ["standardTransitTimeWindow"]=>
            object(stdClass)#99 (1) {
              ["window"]=>
              object(stdClass)#98 (1) {
                ["ends"]=>
                string(25) "2016-08-01T00:00:00-06:00"
              }
            }
            ["estimatedDeliveryTimeWindow"]=>
            object(stdClass)#101 (1) {
              ["window"]=>
              object(stdClass)#100 (0) {
              }
            }
            ["returnDetail"]=>
            object(stdClass)#102 (0) {
            }
          }
        }
      }
    }
  }
}
```
</details>


#### Address Validation
###### Example

```php
$response = (new \FedexRest\Services\AddressValidation\AddressValidation())
            ->setAddress(
                (new \FedexRest\Entity\Address())
                    ->setCity('Irving')
                    ->setCountryCode('US')
                    ->setStateOrProvince('TX')
                    ->setPostalCode('75063-8659')
                    ->setStreetLines('7372 PARKRIDGE BLVD', 'APT 286')
            )
            ->setAccessToken('some access_token')
            ->request();
```

#### Create Shipment
###### Example
```php
$request = (new CreateShipment())
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setAccountNumber(749999999)
            ->setServiceType(ServiceType::_FEDEX_GROUND)
            ->setLabelResponseOptions(LabelResponseOptionsType::_URL_ONLY)
            ->setPackagingType(PackagingType::_YOUR_PACKAGING)
            ->setPickupType(PickupType::_DROPOFF_AT_FEDEX_LOCATION)
            ->setShippingChargesPayment((new ShippingChargesPayment())
                ->setPaymentType('SENDER')
            )
            ->setShipDatestamp((new \DateTime())->add(new \DateInterval('P3D'))->format('Y-m-d'))
            ->setLabel((new Label())
                ->setLabelStockType(LabelStockType::_STOCK_4X6)
                ->setImageType(ImageType::_PDF)
            )
            ->setShipper(
                (new Person)
                    ->setPersonName('SHIPPER NAME')
                    ->setPhoneNumber('1234567890')
                    ->withAddress(
                        (new Address())
                            ->setCity('Collierville')
                            ->setStreetLines('SHIPPER STREET LINE 1')
                            ->setStateOrProvince('TN')
                            ->setCountryCode('US')
                            ->setPostalCode('38017')
                    )
            )
            ->setRecipients(
                (new Person)
                    ->setPersonName('RECEIPIENT NAME')
                    ->setPhoneNumber('1234567890')
                    ->withAddress(
                        (new Address())
                            ->setCity('Irving')
                            ->setStreetLines('RECIPIENT STREET LINE 1')
                            ->setStateOrProvince('TX')
                            ->setCountryCode('US')
                            ->setPostalCode('75063')
                    )
            )
            ->setLineItems((new Item())
                ->setItemDescription('lorem Ipsum')
                ->setWeight(
                    (new Weight())
                        ->setValue(1)
                        ->setUnit(WeightUnits::_POUND)
                )
                ->setDimensions((new Dimensions())
                    ->setWidth(12)
                    ->setLength(12)
                    ->setHeight(12)
                    ->setUnits(LinearUnits::_INCH)
                )
            )->request();
```
###### Sample Response
<details>
  <summary>Show Response</summary>

```php
stdClass Object
(
    [transactionId] => 99ba99f9-9999-99f9-a99d-9a9c9e9ac99a
    [output] => stdClass Object
        (
            [transactionShipments] => Array
                (
                    [0] => stdClass Object
                        (
                            [masterTrackingNumber] => 794699999999
                            [serviceType] => FEDEX_GROUND
                            [shipDatestamp] => 2023-01-22
                            [serviceName] => FedEx Ground®
                            [pieceResponses] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [masterTrackingNumber] => 794699999999
                                            [deliveryDatestamp] => 2023-01-25
                                            [trackingNumber] => 794699999999
                                            [additionalChargesDiscount] => 0
                                            [netRateAmount] => 0
                                            [netChargeAmount] => 0
                                            [netDiscountAmount] => 0
                                            [packageDocuments] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [url] => https://wwwtest.fedex.com/document/v2/document/retrieveThermal/SH,31b7d2e9c193913c794699999999_SHIPPING_Z/isLabel=true&autoPrint=false
                                                            [contentType] => LABEL
                                                            [copiesToPrint] => 1
                                                            [docType] => PDF
                                                        )

                                                )

                                            [currency] => USD
                                            [customerReferences] => Array
                                                (
                                                )

                                            [codcollectionAmount] => 0
                                            [baseRateAmount] => 17.4
                                        )

                                )

                            [completedShipmentDetail] => stdClass Object
                                (
                                    [usDomestic] => 1
                                    [carrierCode] => FDXG
                                    [masterTrackingId] => stdClass Object
                                        (
                                            [trackingIdType] => FEDEX
                                            [trackingNumber] => 794699999999
                                        )

                                    [serviceDescription] => stdClass Object
                                        (
                                            [serviceId] => EP1000000134
                                            [serviceType] => FEDEX_GROUND
                                            [code] => 92
                                            [names] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [type] => long
                                                            [encoding] => utf-8
                                                            [value] => FedEx GroundÂ®
                                                        )

                                                    [1] => stdClass Object
                                                        (
                                                            [type] => long
                                                            [encoding] => ascii
                                                            [value] => FedEx Ground
                                                        )

                                                    [2] => stdClass Object
                                                        (
                                                            [type] => medium
                                                            [encoding] => utf-8
                                                            [value] => GroundÂ®
                                                        )

                                                    [3] => stdClass Object
                                                        (
                                                            [type] => medium
                                                            [encoding] => ascii
                                                            [value] => Ground
                                                        )

                                                    [4] => stdClass Object
                                                        (
                                                            [type] => short
                                                            [encoding] => utf-8
                                                            [value] => FG
                                                        )

                                                    [5] => stdClass Object
                                                        (
                                                            [type] => short
                                                            [encoding] => ascii
                                                            [value] => FG
                                                        )

                                                    [6] => stdClass Object
                                                        (
                                                            [type] => abbrv
                                                            [encoding] => ascii
                                                            [value] => SG
                                                        )

                                                )

                                            [operatingOrgCodes] => Array
                                                (
                                                    [0] => FXG
                                                )

                                            [description] => FedEx Ground
                                            [astraDescription] => FXG
                                        )

                                    [packagingDescription] => Customer Packaging
                                    [operationalDetail] => stdClass Object
                                        (
                                            [originLocationNumber] => 386
                                            [destinationLocationNumber] => 752
                                            [deliveryDate] => 2023-01-25
                                            [deliveryDay] => WED
                                            [ineligibleForMoneyBackGuarantee] =>
                                            [serviceCode] => 92
                                            [packagingCode] => 01
                                            [deliveryEligibilities] => Array
                                                (
                                                    [0] => SATURDAY_DELIVERY
                                                )

                                            [transitTime] => TWO_DAYS
                                            [publishedDeliveryTime] =>
                                            [scac] =>
                                        )

                                    [shipmentRating] => stdClass Object
                                        (
                                            [actualRateType] => PAYOR_ACCOUNT_PACKAGE
                                            [shipmentRateDetails] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [rateType] => PAYOR_ACCOUNT_PACKAGE
                                                            [rateScale] =>
                                                            [rateZone] => 4
                                                            [ratedWeightMethod] => DIM
                                                            [dimDivisor] => 139
                                                            [fuelSurchargePercent] => 5.5
                                                            [totalBillingWeight] => stdClass Object
                                                                (
                                                                    [units] => LB
                                                                    [value] => 13
                                                                )

                                                            [totalBaseCharge] => 16.49
                                                            [totalFreightDiscounts] => 0
                                                            [totalNetFreight] => 16.49
                                                            [totalSurcharges] => 0.91
                                                            [totalNetFedExCharge] => 17.4
                                                            [totalTaxes] => 0
                                                            [totalNetCharge] => 17.4
                                                            [totalRebates] => 0
                                                            [totalDutiesAndTaxes] => 0
                                                            [totalAncillaryFeesAndTaxes] => 0
                                                            [totalDutiesTaxesAndFees] => 0
                                                            [totalNetChargeWithDutiesAndTaxes] => 0
                                                            [surcharges] => Array
                                                                (
                                                                    [0] => stdClass Object
                                                                        (
                                                                            [surchargeType] => FUEL
                                                                            [level] => PACKAGE
                                                                            [description] => FedEx Ground Fuel
                                                                            [amount] => 0.91
                                                                        )

                                                                )

                                                            [freightDiscounts] => Array
                                                                (
                                                                )

                                                            [taxes] => Array
                                                                (
                                                                )

                                                            [currency] => USD
                                                        )

                                                )

                                        )

                                    [completedPackageDetails] => Array
                                        (
                                            [0] => stdClass Object
                                                (
                                                    [sequenceNumber] => 1
                                                    [trackingIds] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [trackingIdType] => FEDEX
                                                                    [trackingNumber] => 794699999999
                                                                )

                                                        )

                                                    [groupNumber] => 0
                                                    [packageRating] => stdClass Object
                                                        (
                                                            [actualRateType] => PAYOR_ACCOUNT_PACKAGE
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetails] => Array
                                                                (
                                                                    [0] => stdClass Object
                                                                        (
                                                                            [rateType] => PAYOR_ACCOUNT_PACKAGE
                                                                            [ratedWeightMethod] => DIM
                                                                            [minimumChargeType] =>
                                                                            [billingWeight] => stdClass Object
                                                                                (
                                                                                    [units] => LB
                                                                                    [value] => 13
                                                                                )

                                                                            [baseCharge] => 16.49
                                                                            [totalFreightDiscounts] => 0
                                                                            [netFreight] => 16.49
                                                                            [totalSurcharges] => 0.91
                                                                            [netFedExCharge] => 17.4
                                                                            [totalTaxes] => 0
                                                                            [netCharge] => 17.4
                                                                            [totalRebates] => 0
                                                                            [surcharges] => Array
                                                                                (
                                                                                    [0] => stdClass Object
                                                                                        (
                                                                                            [surchargeType] => FUEL
                                                                                            [level] => PACKAGE
                                                                                            [description] => FedEx Ground Fuel
                                                                                            [amount] => 0.91
                                                                                        )

                                                                                )

                                                                            [currency] => USD
                                                                        )

                                                                )

                                                        )

                                                    [signatureOption] => SERVICE_DEFAULT
                                                    [operationalDetail] => stdClass Object
                                                        (
                                                            [barcodes] => stdClass Object
                                                                (
                                                                    [binaryBarcodes] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => COMMON_2D
                                                                                    [value] => Wyk+HjAxHTAyNzUwNjMdODQwHTAxOR03OTQ2MDcwMjU0NDIdRkRFRx00OTEwMjIxHTAyMh0dMS8xHTEuMDBMQh1OHVJFQ0lQSUVOVCBTVFJFRVQgTElORSAxHUlydmluZx999999999MDYdMTBaR0QwMDkdMTJaMTIzNDU2Nzg5MB0yMFocHTMxWjk2MjIwMDE5MDAwMDQ5MTAyMjEzMDA3OTQ2MDcwMjU0NDIdMzRaMDEdHgQ=
                                                                                )

                                                                        )

                                                                    [stringBarcodes] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FEDEX_1D
                                                                                    [value] => 9622001900004910999999999999999999
                                                                                )

                                                                        )

                                                                )

                                                            [astraHandlingText] =>
                                                            [operationalInstructions] => Array
                                                                (
                                                                    [0] => stdClass Object
                                                                        (
                                                                            [number] => 2
                                                                            [content] => TRK#
                                                                        )

                                                                    [1] => stdClass Object
                                                                        (
                                                                            [number] => 7
                                                                            [content] => 9622001900004910221300794699999999
                                                                        )

                                                                    [2] => stdClass Object
                                                                        (
                                                                            [number] => 8
                                                                            [content] => 581J2/D297/FE2D
                                                                        )

                                                                    [3] => stdClass Object
                                                                        (
                                                                            [number] => 10
                                                                            [content] => 7946 0702 5442
                                                                        )

                                                                    [4] => stdClass Object
                                                                        (
                                                                            [number] => 15
                                                                            [content] => 75063
                                                                        )

                                                                    [5] => stdClass Object
                                                                        (
                                                                            [number] => 18
                                                                            [content] => 9622 0019 0 (000 000 0000) 0 00 9999 9999 9999
                                                                        )

                                                                )

                                                        )

                                                )

                                        )

                                )

                            [serviceCategory] => GROUND
                        )

                )

        )

)
```
</details>

#### Cancel Shipment
###### Example
```php
$request = (new CancelShipment())
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setAccountNumber(749999999)
            ->setTrackingNumber(794953555571)
            ->request();
```
###### Sample Response
<details>
  <summary>Show Response</summary>

```php
stdClass Object
(
    [transactionId] => 99ba99f9-9999-99f9-a99d-9a9c9e9ac99a
    [output] => stdClass Object
        (
            [alerts] => Array
                (
                    [0] => stdClass Object
                        (
                            [code] => VIRTUAL.RESPONSE
                            [message] => This is a Virtual Response.
                            [alertType] => NOTE
                        )

                )
            [cancelledShipment] => 1
            [cancelledHistory] => 1
        )

)
```
</details>

#### Create Tag
###### Example
```php
$request = (new CreateTagRequest())
                ->setAccessToken((string) $this->auth->authorize()->access_token)
                ->setAccountNumber(740561073)
                ->setServiceType(ServiceType::_FEDEX_GROUND)
                ->setPackagingType(PackagingType::_YOUR_PACKAGING)
                ->setPickupType(PickupType::_DROPOFF_AT_FEDEX_LOCATION)
                ->setShipDatestamp((new \DateTime())->add(new \DateInterval('P3D'))->format('Y-m-d'))
                ->setShipper(
                    (new Person)
                        ->setPersonName('SHIPPER NAME')
                        ->setPhoneNumber('1234567890')
                        ->withAddress(
                            (new Address())
                                ->setCity('Collierville')
                                ->setStreetLines('RECIPIENT STREET LINE 1')
                                ->setStateOrProvince('TN')
                                ->setCountryCode('US')
                                ->setPostalCode('38017')
                        )
                )
                ->setRecipients(
                    (new Person)
                        ->setPersonName('RECEIPIENT NAME')
                        ->setPhoneNumber('1234567890')
                        ->withAddress(
                            (new Address())
                                ->setCity('Irving')
                                ->setStreetLines('RECIPIENT STREET LINE 1')
                                ->setStateOrProvince('TX')
                                ->setCountryCode('US')
                                ->setPostalCode('75063')
                        )
                )
                ->setLineItems((new Item())
                    ->setItemDescription('lorem Ipsum')
                    ->setWeight(
                        (new Weight())
                            ->setValue(1)
                            ->setUnit('LB')
                    ))
                ->request();
```
###### Sample Response
<details>
  <summary>Show Response</summary>

```php
stdClass Object
(
    [transactionId] => e73db59a-5161-4e9e-81fa-fd7f82146ceb
    [output] => stdClass Object
        (
            [transactionShipments] => Array
                (
                    [0] => stdClass Object
                        (
                            [masterTrackingNumber] => 794607989058
                            [serviceType] => FEDEX_GROUND
                            [shipDatestamp] => 2023-01-27
                            [serviceName] => FedEx Ground®
                            [pieceResponses] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [masterTrackingNumber] => 794607989058
                                            [deliveryDatestamp] => 2023-01-31
                                            [trackingNumber] => 794607989058
                                            [additionalChargesDiscount] => 0
                                            [netRateAmount] => 0
                                            [netChargeAmount] => 0
                                            [netDiscountAmount] => 0
                                            [packageDocuments] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [contentType] => LABEL
                                                            [copiesToPrint] => 1
                                                            [encodedLabel] => iVBORw0KGgoAAAANSUhEUgAABXgAAAO2AQAAAAB6QsJkAAAlyUlEQVR42u2dTW/kyHmA2WnAnAUM00AuPshTBgwkxxjIIQNYGSLID/BfCJBDjhkjlzFWEluYADrqaBhYbP+EPSbBZKxWlES31XEOzlgUGnGfFqLSNsRGs1nhV5HFjypWkVVFcl3EerwfPdIz1Fvv9/uWAaf1GJpX82pezat5Na/m1byad8DH1rzfEt7QYfjQtu0Dx5pXIq9haF4tD5pX835beIPx8IbGrI3XN6fF686mxXvjDcbrGpUHwGDXxnsZnEyKF4Rj4vVbeW01+mzLxutNjHf182nxfmc2Kd7we/NRnLfAmLPx2uYo9Bkzb7v/ENkLzzibQegZVvSF/ZPoSw/Gy+DvRPZ4Zbw1nJTX845l8DLLL5O/cwu9wIZwcxd92Q3YbUfNG/2wlnANM97NZjkF3g1cZry3g/JCeM3JeyeJl9F/8Jr0766Z95fyeJn1WXTut4sZjP7Cnl81yO8Shn96Gf3YLm11vA0/gEgituEh0QPzWMUmJJ8laR0r+0rG8S18Cm3o/yT6sHdkwyF54/eb8i4SFZuQrOwyb6R/T5xUpwXHcvyH3ZZdfiPexSxM/qmZN7JvkU1+lunv7Dj0Q/x+974VmOhznyV+zmX2ozo7rv3oxPM+bdnjzZh340WeQum8NfO6xpEU3gcOXvg5hMvop70v6TOMd/vgW5m/4xpy7PFizWHfLtAHvdQDghXem5VnZryRJpbBG36Xzz/LLETGu0s0Xcbrnx3fffH369jVuZPGGxyZbPLgpLzx2Q8cxBvLr4943bPj5Zf/sJXMe2ax8UYf2/oAxiSRSUj+l+oH7zLVZ/A/jo+XL3He/5XAe2D0H8JZzLFJ7HFs6yBA+vd6kYnyd4yT5WtcHv55PaC/E1Ft7zPFYOG881XKG1gx7xsz5w2/aw5nj6Eb2berQ/wDWSW/ZYnkwXLT3xvY58HXx7E+y3gD2xqQdzNLedcZ7z06b0ixRacwWL1J9EjM6xo/VBcfN/E+pLwg5Q1zfeYUJyHwthgvkOI/eJDr/frot4GmPzzClOjv+A67/Ebn7RaZxUSfpVqNxOvaMnhtNt5YP0T67CojS8OMsOJPYm81AjcknDeYaiM2/RvZi+z9ehaFNzDs+Eu8BBcSeGcXbLxWao8z+fUcAm8sD/5Z9g42EvSDedPIC7K/ol+Sv0H+A4xNso2/X3B5mVn21xnvU6qcAynxG1gz8SZ66uo+1r/XkX1L5Dd6ozXe1I9L9NmRFN7U+a7yguiv+Jd6vi+yb9BM9cMQvAT/ocYbOjbKl6ycm1T/NvG682XKC5dfSOH9ndPIm4mBC7J/RryRSKzsNbJvYSPvU8r7pZTz9md8vNHzn9Ya+Q9hozz4iU+x/FKGPkt0Zd1euKCs2vB89X+b61yMGnmD1/HXXC7l2Is5L+/tu5soHvqB08jrx5987SS8Kxn2+Hd/S5AHkMKCAh7xrswSL8x4nTDi9fJcyqUU/4wsv2Re10K8df9s/eP8B2fL8X+J8pubC+R0IV4fEJU53Pwlyj+4UupDFPkl8VYh58gltkq8kvJnjfKb8SY6LT9uNd7UXriIaTEvyUP0zFXZCypvEPs7Rm7fVkbmtBtGxPtkFi6Ix6LPAoPwzDnscWqRjVQggJuZjS2KoCyc910AsoyKdxJFdFi+z4Cj4HWhmfGexYbhMouQQxvVj1P5XX5hqePNZAFJRUmf3cT53yh6z3jL+jd57jJ/Zxy8t+vYHtvNvO684FX3flNckPmVlfOW8oJW3uVsArxJwjXjjXxkVf1yWEAEc7cSye/1Ter/prwWzOJNOylhbRHvJQjno+B1jZJ+uAgz/QD8k+xDt/EbX0nqfyDloxJLkemysv59Eevf/LydI/1reog3+Tij/yBI/1J4/aO4XugkEhvnq4PMvplJ/2T8bTybPX8mjBcduhpv5dmGSOvuI17fgnz5Pum8eP2tIT/p5L/7KPqiauP51Jms8GL1zdvruv8Lc/9hJLxJ/Rgk+Ulz0fh+E97N3RKq7Fd2c3sBy7xxfT48is9baBpOlTeX39Hwxv0P4atYn4XgqJ5PnQ/E26QJMv07h8Gbk9hevH5Z590OJA9k3pjt54X/UM9Xc/EK83do/Yg4b/7vinxf1s81Ot6Ts9HwppFQ4fdUeN/GlriJN/mcRF531on3+CTmfXXiYPJb5pVjj8PsR92Uj8JKaVX/If1toeHVeOPfJJE3yL4bJy9M/5gzDxJ5WeuxfLy+YZjN+ZJCHvKACONdJP/m3VP89+CySR7k8Hp2OO/Ciz/NvFDKeXPjPrhGecgscRENFfmoQikk9WNQio9zIZJi3x6Svzh5rUZeWKl3K+VF4Xzp4CFek8Jb5KPGw/s3ZV7LauT9C4W8eLhZs8fBG6fEm/VHpf5OmnuPjfWfy6hfEM4bnfctwPPVcIXzJvWWOBno/Z2M+kUUec+b46HMamTUJXlIWuz8nBf1RyW8SX49NiMPSeOKIntB5U37owreWr0liUcf1dpjlJNqsBc5b1P/TsJrScs/EP2drryxPGD/Vng8RPAns36CsulA8pt8Nuctx0NxvcWH8nip+Qcyb9ZvX+fN6y1KefOICOANZZi/Q+Qt7IWc/FmzPFB5g6ect/ydz7rMbwo5b0W9Jc1GlfO/ngVLQlrnVR1fUHldb87Aqzi+yPoIXKNe777xS7xIfpXwEuMLCu+tv2bgTbWwovgCvR7X4OE9TniXmX7wZcgv0Z9s5cXCt0t0dk9w3geFvKifC3XDlOtv3hofwcp5IeJN5eFiLLzubA2fYFjnPQ8w3rQqp0weMDtctcfefA09x6/2I+Lx5h3yMpSdNwpvHB97wG3hfZJiLwjxRVu+OmJeNPNmgxmy5gNI9qKNF87n6Eee9/dl/o5UXlJ8QctXx6OncGW18MrxJ0nxBY03qc3HJeKMFzbybtTGF3kaCjk9sNRPgL3fcjxUfAlHCi8pvqDwrtcXuPwSeH1TZXyRtmngzbSYPX5aZ/qhgTd37xMpVyUPrbyp/nVwf6eYvwjj4kb4Fqg7b6iLC2GDGm9i3xp4YzfSj1FDZ6lOn1F5bx5uUv+hkdePR8Yv2d+vuPgiz5dU9cP8IvXPstlPH+D1gMgd2W7v2OVXXHxB4vXMi1JhAOX7Ut7ov23Xd+z6QVh8gTUjVvKTYFlKtJ9DjDfZE5HUh6ToX0p8QeTFDmvyq4nzxjKd1mOhSt4sW92yLyjJVPsA543dyN3tUpb/0IW3SD8mzZ2oI6qob/rfA7LieRovyKSi2u9Z8K5jHXAOq7zhS0cWL+m8MfKW9oHk9U1MzSmKLwpvp0isVnjj9MLax3mL/uokPl6orF8w8roYL+6fSdO/FHsM0DxDE2/iP6Ty2+RPcuhfYflUIm9q43ykHwi8iuMLPCYCdXvhGT7MK4WXTfl1xfEFlXcdnaZXyL4ReNPGxAH2VdTqLQmv/6Io1OO8u+QrJfpBpTzQeK9j3vjdosYNlC9xT2Cy7yrl9XrHF/6MPZ7P+mEgNi6d1wuTEetF7v9CPN+3hoAvv055VpVyLy1fQuOdr1PLWMlXh/F+5c1mKawesCjvkqDno1zUCl6Lh0KjOb/ug5yXI79D4TVDizW+oPFC98f5t8Ltm+vE8nADhPGCXNIY8qnIZc9nTwtef47z5vJ7HtsL7/t2Pv8mgZecr6bwxj+SY6fKG8UZcT/4K2cAXjSGboD8f7j+fQeD43nR/1u1F1BQf2qD/HbjXUP/2JDP26AfaPJAy1d7IYE3lgdRvA36l3beaLxP4atqP3jqnyWDUIJ4G+wbMb6g5Kv914DMm+izX97Jmg8gxhe0/PoLs5k3jodie5Hs95TDS+lXTiux6G8q+XUvoPAm+z0F8HL4OzTeeB7SN97GBe6jGm8sD9nOYhnnjVK/qAdE2LxpEMcX0R/WqfLG541rvyefPqPUL6i86Sk1FjXeRJ/J83eI9QsjN8agOm+azvMmHsND+RsL3hffYI+78CbzvJgqznZJdeznEsQLsMJWxV64L8y86TcOj1wb4w2M0fHG+jco0hnnK1A5b1zzIpSHS35BPjTiVuZxYvvmGzPkT17cWrg+g0AYL7t+oPIm79jJ+x+si0vcXsClMN4m/UvRZ7WORNzfgQ39JZ14+fydLrw738540/0EJV5ueRAz/waKNRVu1V48uFaJtzR/wX3eFPDG+5gS+W3gjfWZTHkg9tPmrZ51f+fiJtMPCe/3AKjkU0XxNpw3Uv6Xxnt7uU71b8q7OAa1/K80f4eUXy81erp13sS+pbyrE7sPL6a+7HZ7QcxHtfFmFaHoW7hF20bMu+tqj8NkWZJFt8eEfBQ6Y25TPPRwe4vzVuoBQVdeP+KNt5BTeUnzejTepN8okQcnxPNRKW/0lbrZNzfi9UsRAEd+x0CCgKX7cv8hen2BUQzBwWo/YjfeBV6aJMlvF964E8PHf3B4vqQ7b3LpFVbMgxz5nXKvkVvff+b7D828kvVvV96n4G01Pymet8G+kftLgFs4ktX8uoPzFj9C90Qsb8ND7Kel8MbqqpH3PJDOS+6PKkTBBfX+Sc9/U+3nSustUK7/29J/1sh7Dd9Ff86Hoh/xEqu3cPfTCvF3smW6eDMBZo8jpzyY1XmTestDPh/Aqc/c5FaY+QozGE3xGzEfReeF5qbGm9RbXNCZNynUeNg75YiPafnqhDf5UZZ403pLOO/Iu0oSF8DHeDnyDzTeWH4beDP963Hy8tWHGOrdzf6OfVft/814AyBsvrCBt1v/euTv2DcE3nx+SEp+kjx/nG+7qtULE3/Hvqb1g4uRB/Z6N5U3ecfZvQ6Q2B8lR//S9oFgWZO6v+PX6vMH4bwc/k4H3sDuxJsbhzhoMSJhA7RP0faBFMtWXBpvvr/E7BUfy+X1vDdV3tDozzvryFsUAozmfjk8HkL5qBXoy2tI4w3+ZF7jdefyecn9tNjGwYZ926EZq8H0KgrEuzZO+vLO23hJ8UUbb0aYur2IdyV/fp4SX2QBkdG4nwDjze/7Wvvyean9tGy8+X1fa1fwPgWeejdSadi4CIEX3fdVyG+n/NlqniSNcP+Xp97Nzovu+yr0w7bLeVvNarw89e58J1O9HlB58q+Z699uvEaSmOsWD/HwOrlowX68TixHeLzJEV+gNfF52waZNz84Zi/eKN6Mrzky6LzUfYOcvHZPXmsVh5sGNf9LmT/GJiIBjbfu/3bi9eJvZJd42esXXXh71lsQ74ya/6XGF6in1jVo500Qrx/zOiVejv4+Dt7qPLpU+0btp80lgioP8nh5/F8W3sr9Wd36jUTtWwFFzpqNN3qvgnl55KEDry9aHtjPG37cXEDyd9J6IeINk/tmRPI26jPCvkF+3sCwg5oPxFF/C2JTEeCEHPYC5IMirsHKC3L9mybW4ouUeOrzC6vm+THbYx5eWHu/XmYkHeH9csR+DUq+usKLfSnEm/YrxhcTKcpXd+Et9EO2zzH+dor6U9v2mSMPMigpHKR/sz+FAx+V9f8y8YZWad92bt867XO8aQo5mONN1IvQVC/EXTPYez9iDleXSK55PRbe+PJxCm/AxWsxKmnifADA2j6beZNFidX9USUh44rn2bxksztvyZ9s8NdtrvjYZpAHYn8Uvk4BkPJRBN5MHjyu+zdXeEcQb3zByEuQh468tc/y9O/kaVS3WAiybch5NfnrnfqNVkaNjrc/qpU3eSXieOft/gPNX8eC+ubzFpqxvejJK2h+k4kX+E7jfc3yeCnxRXHmSPmo1H/I/ckq75ZJ//LOHxPjCwbekn9W4/VCoLLenW9cMQxA9ycJ7/f/nEvh8SY1vujJuwV3quoXxTXN2DgOMy/6+OUdX/xmGOQBkbb4gok389dJvLeXfP3ghlG3yWz+emGQceJmfUbmdQE3r9Hi7/TjNUvxBbYvKP24b4uf3yTVW9yi25kxvoAq5hn68Sb+jjxerv4+VMpq3r+D+ZOVfnuMBNri8w+9eLOHwOtDoIq3qBcWe6E5eNP/f+qbL1HGm361eK0jlz6bJ0UXm+avE+WhEAdKvZsoD3ZHXlji5Zjf5OKFzfHb08MlN69rtPQTEO0FdhMrPZ4n8vovADdv6Qobjnm9Xrzon45sbt5IBqguDzn/i/drdOPlrAfU3y97PkoIb+98Kns+ijFf3XBfUiUcV7WfVgRv73pAk7tOyUe159fpvGz1FjH3MzDxYrdJN+qHucL7JGBeiHWb+pWz51yqPymcN1n9K6hfI9ZnccTpUOOhlnxfKZ1a5/WBUN7qW+XK/7LwJuILhNmL0jeDkKPeDYt2rvo+3bL4CuZtyf9S9pm386abq4Xymi35X2p9KL80id6vQeQFsF9+h6+/rz+vCdXVu138qi9CvNnG+2OF8TwLb/5TJ/C+UpYvgehGNfy6UG7eY1vVPjExvLalrH/dKBaKQbI8eBbNX2erF4q5L5SNdzXvz4tp33n7p2j7zItSQMf8pN2zvskeX7DxlvO//XkZPtW2nzZXa+T8+hj8Xzbear9RNb7wlPen4pmT1n6uWj7VsybF+7S1VMqDC2CxNJPCS5Tf7e5O4f16I+B1LcgYX7hFKdal1GOT80bkfXriyf/eN9jeGYe9YODN6oU+IJy3+V2v/lS/su6Unu8ruzyAbC+wpElQC5f68Lq2B9jzqQy8qT3OL5zpG79Vnxv84vJ2fxJ1JALyvGni74SmJN57dCk8m7/OwJte3AwIvPFKbnX3d+f9RoVD2eyvYzm/ynkzbLX7Btt5Y/17TrZvS3X7Blny1eX70cXbC559g2Pg5ZvXY8lXh3T7Jr5+TOunZeQl+5NzoKy/z8Cz1aR4vqV+EZp8/crZY9PyZ+T9cv15+exFAy97Py10Cz/SJear23iXPXk57pNg4m05b715ufYNZnNOaCn0ELzs+3fGwduYLyHe311MQ9LlgTzPsIQq6939eaGyfYPYvkzX6D4vom7foBhe8f4OZb9cduIwkVDNyzev15vX68vL0S+XlwkReRdeizOe99v9h7Z5vT68cMbJm75XSOOl9q+DUuKPXG8h8fo/4+ItX27e7O+07DNn4SX7O6Gl7H49F7tphnzebq+pvH3PG8++QSZecwF7+7+C9g1i63Qp/fak+2M7++ttn6L6v6284Ijmr/P1T9a6S7h488sOaPIQvH5JjTcNwMlbcck67Neg8zbt48fiea7+35VRS/eyxxe4SSb7Oy28fP3Vq/owToM+I9cvWHhPzoTy1tQP87weKrFgUkHmfRIlDybZcrbaCybeVyfxb/OFnTenlZd2321u0Un1rNBI6he+I0qfzVt5afcJt/LCWbKopCgiK5gfIvXbg8pdX428757gOOazGHkzr5XAG7iOqvk31nw1lddfAVX3Z1F5FzM2//fp8lLZfVS0fHV4YMtPbpd3mpcYHxfz0rX7uxl5d3eX4+Ktli+q+sEA6u5TK1KqtXwqKy/k3ncVtuZTu/D6rLyQu37sduTF5sjq+yq2v5DGC2Xw3l2w8YZ953F47AUKghryUVeQjdfve9547DGFFzLy9p7n5bsvNI81q/fd5va4zV6oy/9Sea9OFfFy3jeT6bJavxErr8L5bjbeFv+MP35jyFcTebHrDkjy0MIbctk3tnq3TN4u+b6O8+jly1Aq8bwyXp59ICy8svsfuO4TzrtpoUuyF7J5efwzZbxC/F9sTZtbs8es8WZvXj5/h8gLTxXxcpy3ogscu1FCCi/l4dmfysIr9Lw1PDz3SeTGGBuYVs3Lsx9mYrwGftyq9dhcfoOzSfAeFPFy+ut5QzixH0YyL2c8NDgvl78DsU1XZXm4ulfEy+PvUHgxvuPR+A+UfHU5gpgSL5TLyyEPjP3g52OJLxh5RxO/FYVCl9bvuZPKy7uPv533V1J5Ofv70I2LlH7PzybGu7LHwosiTZAHR5J4xfWnMvAKkAdB+zUyE5xfySrtvInKrzPx7qTy8uV38pjTlWovBNUL2Xh3I+HFVmViNkOqvYj93ch9CrrV3xh5PxsJL9okVlpXIdde/FHxQgiLhfyAPM87Fnlg5f3ViHhRuDkFe8HKK9decMVDoICm3w85Bn9nHLxc9cJile5gvHz140nx5tcsukbbvJ7m7dKvAbC/G0qfcfb/quEtoYPSfeM8+9dBzppfZ6mI1+mQ/x2K10qWSHfxH1xQ3mU+7vhtHLyC+sFH6O8o5C19ujyyJ/q+UCm8mAyIvo9VOO+ifMx47HFxHVVx6KTzribGG39XqxMvCuMZ9hUL5PVa57uH5xUUDwE86zeBeHMMvJz1TVDuVlYgv6zZktHwMj+N/UYgX6mrSJ9V81OzafHy3e9UuJQAuoPw8vXvDM/L1d+XD6NLvt9J0P1v0+LFNBog79vWvH3uh8x26eZrV0ad3xkFL3+8mQ81yNdnveYZxsHL5z8gj12RvzMVXkH+L3ZN0gTyO+Pg5bpPuNosN2p7MQ5eznkGLGuteUXzFm325H1iY5LfRl7yJNnw/k7Ds706SLRv8z7x5ih4e/evK+blzO8MzXvPfp9E1qdhYGtB1PM23tfBxXu/V8nbdB8KJR4qXMncn9xsVeqzpvtm+Hg9SyVv030+tHwJ+jV32JX7v9a0eLn0Gdpmjt93oNge9+Ylb1IYmDevBKCcCZDGK8S+TY03xy3fp6Z5xe0/K277KvIlmlfcPrziLuHB+j358lHD83LWu7Oi93D2jbOfoM4bqo2H+PqrEThWj1XMy7mfa1q82JXNQ8nD1Hh59+HlspD7658r5eXdN1jnvRir/sUyfe5g/fZ8+zWaeA9KeTn8dYwYv09N8wrcf+ZW2gmmx9vq79S+p7L7Y5ue9vc7Nd4e9qIXL6kfXKY97lWfHwUvzzxOsSnTHaxfg6sfsYm32HQ1tngIoGAIYFcmjbo+PwJevv0w2LT/QPnqbzEvyC8cH7Dfk7M+r4aXos849QPmrrsj179D8Eb+48osTTTw5vsMgO0F4eP1wQD51B68m41aXuAWnF3kAVXG1e1j6seLOg9U3idhFEcOwiF4ufaJjYCXsx+xWMnE7/+y81L0GV9/Xy9e9vMmihf1E1D3ORJ515tp8Qqxb3zzpkUxy+D3d65E8PLtG+zFeyuCt0M/OHYbCp//oDj/25f3oN7fyWb18s02fLzrifEe1PKCYtxpEu+3N69a+S0WkZb6YWToB4o+U8h7q5q3OV+t1r4p5EWVDmXxcc99K0L8X4X714Xw8sVDebIadNgHojgeGgcvd34yIx0q3lTIKyRfwnm/HnTxYgtnPmqrWH578qJJAmX1oSImgmr2G2X9O0HX+/VGwMtl3wB2Z3MH/XDfkZfxEc3L/n6F3TeeN9vDofZV8Pk7w/Ny1VtA9dKksc+jD8/L1T+J+TtT2P/bk9czefVZw8PNi8WcnLx3u2nxLgMBvJz7d0AhFPz+eiiAl3P/zuC8fPfNoI7PIiBSLQ9c98f242U/b6LmndySKMjTZ+PgVezvFMhDvl+u/Q/9eIXIL2e9uzQrIk0/CMvv9OIVon+57juAWCGLvx9xarxC7EWHebLSo9o/6zCv15VXiP87+v3rnf2d3rxC7AVf/zpAS1e68Cr2d3rzCrEXfP4OJgwd6gGhUnkYBy+3v4MuDR1IHvjit168qu0FWvLqGt3umxkkX9KDV4i94PUfUKzpDmQvFPIKsRfc9wnDoulo3PqhN69i/ZuH8S62DnrM9q0vr3r/oYg4AZSZj+r2iOYVYi/4eCG2kn+Y+w4U8ip+v/kwTnEr9qjltzevkPwDVzwE8qRqp/71UKk+GwcvV3yMXYbSoR9ciL3gvm+mO6/q/C92kbDbpd9eiP/LFw/14mW3FyLvmzE630elOH7rzau63p3bjI7zTurr3f141de7G54x17t78iqud/fOV6uud48iv66QV4i9UCgPiuvd45BfhfUsxfXu/vMiauvHf3S8iuvd4zhvCuVXiD4bZb17HPr3amL27VoEL08+qqc/GYJp8cKHafm/QvK/Cs8b/3zssPEbPB0gPh6aV2H/2beXV2C9e2jeUcrvSPwdtfvEphbP98+fTczf4d+vwfeIlgdfBK9Cf4d9P8w48qns+3fG4e8cDgJ4FdoLIe9XoT0Wst9IYb5EyP4zhby3IngVyq8Q+6ZQP7DHb6L6q3vmH0T4Zwr9nVCE/lWZ39G845dflfmzzyfGezExXqh5R2/fFNoL9vc7jnhouRXAq9Df+Wpi8dC/KJ6X7sv7fmK8HybG++uzicVDfz2teOjqZlrxkBB7rNC+LUXsn1ToP3w1MX9diL3oLg9+9Oe1lNuL7ueNm/fDsP3K3Lzs9kKKv8PNy24vpNhjft6bafEKsRcKeVXP4/TlVb7vqqYL31pjnifry6t6Xm8UvH38B2ny0O0RzStkPkuhPAiZf1N43oTYC4X6zBURv/WIjz2Dj/e3IuLjHvmHlenz6bOzYXkTbTgd3tCYDcDLJr9e+beZ2ReVxds7HiLwOlDOeeutf5t4fV5e950y+9bI+934jzrO/SWNvEc/mRSvd/xqAN7u8iCRt0N8sTCMszHykvTZWHlJ9mKsvCR73M7rH/1oRLzwwW/l5bQX317eLvnJVt7giNPfEcJL9Heu23jDQXiJ/s55Gy88msER2bdZmReXmoz3CxOOx38I2nk9MCJe7/teG+/KguPpN3J/YoQtvLzxplTehd/Gyx1vSuU9D2YtvNzxpmj59XHNdhGadd7sD9gx3pTKe1nx1+u8/qh4rxp4wyrvgPGb65R5YQPvIjNtmf9rrYbknXPzAm9IXsMu8Vb9dQs5EY4CXgZ95homL689LO+sjTf/Ldl5G5Q3AnzLyQs8Z0DewPhByV54Vf8MfZHcXgB3SN6K597OG1qrQf0Hv4XXr/BK7H9gS++18KL5N3skvHAxMV6XzrvIeK2x8PoT4y09Nd4wEYXo5M40r4B4qMbrpwOxkRPhjJIXNvP6GW84i7sv7objracpQxpvEAzLG1rrqrqovt9ZalVS3l04LG9guqCFd47z7uEvBuX1zZVB5V1lKYiFARLe+2F5PbOaWR03b7zkuYXXzgKRlPe3w8qv63hcvP4Pd97L+d1w8TH0VtR4CIm3n/JGGmJo3rdMvEHOu/3ynybBayXyYErkZZJfl5XXTN7v87C8Hli9bTlv4+I1DJ/Km392HLw+J28IhuUNKvmoNt7D47C8sJLva+PdP/vzxZsB46GVTfcnx8YLW/z1Gm/kPzhwMryHRz/5wFR4Q+A7wZC8nuFUjihd/8KdvRuSF3U1FPajzptVWzLe5XZA3iQRgvs/LbyBubu7HZDXTzK7ePaazruDu83lgLxeWvrJn+um84bx7iP/FzhwQP8MrnDed+28vj0gr+tAr5RPbeE9QD+EQ/JW87813lmJ1zcDefpXCK9R0WfQjhcIToh3+VTmDY0B5fcdiTdA8gAv12Vet7FVUJF+OG/hhY8QbMu8i7KFlB6/lfTvqik+TnnT/MNzaO9KvOEczpTGbwbVHtd4A1jWD4ENveH8B6/OmxYKPcS7C8v+7yF6xcP5ZwGJN8v3wc0ucEbk/9b8dcS7yvKTYPc0pD1ujS8Q7yLP962XFV7DGDGvvbut+L/ByHiTwnFc1krUxN3ucl3m9YXxdpDfhvykFWK8UTwPniq8zoDxW43XTxvXV6ie9VyLj70h4zcG3mr+4UlxftJg403r8w35HaW8Vf+hOi9S5fWNffJfBuO1TZfKG5Z50SNFfpn833cl/7cDrzj9wBRfXJfzv9ck3jmRV6W9qPGek3hRv1FoV3gDlfbCheelfq7aPE7G6+a8h/sKL1TKa89K/XL1eZy0u9rP++X2jxAOmY+aL/DzUp/HqfL61tC8pfddm8fJePP+3/3PhuT1DfO6ZN/8Nl7/qyovMNXxhga4K6mH2jyOm/I6kHTegpdzhf7Zoqzt6/M4Vd6aPvOPZgp5K099Hser8Nbtxcmb4XivmuaH0Dck+A/+2+F4IT/vk+9rXorA3lH9dQbeJ4W8oQWvp8Trm3DRk9d7eFJoj82yBm7fp1DXZ/Pr4Xgj4pCTNzBvVPqT5XkGGMx5eUPrViGvU4kvPIuXV6l/VouHVjYnr9p8dY3XgJy8ausBrrMoxfOBycsrsN7CdN7K+R0P8PIKrGcxxUMvSryRcuPlFVcvZIqHXlDzfSz611CoHwLjaNaTV6k+Cw3bnBJv2dsRyAuH8dc1r+Z1GD6keTWv5h2GNzCtRxjFcDcPcTO874yd9xA+Px4+/N768DX8YKz+6l/B2HkP+7vD2R+2Z1/CU+f+8TeboXgPt7fPt9Hz/Px8+0zl/Sri3Z9dnSW8z4Pxvn///D56It73FN79Yf+Ph/APh/Dq7ODcw9/sB+M9Pd2cRs9mszndkHn9H+4fD+E3Ee/JfmDeQ8R7SHk/nJJ4d19vHw+Hbw6Hq9OY9/1wvIf9x9PD/vTjx4+nH8m8+9+Zj4fdN4fdb0/3s5X90+F495vn0/3mNJLf0+cP74n24vfR+91/c9g/fB6/38+H433eR6D7Vt4/RPL7/OnwDD9/du7D/XC8Ecbp44GJ9/HT4THhPQzH++k+4r1HvB+J8hvxfrj/tLsPnyPe/X47GO/V6fPp1Wkr7zcR79Wn/dWvY95IhtTyFs8n56fP752fpvbi3z6SPnb4+vnxg/Pp2fmfmPcxbTgYgnc9i+zxLLPH//VI/IEA6/HG+HfLWD8/Oqsf/QAMxSv20byaV/NqXs2reTWv5tW8mlfzal7Nq3k1r+bVvJpX82pezat5Na/m1byaV/NqXs2reTWv5tW8mlfzal7Nq3k1r+bVvJpX82pezat5Na/m1byaV/NqXs2reTWv5tW8mlfzal7Nq3k1r+bVvJpX82pezat5Na/m1byaV/NqXs2reTWv5tW8mlfzal7Nq3k1r+bVvJpX82pezat5Na/m1byaV/NqXs2reTWv5pX9/D85/dg+IRLCrQAAAABJRU5ErkJggg==
                                                            [docType] => PNG
                                                        )

                                                )

                                            [currency] => USD
                                            [customerReferences] => Array
                                                (
                                                )

                                            [baseRateAmount] => 13.14
                                            [codcollectionAmount] => 0
                                        )

                                )

                            [completedShipmentDetail] => stdClass Object
                                (
                                    [usDomestic] => 1
                                    [carrierCode] => FDXG
                                    [masterTrackingId] => stdClass Object
                                        (
                                            [trackingIdType] => FEDEX
                                            [trackingNumber] => 794607989058
                                        )

                                    [serviceDescription] => stdClass Object
                                        (
                                            [serviceId] => EP1000000134
                                            [serviceType] => FEDEX_GROUND
                                            [code] => 92
                                            [names] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [type] => long
                                                            [encoding] => utf-8
                                                            [value] => FedEx GroundÂ®
                                                        )

                                                    [1] => stdClass Object
                                                        (
                                                            [type] => long
                                                            [encoding] => ascii
                                                            [value] => FedEx Ground
                                                        )

                                                    [2] => stdClass Object
                                                        (
                                                            [type] => medium
                                                            [encoding] => utf-8
                                                            [value] => GroundÂ®
                                                        )

                                                    [3] => stdClass Object
                                                        (
                                                            [type] => medium
                                                            [encoding] => ascii
                                                            [value] => Ground
                                                        )

                                                    [4] => stdClass Object
                                                        (
                                                            [type] => short
                                                            [encoding] => utf-8
                                                            [value] => FG
                                                        )

                                                    [5] => stdClass Object
                                                        (
                                                            [type] => short
                                                            [encoding] => ascii
                                                            [value] => FG
                                                        )

                                                    [6] => stdClass Object
                                                        (
                                                            [type] => abbrv
                                                            [encoding] => ascii
                                                            [value] => SG
                                                        )

                                                )

                                            [operatingOrgCodes] => Array
                                                (
                                                    [0] => FXG
                                                )

                                            [description] => FedEx Ground
                                            [astraDescription] => FXG
                                        )

                                    [packagingDescription] => Customer Packaging
                                    [operationalDetail] => stdClass Object
                                        (
                                            [originLocationNumber] => 386
                                            [destinationLocationNumber] => 752
                                            [deliveryDate] => 2023-01-31
                                            [deliveryDay] => TUE
                                            [ineligibleForMoneyBackGuarantee] => 
                                            [serviceCode] => 92
                                            [packagingCode] => 01
                                            [deliveryEligibilities] => Array
                                                (
                                                    [0] => SATURDAY_DELIVERY
                                                )

                                            [transitTime] => TWO_DAYS
                                            [publishedDeliveryTime] => 
                                            [scac] => 
                                        )

                                    [shipmentRating] => stdClass Object
                                        (
                                            [actualRateType] => PAYOR_ACCOUNT_PACKAGE
                                            [shipmentRateDetails] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [rateType] => PAYOR_ACCOUNT_PACKAGE
                                                            [rateScale] => 
                                                            [rateZone] => 4
                                                            [ratedWeightMethod] => ACTUAL
                                                            [dimDivisor] => 0
                                                            [fuelSurchargePercent] => 5.5
                                                            [totalBillingWeight] => stdClass Object
                                                                (
                                                                    [units] => LB
                                                                    [value] => 1
                                                                )

                                                            [totalBaseCharge] => 11.46
                                                            [totalFreightDiscounts] => 0
                                                            [totalNetFreight] => 11.46
                                                            [totalSurcharges] => 1.68
                                                            [totalNetFedExCharge] => 13.14
                                                            [totalTaxes] => 0
                                                            [totalNetCharge] => 13.14
                                                            [totalRebates] => 0
                                                            [totalDutiesAndTaxes] => 0
                                                            [totalAncillaryFeesAndTaxes] => 0
                                                            [totalDutiesTaxesAndFees] => 0
                                                            [totalNetChargeWithDutiesAndTaxes] => 0
                                                            [surcharges] => Array
                                                                (
                                                                    [0] => stdClass Object
                                                                        (
                                                                            [surchargeType] => RETURN_LABEL
                                                                            [level] => PACKAGE
                                                                            [description] => Printed return label
                                                                            [amount] => 1.05
                                                                        )

                                                                    [1] => stdClass Object
                                                                        (
                                                                            [surchargeType] => FUEL
                                                                            [level] => PACKAGE
                                                                            [description] => FedEx Ground Fuel
                                                                            [amount] => 0.63
                                                                        )

                                                                )

                                                            [freightDiscounts] => Array
                                                                (
                                                                )

                                                            [taxes] => Array
                                                                (
                                                                )

                                                            [currency] => USD
                                                        )

                                                )

                                        )

                                    [completedPackageDetails] => Array
                                        (
                                            [0] => stdClass Object
                                                (
                                                    [sequenceNumber] => 1
                                                    [trackingIds] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [trackingIdType] => FEDEX
                                                                    [trackingNumber] => 794607989058
                                                                )

                                                        )

                                                    [groupNumber] => 0
                                                    [packageRating] => stdClass Object
                                                        (
                                                            [actualRateType] => PAYOR_ACCOUNT_PACKAGE
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetails] => Array
                                                                (
                                                                    [0] => stdClass Object
                                                                        (
                                                                            [rateType] => PAYOR_ACCOUNT_PACKAGE
                                                                            [ratedWeightMethod] => ACTUAL
                                                                            [minimumChargeType] => 
                                                                            [billingWeight] => stdClass Object
                                                                                (
                                                                                    [units] => LB
                                                                                    [value] => 1
                                                                                )

                                                                            [baseCharge] => 11.46
                                                                            [totalFreightDiscounts] => 0
                                                                            [netFreight] => 11.46
                                                                            [totalSurcharges] => 1.68
                                                                            [netFedExCharge] => 13.14
                                                                            [totalTaxes] => 0
                                                                            [netCharge] => 13.14
                                                                            [totalRebates] => 0
                                                                            [surcharges] => Array
                                                                                (
                                                                                    [0] => stdClass Object
                                                                                        (
                                                                                            [surchargeType] => RETURN_LABEL
                                                                                            [level] => PACKAGE
                                                                                            [description] => Printed return label
                                                                                            [amount] => 1.05
                                                                                        )

                                                                                    [1] => stdClass Object
                                                                                        (
                                                                                            [surchargeType] => FUEL
                                                                                            [level] => PACKAGE
                                                                                            [description] => FedEx Ground Fuel
                                                                                            [amount] => 0.63
                                                                                        )

                                                                                )

                                                                            [currency] => USD
                                                                        )

                                                                )

                                                        )

                                                    [signatureOption] => SERVICE_DEFAULT
                                                    [operationalDetail] => stdClass Object
                                                        (
                                                            [barcodes] => stdClass Object
                                                                (
                                                                    [binaryBarcodes] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => COMMON_2D
                                                                                    [value] => Wyk+HjAxHTAyNzUwNjMdODQwHTEzNx03OTQ2MDc5ODkwNTgdRkRFRx00OTEwMjIxHTAyNx0dMS8xHTEuMDBMQh1OHVJFQ0lQSUVOVCBTVFJFRVQgTElORSAxHUlydmluZx1UWB1SRUNFSVBJRU5UIE5BTUUeMDYdMTBaR0QwMDkdMTJaMTIzNDU2Nzg5MB0yMFocHTMxWjk2MjIwMTM3MDAwMDQ5MTAyMjEzMDA3OTQ2MDc5ODkwNTgdMzRaMDEdHgQ=
                                                                                )

                                                                        )

                                                                    [stringBarcodes] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FEDEX_1D
                                                                                    [value] => 9622013700004910221300794607989058
                                                                                )

                                                                        )

                                                                )

                                                            [astraHandlingText] => 
                                                            [operationalInstructions] => Array
                                                                (
                                                                    [0] => stdClass Object
                                                                        (
                                                                            [number] => 2
                                                                            [content] => TRK#
                                                                        )

                                                                    [1] => stdClass Object
                                                                        (
                                                                            [number] => 7
                                                                            [content] => 9622013700004910221300794607989058
                                                                        )

                                                                    [2] => stdClass Object
                                                                        (
                                                                            [number] => 8
                                                                            [content] => 581J2/D297/FE2D
                                                                        )

                                                                    [3] => stdClass Object
                                                                        (
                                                                            [number] => 10
                                                                            [content] => 7946 0798 9058
                                                                        )

                                                                    [4] => stdClass Object
                                                                        (
                                                                            [number] => 12
                                                                            [content] => RETURN
                                                                        )

                                                                    [5] => stdClass Object
                                                                        (
                                                                            [number] => 15
                                                                            [content] => 75063
                                                                        )

                                                                    [6] => stdClass Object
                                                                        (
                                                                            [number] => 18
                                                                            [content] => 9622 0137 0 (000 000 0000) 0 00 7946 0798 9058
                                                                        )

                                                                )

                                                        )

                                                )

                                        )

                                )

                            [serviceCategory] => GROUND
                        )

                )

        )

)
```
</details>

#### Create Rates Request
###### Example
```php
$request = (new CreateRatesRequest)
            ->setAccessToken((string)$this->auth->authorize()->access_token)
            ->setAccountNumber(740561073)
            ->setRateRequestTypes('ACCOUNT', 'LIST')
            ->setPickupType(PickupType::_DROPOFF_AT_FEDEX_LOCATION)
            ->setShipper(
                (new Person)
                    ->withAddress(
                        (new Address())
                            ->setPostalCode('38017')
                            ->setCountryCode('US')
                    )
            )
            ->setRecipient(
                (new Person)
                    ->withAddress(
                        (new Address())
                            ->setPostalCode('75063')
                            ->setCountryCode('US')
                    )
            )
            ->setLineItems((new Item())
                ->setWeight(
                    (new Weight())
                        ->setValue(1)
                        ->setUnit(WeightUnits::_POUND)
                )
            )
            ->request();
```
###### Sample Response
<details>
  <summary>Show Response</summary>

```php
stdClass Object
(
    [transactionId] => APIF_SV_RATC_TxID206ab89d-6825-40b2-844f-dd81d1b41129
    [customerTransactionId] => customer test
    [output] => stdClass Object
        (
            [alerts] => Array
                (
                    [0] => stdClass Object
                        (
                            [code] => VIRTUAL.RESPONSE
                            [message] => This is a Virtual Response.
                            [alertType] => NOTE
                        )

                    [1] => stdClass Object
                        (
                            [code] => ORIGIN.STATEORPROVINCECODE.CHANGED
                            [message] => The origin state/province code has been changed.
                            [alertType] => NOTE
                        )

                    [2] => stdClass Object
                        (
                            [code] => DESTINATION.STATEORPROVINCECODE.CHANGED
                            [message] => The destination state/province code has been changed.
                            [alertType] => NOTE
                        )

                )

            [rateReplyDetails] => Array
                (
                    [0] => stdClass Object
                        (
                            [serviceType] => FIRST_OVERNIGHT
                            [serviceName] => FedEx First Overnight®
                            [packagingType] => YOUR_PACKAGING
                            [ratedShipmentDetails] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [rateType] => ACCOUNT
                                            [ratedWeightMethod] => ACTUAL
                                            [totalDiscounts] => 0
                                            [totalBaseCharge] => 114.39
                                            [totalNetCharge] => 131.55
                                            [totalNetFedExCharge] => 131.55
                                            [shipmentRateDetail] => stdClass Object
                                                (
                                                    [rateZone] => 06
                                                    [dimDivisor] => 0
                                                    [fuelSurchargePercent] => 15
                                                    [totalSurcharges] => 17.16
                                                    [totalFreightDiscount] => 0
                                                    [surCharges] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [type] => FUEL
                                                                    [description] => Fuel Surcharge
                                                                    [amount] => 17.16
                                                                )

                                                        )

                                                    [pricingCode] => PACKAGE
                                                    [totalBillingWeight] => stdClass Object
                                                        (
                                                            [units] => LB
                                                            [value] => 1
                                                        )

                                                    [currency] => USD
                                                    [rateScale] => 14
                                                )

                                            [ratedPackages] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [groupNumber] => 0
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetail] => stdClass Object
                                                                (
                                                                    [rateType] => PAYOR_ACCOUNT_PACKAGE
                                                                    [ratedWeightMethod] => ACTUAL
                                                                    [baseCharge] => 114.39
                                                                    [netFreight] => 114.39
                                                                    [totalSurcharges] => 17.16
                                                                    [netFedExCharge] => 131.55
                                                                    [totalTaxes] => 0
                                                                    [netCharge] => 131.55
                                                                    [totalRebates] => 0
                                                                    [billingWeight] => stdClass Object
                                                                        (
                                                                            [units] => LB
                                                                            [value] => 1
                                                                        )

                                                                    [totalFreightDiscounts] => 0
                                                                    [surcharges] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FUEL
                                                                                    [description] => Fuel Surcharge
                                                                                    [amount] => 17.16
                                                                                )

                                                                        )

                                                                    [currency] => USD
                                                                )

                                                        )

                                                )

                                            [currency] => USD
                                        )

                                    [1] => stdClass Object
                                        (
                                            [rateType] => LIST
                                            [ratedWeightMethod] => ACTUAL
                                            [totalDiscounts] => 0
                                            [totalBaseCharge] => 114.39
                                            [totalNetCharge] => 131.55
                                            [totalNetFedExCharge] => 131.55
                                            [shipmentRateDetail] => stdClass Object
                                                (
                                                    [rateZone] => 06
                                                    [dimDivisor] => 0
                                                    [fuelSurchargePercent] => 15
                                                    [totalSurcharges] => 17.16
                                                    [totalFreightDiscount] => 0
                                                    [surCharges] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [type] => FUEL
                                                                    [description] => Fuel Surcharge
                                                                    [amount] => 17.16
                                                                )

                                                        )

                                                    [pricingCode] => PACKAGE
                                                    [totalBillingWeight] => stdClass Object
                                                        (
                                                            [units] => LB
                                                            [value] => 1
                                                        )

                                                    [currency] => USD
                                                    [rateScale] => 14
                                                )

                                            [ratedPackages] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [groupNumber] => 0
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetail] => stdClass Object
                                                                (
                                                                    [rateType] => PAYOR_LIST_PACKAGE
                                                                    [ratedWeightMethod] => ACTUAL
                                                                    [baseCharge] => 114.39
                                                                    [netFreight] => 114.39
                                                                    [totalSurcharges] => 17.16
                                                                    [netFedExCharge] => 131.55
                                                                    [totalTaxes] => 0
                                                                    [netCharge] => 131.55
                                                                    [totalRebates] => 0
                                                                    [billingWeight] => stdClass Object
                                                                        (
                                                                            [units] => LB
                                                                            [value] => 1
                                                                        )

                                                                    [totalFreightDiscounts] => 0
                                                                    [surcharges] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FUEL
                                                                                    [description] => Fuel Surcharge
                                                                                    [amount] => 17.16
                                                                                )

                                                                        )

                                                                    [currency] => USD
                                                                )

                                                        )

                                                )

                                            [currency] => USD
                                        )

                                )

                            [operationalDetail] => stdClass Object
                                (
                                    [ineligibleForMoneyBackGuarantee] => 
                                    [astraDescription] => 1ST OVR
                                    [airportId] => EWR
                                    [serviceCode] => 06
                                )

                            [signatureOptionType] => SERVICE_DEFAULT
                            [serviceDescription] => stdClass Object
                                (
                                    [serviceId] => EP1000000006
                                    [serviceType] => FIRST_OVERNIGHT
                                    [code] => 06
                                    [names] => Array
                                        (
                                            [0] => stdClass Object
                                                (
                                                    [type] => long
                                                    [encoding] => utf-8
                                                    [value] => FedEx First Overnight®
                                                )

                                            [1] => stdClass Object
                                                (
                                                    [type] => long
                                                    [encoding] => ascii
                                                    [value] => FedEx First Overnight
                                                )

                                            [2] => stdClass Object
                                                (
                                                    [type] => medium
                                                    [encoding] => utf-8
                                                    [value] => FedEx First Overnight®
                                                )

                                            [3] => stdClass Object
                                                (
                                                    [type] => medium
                                                    [encoding] => ascii
                                                    [value] => FedEx First Overnight
                                                )

                                            [4] => stdClass Object
                                                (
                                                    [type] => short
                                                    [encoding] => utf-8
                                                    [value] => FO
                                                )

                                            [5] => stdClass Object
                                                (
                                                    [type] => short
                                                    [encoding] => ascii
                                                    [value] => FO
                                                )

                                            [6] => stdClass Object
                                                (
                                                    [type] => abbrv
                                                    [encoding] => ascii
                                                    [value] => FO
                                                )

                                        )

                                    [serviceCategory] => parcel
                                    [description] => First Overnight
                                    [astraDescription] => 1ST OVR
                                )

                        )

                    [1] => stdClass Object
                        (
                            [serviceType] => PRIORITY_OVERNIGHT
                            [serviceName] => FedEx Priority Overnight®
                            [packagingType] => YOUR_PACKAGING
                            [ratedShipmentDetails] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [rateType] => ACCOUNT
                                            [ratedWeightMethod] => ACTUAL
                                            [totalDiscounts] => 0
                                            [totalBaseCharge] => 83.39
                                            [totalNetCharge] => 95.9
                                            [totalNetFedExCharge] => 95.9
                                            [shipmentRateDetail] => stdClass Object
                                                (
                                                    [rateZone] => 06
                                                    [dimDivisor] => 0
                                                    [fuelSurchargePercent] => 15
                                                    [totalSurcharges] => 12.51
                                                    [totalFreightDiscount] => 0
                                                    [surCharges] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [type] => FUEL
                                                                    [description] => Fuel Surcharge
                                                                    [amount] => 12.51
                                                                )

                                                        )

                                                    [pricingCode] => PACKAGE
                                                    [totalBillingWeight] => stdClass Object
                                                        (
                                                            [units] => LB
                                                            [value] => 1
                                                        )

                                                    [currency] => USD
                                                    [rateScale] => 1574
                                                )

                                            [ratedPackages] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [groupNumber] => 0
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetail] => stdClass Object
                                                                (
                                                                    [rateType] => PAYOR_ACCOUNT_PACKAGE
                                                                    [ratedWeightMethod] => ACTUAL
                                                                    [baseCharge] => 83.39
                                                                    [netFreight] => 83.39
                                                                    [totalSurcharges] => 12.51
                                                                    [netFedExCharge] => 95.9
                                                                    [totalTaxes] => 0
                                                                    [netCharge] => 95.9
                                                                    [totalRebates] => 0
                                                                    [billingWeight] => stdClass Object
                                                                        (
                                                                            [units] => LB
                                                                            [value] => 1
                                                                        )

                                                                    [totalFreightDiscounts] => 0
                                                                    [surcharges] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FUEL
                                                                                    [description] => Fuel Surcharge
                                                                                    [amount] => 12.51
                                                                                )

                                                                        )

                                                                    [currency] => USD
                                                                )

                                                        )

                                                )

                                            [currency] => USD
                                        )

                                    [1] => stdClass Object
                                        (
                                            [rateType] => LIST
                                            [ratedWeightMethod] => ACTUAL
                                            [totalDiscounts] => 0
                                            [totalBaseCharge] => 83.39
                                            [totalNetCharge] => 95.9
                                            [totalNetFedExCharge] => 95.9
                                            [shipmentRateDetail] => stdClass Object
                                                (
                                                    [rateZone] => 06
                                                    [dimDivisor] => 0
                                                    [fuelSurchargePercent] => 15
                                                    [totalSurcharges] => 12.51
                                                    [totalFreightDiscount] => 0
                                                    [surCharges] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [type] => FUEL
                                                                    [description] => Fuel Surcharge
                                                                    [amount] => 12.51
                                                                )

                                                        )

                                                    [pricingCode] => PACKAGE
                                                    [totalBillingWeight] => stdClass Object
                                                        (
                                                            [units] => LB
                                                            [value] => 1
                                                        )

                                                    [currency] => USD
                                                    [rateScale] => 1574
                                                )

                                            [ratedPackages] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [groupNumber] => 0
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetail] => stdClass Object
                                                                (
                                                                    [rateType] => PAYOR_LIST_PACKAGE
                                                                    [ratedWeightMethod] => ACTUAL
                                                                    [baseCharge] => 83.39
                                                                    [netFreight] => 83.39
                                                                    [totalSurcharges] => 12.51
                                                                    [netFedExCharge] => 95.9
                                                                    [totalTaxes] => 0
                                                                    [netCharge] => 95.9
                                                                    [totalRebates] => 0
                                                                    [billingWeight] => stdClass Object
                                                                        (
                                                                            [units] => LB
                                                                            [value] => 1
                                                                        )

                                                                    [totalFreightDiscounts] => 0
                                                                    [surcharges] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FUEL
                                                                                    [description] => Fuel Surcharge
                                                                                    [amount] => 12.51
                                                                                )

                                                                        )

                                                                    [currency] => USD
                                                                )

                                                        )

                                                )

                                            [currency] => USD
                                        )

                                )

                            [operationalDetail] => stdClass Object
                                (
                                    [ineligibleForMoneyBackGuarantee] => 
                                    [astraDescription] => P1
                                    [airportId] => EWR
                                    [serviceCode] => 01
                                )

                            [signatureOptionType] => SERVICE_DEFAULT
                            [serviceDescription] => stdClass Object
                                (
                                    [serviceId] => EP1000000002
                                    [serviceType] => PRIORITY_OVERNIGHT
                                    [code] => 01
                                    [names] => Array
                                        (
                                            [0] => stdClass Object
                                                (
                                                    [type] => long
                                                    [encoding] => utf-8
                                                    [value] => FedEx Priority Overnight®
                                                )

                                            [1] => stdClass Object
                                                (
                                                    [type] => long
                                                    [encoding] => ascii
                                                    [value] => FedEx Priority Overnight
                                                )

                                            [2] => stdClass Object
                                                (
                                                    [type] => medium
                                                    [encoding] => utf-8
                                                    [value] => FedEx Priority Overnight®
                                                )

                                            [3] => stdClass Object
                                                (
                                                    [type] => medium
                                                    [encoding] => ascii
                                                    [value] => FedEx Priority Overnight
                                                )

                                            [4] => stdClass Object
                                                (
                                                    [type] => short
                                                    [encoding] => utf-8
                                                    [value] => P-1
                                                )

                                            [5] => stdClass Object
                                                (
                                                    [type] => short
                                                    [encoding] => ascii
                                                    [value] => P-1
                                                )

                                            [6] => stdClass Object
                                                (
                                                    [type] => abbrv
                                                    [encoding] => ascii
                                                    [value] => PO
                                                )

                                        )

                                    [serviceCategory] => parcel
                                    [description] => Priority Overnight
                                    [astraDescription] => P1
                                )

                        )

                    [2] => stdClass Object
                        (
                            [serviceType] => STANDARD_OVERNIGHT
                            [serviceName] => FedEx Standard Overnight®
                            [packagingType] => YOUR_PACKAGING
                            [ratedShipmentDetails] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [rateType] => ACCOUNT
                                            [ratedWeightMethod] => ACTUAL
                                            [totalDiscounts] => 0
                                            [totalBaseCharge] => 74.56
                                            [totalNetCharge] => 85.74
                                            [totalNetFedExCharge] => 85.74
                                            [shipmentRateDetail] => stdClass Object
                                                (
                                                    [rateZone] => 06
                                                    [dimDivisor] => 0
                                                    [fuelSurchargePercent] => 15
                                                    [totalSurcharges] => 11.18
                                                    [totalFreightDiscount] => 0
                                                    [surCharges] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [type] => FUEL
                                                                    [description] => Fuel Surcharge
                                                                    [amount] => 11.18
                                                                )

                                                        )

                                                    [pricingCode] => PACKAGE
                                                    [totalBillingWeight] => stdClass Object
                                                        (
                                                            [units] => LB
                                                            [value] => 1
                                                        )

                                                    [currency] => USD
                                                    [rateScale] => 1371
                                                )

                                            [ratedPackages] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [groupNumber] => 0
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetail] => stdClass Object
                                                                (
                                                                    [rateType] => PAYOR_ACCOUNT_PACKAGE
                                                                    [ratedWeightMethod] => ACTUAL
                                                                    [baseCharge] => 74.56
                                                                    [netFreight] => 74.56
                                                                    [totalSurcharges] => 11.18
                                                                    [netFedExCharge] => 85.74
                                                                    [totalTaxes] => 0
                                                                    [netCharge] => 85.74
                                                                    [totalRebates] => 0
                                                                    [billingWeight] => stdClass Object
                                                                        (
                                                                            [units] => LB
                                                                            [value] => 1
                                                                        )

                                                                    [totalFreightDiscounts] => 0
                                                                    [surcharges] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FUEL
                                                                                    [description] => Fuel Surcharge
                                                                                    [amount] => 11.18
                                                                                )

                                                                        )

                                                                    [currency] => USD
                                                                )

                                                        )

                                                )

                                            [currency] => USD
                                        )

                                    [1] => stdClass Object
                                        (
                                            [rateType] => LIST
                                            [ratedWeightMethod] => ACTUAL
                                            [totalDiscounts] => 0
                                            [totalBaseCharge] => 74.56
                                            [totalNetCharge] => 85.74
                                            [totalNetFedExCharge] => 85.74
                                            [shipmentRateDetail] => stdClass Object
                                                (
                                                    [rateZone] => 06
                                                    [dimDivisor] => 0
                                                    [fuelSurchargePercent] => 15
                                                    [totalSurcharges] => 11.18
                                                    [totalFreightDiscount] => 0
                                                    [surCharges] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [type] => FUEL
                                                                    [description] => Fuel Surcharge
                                                                    [amount] => 11.18
                                                                )

                                                        )

                                                    [pricingCode] => PACKAGE
                                                    [totalBillingWeight] => stdClass Object
                                                        (
                                                            [units] => LB
                                                            [value] => 1
                                                        )

                                                    [currency] => USD
                                                    [rateScale] => 1371
                                                )

                                            [ratedPackages] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [groupNumber] => 0
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetail] => stdClass Object
                                                                (
                                                                    [rateType] => PAYOR_LIST_PACKAGE
                                                                    [ratedWeightMethod] => ACTUAL
                                                                    [baseCharge] => 74.56
                                                                    [netFreight] => 74.56
                                                                    [totalSurcharges] => 11.18
                                                                    [netFedExCharge] => 85.74
                                                                    [totalTaxes] => 0
                                                                    [netCharge] => 85.74
                                                                    [totalRebates] => 0
                                                                    [billingWeight] => stdClass Object
                                                                        (
                                                                            [units] => LB
                                                                            [value] => 1
                                                                        )

                                                                    [totalFreightDiscounts] => 0
                                                                    [surcharges] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FUEL
                                                                                    [description] => Fuel Surcharge
                                                                                    [amount] => 11.18
                                                                                )

                                                                        )

                                                                    [currency] => USD
                                                                )

                                                        )

                                                )

                                            [currency] => USD
                                        )

                                )

                            [operationalDetail] => stdClass Object
                                (
                                    [ineligibleForMoneyBackGuarantee] => 
                                    [astraDescription] => STD OVR
                                    [airportId] => EWR
                                    [serviceCode] => 05
                                )

                            [signatureOptionType] => SERVICE_DEFAULT
                            [serviceDescription] => stdClass Object
                                (
                                    [serviceId] => EP1000000005
                                    [serviceType] => STANDARD_OVERNIGHT
                                    [code] => 05
                                    [names] => Array
                                        (
                                            [0] => stdClass Object
                                                (
                                                    [type] => long
                                                    [encoding] => utf-8
                                                    [value] => FedEx Standard Overnight®
                                                )

                                            [1] => stdClass Object
                                                (
                                                    [type] => long
                                                    [encoding] => ascii
                                                    [value] => FedEx Standard Overnight
                                                )

                                            [2] => stdClass Object
                                                (
                                                    [type] => medium
                                                    [encoding] => utf-8
                                                    [value] => FedEx Standard Overnight®
                                                )

                                            [3] => stdClass Object
                                                (
                                                    [type] => medium
                                                    [encoding] => ascii
                                                    [value] => FedEx Standard Overnight
                                                )

                                            [4] => stdClass Object
                                                (
                                                    [type] => short
                                                    [encoding] => utf-8
                                                    [value] => SOS
                                                )

                                            [5] => stdClass Object
                                                (
                                                    [type] => short
                                                    [encoding] => ascii
                                                    [value] => SOS
                                                )

                                            [6] => stdClass Object
                                                (
                                                    [type] => abbrv
                                                    [encoding] => ascii
                                                    [value] => SO
                                                )

                                        )

                                    [serviceCategory] => parcel
                                    [description] => Standard Overnight
                                    [astraDescription] => STD OVR
                                )

                        )

                    [3] => stdClass Object
                        (
                            [serviceType] => FEDEX_2_DAY_AM
                            [serviceName] => FedEx 2Day® AM
                            [packagingType] => YOUR_PACKAGING
                            [ratedShipmentDetails] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [rateType] => ACCOUNT
                                            [ratedWeightMethod] => ACTUAL
                                            [totalDiscounts] => 0
                                            [totalBaseCharge] => 41.46
                                            [totalNetCharge] => 47.68
                                            [totalNetFedExCharge] => 47.68
                                            [shipmentRateDetail] => stdClass Object
                                                (
                                                    [rateZone] => 06
                                                    [dimDivisor] => 0
                                                    [fuelSurchargePercent] => 15
                                                    [totalSurcharges] => 6.22
                                                    [totalFreightDiscount] => 0
                                                    [surCharges] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [type] => FUEL
                                                                    [description] => Fuel Surcharge
                                                                    [amount] => 6.22
                                                                )

                                                        )

                                                    [pricingCode] => PACKAGE
                                                    [totalBillingWeight] => stdClass Object
                                                        (
                                                            [units] => LB
                                                            [value] => 1
                                                        )

                                                    [currency] => USD
                                                    [rateScale] => 12
                                                )

                                            [ratedPackages] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [groupNumber] => 0
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetail] => stdClass Object
                                                                (
                                                                    [rateType] => PAYOR_ACCOUNT_PACKAGE
                                                                    [ratedWeightMethod] => ACTUAL
                                                                    [baseCharge] => 41.46
                                                                    [netFreight] => 41.46
                                                                    [totalSurcharges] => 6.22
                                                                    [netFedExCharge] => 47.68
                                                                    [totalTaxes] => 0
                                                                    [netCharge] => 47.68
                                                                    [totalRebates] => 0
                                                                    [billingWeight] => stdClass Object
                                                                        (
                                                                            [units] => LB
                                                                            [value] => 1
                                                                        )

                                                                    [totalFreightDiscounts] => 0
                                                                    [surcharges] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FUEL
                                                                                    [description] => Fuel Surcharge
                                                                                    [amount] => 6.22
                                                                                )

                                                                        )

                                                                    [currency] => USD
                                                                )

                                                        )

                                                )

                                            [currency] => USD
                                        )

                                    [1] => stdClass Object
                                        (
                                            [rateType] => LIST
                                            [ratedWeightMethod] => ACTUAL
                                            [totalDiscounts] => 0
                                            [totalBaseCharge] => 41.46
                                            [totalNetCharge] => 47.68
                                            [totalNetFedExCharge] => 47.68
                                            [shipmentRateDetail] => stdClass Object
                                                (
                                                    [rateZone] => 06
                                                    [dimDivisor] => 0
                                                    [fuelSurchargePercent] => 15
                                                    [totalSurcharges] => 6.22
                                                    [totalFreightDiscount] => 0
                                                    [surCharges] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [type] => FUEL
                                                                    [description] => Fuel Surcharge
                                                                    [amount] => 6.22
                                                                )

                                                        )

                                                    [pricingCode] => PACKAGE
                                                    [totalBillingWeight] => stdClass Object
                                                        (
                                                            [units] => LB
                                                            [value] => 1
                                                        )

                                                    [currency] => USD
                                                    [rateScale] => 12
                                                )

                                            [ratedPackages] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [groupNumber] => 0
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetail] => stdClass Object
                                                                (
                                                                    [rateType] => PAYOR_LIST_PACKAGE
                                                                    [ratedWeightMethod] => ACTUAL
                                                                    [baseCharge] => 41.46
                                                                    [netFreight] => 41.46
                                                                    [totalSurcharges] => 6.22
                                                                    [netFedExCharge] => 47.68
                                                                    [totalTaxes] => 0
                                                                    [netCharge] => 47.68
                                                                    [totalRebates] => 0
                                                                    [billingWeight] => stdClass Object
                                                                        (
                                                                            [units] => LB
                                                                            [value] => 1
                                                                        )

                                                                    [totalFreightDiscounts] => 0
                                                                    [surcharges] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FUEL
                                                                                    [description] => Fuel Surcharge
                                                                                    [amount] => 6.22
                                                                                )

                                                                        )

                                                                    [currency] => USD
                                                                )

                                                        )

                                                )

                                            [currency] => USD
                                        )

                                )

                            [operationalDetail] => stdClass Object
                                (
                                    [ineligibleForMoneyBackGuarantee] => 
                                    [astraDescription] => 2DAY AM
                                    [airportId] => EWR
                                    [serviceCode] => 49
                                )

                            [signatureOptionType] => SERVICE_DEFAULT
                            [serviceDescription] => stdClass Object
                                (
                                    [serviceId] => EP1000000023
                                    [serviceType] => FEDEX_2_DAY_AM
                                    [code] => 49
                                    [names] => Array
                                        (
                                            [0] => stdClass Object
                                                (
                                                    [type] => long
                                                    [encoding] => utf-8
                                                    [value] => FedEx 2Day® AM
                                                )

                                            [1] => stdClass Object
                                                (
                                                    [type] => long
                                                    [encoding] => ascii
                                                    [value] => FedEx 2Day AM
                                                )

                                            [2] => stdClass Object
                                                (
                                                    [type] => medium
                                                    [encoding] => utf-8
                                                    [value] => FedEx 2Day® AM
                                                )

                                            [3] => stdClass Object
                                                (
                                                    [type] => medium
                                                    [encoding] => ascii
                                                    [value] => FedEx 2Day AM
                                                )

                                            [4] => stdClass Object
                                                (
                                                    [type] => short
                                                    [encoding] => utf-8
                                                    [value] => E2AM
                                                )

                                            [5] => stdClass Object
                                                (
                                                    [type] => short
                                                    [encoding] => ascii
                                                    [value] => E2AM
                                                )

                                            [6] => stdClass Object
                                                (
                                                    [type] => abbrv
                                                    [encoding] => ascii
                                                    [value] => TA
                                                )

                                        )

                                    [serviceCategory] => parcel
                                    [description] => 2DAY AM
                                    [astraDescription] => 2DAY AM
                                )

                        )

                    [4] => stdClass Object
                        (
                            [serviceType] => FEDEX_2_DAY
                            [serviceName] => FedEx 2Day®
                            [packagingType] => YOUR_PACKAGING
                            [ratedShipmentDetails] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [rateType] => ACCOUNT
                                            [ratedWeightMethod] => ACTUAL
                                            [totalDiscounts] => 0
                                            [totalBaseCharge] => 34.5
                                            [totalNetCharge] => 39.68
                                            [totalNetFedExCharge] => 39.68
                                            [shipmentRateDetail] => stdClass Object
                                                (
                                                    [rateZone] => 06
                                                    [dimDivisor] => 0
                                                    [fuelSurchargePercent] => 15
                                                    [totalSurcharges] => 5.18
                                                    [totalFreightDiscount] => 0
                                                    [surCharges] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [type] => FUEL
                                                                    [description] => Fuel Surcharge
                                                                    [amount] => 5.18
                                                                )

                                                        )

                                                    [pricingCode] => PACKAGE
                                                    [totalBillingWeight] => stdClass Object
                                                        (
                                                            [units] => LB
                                                            [value] => 1
                                                        )

                                                    [currency] => USD
                                                    [rateScale] => 6068
                                                )

                                            [ratedPackages] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [groupNumber] => 0
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetail] => stdClass Object
                                                                (
                                                                    [rateType] => PAYOR_ACCOUNT_PACKAGE
                                                                    [ratedWeightMethod] => ACTUAL
                                                                    [baseCharge] => 34.5
                                                                    [netFreight] => 34.5
                                                                    [totalSurcharges] => 5.18
                                                                    [netFedExCharge] => 39.68
                                                                    [totalTaxes] => 0
                                                                    [netCharge] => 39.68
                                                                    [totalRebates] => 0
                                                                    [billingWeight] => stdClass Object
                                                                        (
                                                                            [units] => LB
                                                                            [value] => 1
                                                                        )

                                                                    [totalFreightDiscounts] => 0
                                                                    [surcharges] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FUEL
                                                                                    [description] => Fuel Surcharge
                                                                                    [amount] => 5.18
                                                                                )

                                                                        )

                                                                    [currency] => USD
                                                                )

                                                        )

                                                )

                                            [currency] => USD
                                        )

                                    [1] => stdClass Object
                                        (
                                            [rateType] => LIST
                                            [ratedWeightMethod] => ACTUAL
                                            [totalDiscounts] => 0
                                            [totalBaseCharge] => 34.5
                                            [totalNetCharge] => 39.68
                                            [totalNetFedExCharge] => 39.68
                                            [shipmentRateDetail] => stdClass Object
                                                (
                                                    [rateZone] => 06
                                                    [dimDivisor] => 0
                                                    [fuelSurchargePercent] => 15
                                                    [totalSurcharges] => 5.18
                                                    [totalFreightDiscount] => 0
                                                    [surCharges] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [type] => FUEL
                                                                    [description] => Fuel Surcharge
                                                                    [amount] => 5.18
                                                                )

                                                        )

                                                    [pricingCode] => PACKAGE
                                                    [totalBillingWeight] => stdClass Object
                                                        (
                                                            [units] => LB
                                                            [value] => 1
                                                        )

                                                    [currency] => USD
                                                    [rateScale] => 6068
                                                )

                                            [ratedPackages] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [groupNumber] => 0
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetail] => stdClass Object
                                                                (
                                                                    [rateType] => PAYOR_LIST_PACKAGE
                                                                    [ratedWeightMethod] => ACTUAL
                                                                    [baseCharge] => 34.5
                                                                    [netFreight] => 34.5
                                                                    [totalSurcharges] => 5.18
                                                                    [netFedExCharge] => 39.68
                                                                    [totalTaxes] => 0
                                                                    [netCharge] => 39.68
                                                                    [totalRebates] => 0
                                                                    [billingWeight] => stdClass Object
                                                                        (
                                                                            [units] => LB
                                                                            [value] => 1
                                                                        )

                                                                    [totalFreightDiscounts] => 0
                                                                    [surcharges] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FUEL
                                                                                    [description] => Fuel Surcharge
                                                                                    [amount] => 5.18
                                                                                )

                                                                        )

                                                                    [currency] => USD
                                                                )

                                                        )

                                                )

                                            [currency] => USD
                                        )

                                )

                            [operationalDetail] => stdClass Object
                                (
                                    [ineligibleForMoneyBackGuarantee] => 
                                    [astraDescription] => E2
                                    [airportId] => EWR
                                    [serviceCode] => 03
                                )

                            [signatureOptionType] => SERVICE_DEFAULT
                            [serviceDescription] => stdClass Object
                                (
                                    [serviceId] => EP1000000003
                                    [serviceType] => FEDEX_2_DAY
                                    [code] => 03
                                    [names] => Array
                                        (
                                            [0] => stdClass Object
                                                (
                                                    [type] => long
                                                    [encoding] => utf-8
                                                    [value] => FedEx 2Day®
                                                )

                                            [1] => stdClass Object
                                                (
                                                    [type] => long
                                                    [encoding] => ascii
                                                    [value] => FedEx 2Day
                                                )

                                            [2] => stdClass Object
                                                (
                                                    [type] => medium
                                                    [encoding] => utf-8
                                                    [value] => FedEx 2Day®
                                                )

                                            [3] => stdClass Object
                                                (
                                                    [type] => medium
                                                    [encoding] => ascii
                                                    [value] => FedEx 2Day
                                                )

                                            [4] => stdClass Object
                                                (
                                                    [type] => short
                                                    [encoding] => utf-8
                                                    [value] => P-2
                                                )

                                            [5] => stdClass Object
                                                (
                                                    [type] => short
                                                    [encoding] => ascii
                                                    [value] => P-2
                                                )

                                            [6] => stdClass Object
                                                (
                                                    [type] => abbrv
                                                    [encoding] => ascii
                                                    [value] => ES
                                                )

                                        )

                                    [serviceCategory] => parcel
                                    [description] => 2Day
                                    [astraDescription] => E2
                                )

                        )

                    [5] => stdClass Object
                        (
                            [serviceType] => FEDEX_EXPRESS_SAVER
                            [serviceName] => FedEx Express Saver®
                            [packagingType] => YOUR_PACKAGING
                            [ratedShipmentDetails] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [rateType] => ACCOUNT
                                            [ratedWeightMethod] => ACTUAL
                                            [totalDiscounts] => 0
                                            [totalBaseCharge] => 29.46
                                            [totalNetCharge] => 33.88
                                            [totalNetFedExCharge] => 33.88
                                            [shipmentRateDetail] => stdClass Object
                                                (
                                                    [rateZone] => 06
                                                    [dimDivisor] => 0
                                                    [fuelSurchargePercent] => 15
                                                    [totalSurcharges] => 4.42
                                                    [totalFreightDiscount] => 0
                                                    [surCharges] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [type] => FUEL
                                                                    [description] => Fuel Surcharge
                                                                    [amount] => 4.42
                                                                )

                                                        )

                                                    [pricingCode] => PACKAGE
                                                    [totalBillingWeight] => stdClass Object
                                                        (
                                                            [units] => LB
                                                            [value] => 1
                                                        )

                                                    [currency] => USD
                                                    [rateScale] => 7175
                                                )

                                            [ratedPackages] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [groupNumber] => 0
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetail] => stdClass Object
                                                                (
                                                                    [rateType] => PAYOR_ACCOUNT_PACKAGE
                                                                    [ratedWeightMethod] => ACTUAL
                                                                    [baseCharge] => 29.46
                                                                    [netFreight] => 29.46
                                                                    [totalSurcharges] => 4.42
                                                                    [netFedExCharge] => 33.88
                                                                    [totalTaxes] => 0
                                                                    [netCharge] => 33.88
                                                                    [totalRebates] => 0
                                                                    [billingWeight] => stdClass Object
                                                                        (
                                                                            [units] => LB
                                                                            [value] => 1
                                                                        )

                                                                    [totalFreightDiscounts] => 0
                                                                    [surcharges] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FUEL
                                                                                    [description] => Fuel Surcharge
                                                                                    [amount] => 4.42
                                                                                )

                                                                        )

                                                                    [currency] => USD
                                                                )

                                                        )

                                                )

                                            [currency] => USD
                                        )

                                    [1] => stdClass Object
                                        (
                                            [rateType] => LIST
                                            [ratedWeightMethod] => ACTUAL
                                            [totalDiscounts] => 0
                                            [totalBaseCharge] => 29.46
                                            [totalNetCharge] => 33.88
                                            [totalNetFedExCharge] => 33.88
                                            [shipmentRateDetail] => stdClass Object
                                                (
                                                    [rateZone] => 06
                                                    [dimDivisor] => 0
                                                    [fuelSurchargePercent] => 15
                                                    [totalSurcharges] => 4.42
                                                    [totalFreightDiscount] => 0
                                                    [surCharges] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [type] => FUEL
                                                                    [description] => Fuel Surcharge
                                                                    [amount] => 4.42
                                                                )

                                                        )

                                                    [pricingCode] => PACKAGE
                                                    [totalBillingWeight] => stdClass Object
                                                        (
                                                            [units] => LB
                                                            [value] => 1
                                                        )

                                                    [currency] => USD
                                                    [rateScale] => 7175
                                                )

                                            [ratedPackages] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [groupNumber] => 0
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetail] => stdClass Object
                                                                (
                                                                    [rateType] => PAYOR_LIST_PACKAGE
                                                                    [ratedWeightMethod] => ACTUAL
                                                                    [baseCharge] => 29.46
                                                                    [netFreight] => 29.46
                                                                    [totalSurcharges] => 4.42
                                                                    [netFedExCharge] => 33.88
                                                                    [totalTaxes] => 0
                                                                    [netCharge] => 33.88
                                                                    [totalRebates] => 0
                                                                    [billingWeight] => stdClass Object
                                                                        (
                                                                            [units] => LB
                                                                            [value] => 1
                                                                        )

                                                                    [totalFreightDiscounts] => 0
                                                                    [surcharges] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FUEL
                                                                                    [description] => Fuel Surcharge
                                                                                    [amount] => 4.42
                                                                                )

                                                                        )

                                                                    [currency] => USD
                                                                )

                                                        )

                                                )

                                            [currency] => USD
                                        )

                                )

                            [operationalDetail] => stdClass Object
                                (
                                    [ineligibleForMoneyBackGuarantee] => 
                                    [astraDescription] => XS
                                    [airportId] => EWR
                                    [serviceCode] => 20
                                )

                            [signatureOptionType] => SERVICE_DEFAULT
                            [serviceDescription] => stdClass Object
                                (
                                    [serviceId] => EP1000000013
                                    [serviceType] => FEDEX_EXPRESS_SAVER
                                    [code] => 20
                                    [names] => Array
                                        (
                                            [0] => stdClass Object
                                                (
                                                    [type] => long
                                                    [encoding] => utf-8
                                                    [value] => FedEx Express Saver®
                                                )

                                            [1] => stdClass Object
                                                (
                                                    [type] => long
                                                    [encoding] => ascii
                                                    [value] => FedEx Express Saver
                                                )

                                            [2] => stdClass Object
                                                (
                                                    [type] => medium
                                                    [encoding] => utf-8
                                                    [value] => FedEx Express Saver®
                                                )

                                            [3] => stdClass Object
                                                (
                                                    [type] => medium
                                                    [encoding] => ascii
                                                    [value] => FedEx Express Saver
                                                )

                                        )

                                    [serviceCategory] => parcel
                                    [description] => Express Saver
                                    [astraDescription] => XS
                                )

                        )

                    [6] => stdClass Object
                        (
                            [serviceType] => FEDEX_GROUND
                            [serviceName] => FedEx Ground®
                            [packagingType] => YOUR_PACKAGING
                            [ratedShipmentDetails] => Array
                                (
                                    [0] => stdClass Object
                                        (
                                            [rateType] => ACCOUNT
                                            [ratedWeightMethod] => ACTUAL
                                            [totalDiscounts] => 0
                                            [totalBaseCharge] => 12.38
                                            [totalNetCharge] => 14.14
                                            [totalNetFedExCharge] => 14.14
                                            [shipmentRateDetail] => stdClass Object
                                                (
                                                    [rateZone] => 6
                                                    [dimDivisor] => 0
                                                    [fuelSurchargePercent] => 14.25
                                                    [totalSurcharges] => 1.76
                                                    [totalFreightDiscount] => 0
                                                    [surCharges] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [type] => FUEL
                                                                    [description] => Fuel Surcharge
                                                                    [level] => PACKAGE
                                                                    [amount] => 1.76
                                                                )

                                                        )

                                                    [totalBillingWeight] => stdClass Object
                                                        (
                                                            [units] => LB
                                                            [value] => 1
                                                        )

                                                    [currency] => USD
                                                )

                                            [ratedPackages] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [groupNumber] => 0
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetail] => stdClass Object
                                                                (
                                                                    [rateType] => PAYOR_ACCOUNT_PACKAGE
                                                                    [ratedWeightMethod] => ACTUAL
                                                                    [baseCharge] => 12.38
                                                                    [netFreight] => 12.38
                                                                    [totalSurcharges] => 1.76
                                                                    [netFedExCharge] => 14.14
                                                                    [totalTaxes] => 0
                                                                    [netCharge] => 14.14
                                                                    [totalRebates] => 0
                                                                    [billingWeight] => stdClass Object
                                                                        (
                                                                            [units] => LB
                                                                            [value] => 1
                                                                        )

                                                                    [totalFreightDiscounts] => 0
                                                                    [surcharges] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FUEL
                                                                                    [description] => Fuel Surcharge
                                                                                    [level] => PACKAGE
                                                                                    [amount] => 1.76
                                                                                )

                                                                        )

                                                                    [currency] => USD
                                                                )

                                                        )

                                                )

                                            [currency] => USD
                                        )

                                    [1] => stdClass Object
                                        (
                                            [rateType] => LIST
                                            [ratedWeightMethod] => ACTUAL
                                            [totalDiscounts] => 0
                                            [totalBaseCharge] => 12.38
                                            [totalNetCharge] => 14.14
                                            [totalNetFedExCharge] => 14.14
                                            [shipmentRateDetail] => stdClass Object
                                                (
                                                    [rateZone] => 6
                                                    [dimDivisor] => 0
                                                    [fuelSurchargePercent] => 14.25
                                                    [totalSurcharges] => 1.76
                                                    [totalFreightDiscount] => 0
                                                    [surCharges] => Array
                                                        (
                                                            [0] => stdClass Object
                                                                (
                                                                    [type] => FUEL
                                                                    [description] => Fuel Surcharge
                                                                    [level] => PACKAGE
                                                                    [amount] => 1.76
                                                                )

                                                        )

                                                    [totalBillingWeight] => stdClass Object
                                                        (
                                                            [units] => LB
                                                            [value] => 1
                                                        )

                                                    [currency] => USD
                                                )

                                            [ratedPackages] => Array
                                                (
                                                    [0] => stdClass Object
                                                        (
                                                            [groupNumber] => 0
                                                            [effectiveNetDiscount] => 0
                                                            [packageRateDetail] => stdClass Object
                                                                (
                                                                    [rateType] => PAYOR_LIST_PACKAGE
                                                                    [ratedWeightMethod] => ACTUAL
                                                                    [baseCharge] => 12.38
                                                                    [netFreight] => 12.38
                                                                    [totalSurcharges] => 1.76
                                                                    [netFedExCharge] => 14.14
                                                                    [totalTaxes] => 0
                                                                    [netCharge] => 14.14
                                                                    [totalRebates] => 0
                                                                    [billingWeight] => stdClass Object
                                                                        (
                                                                            [units] => LB
                                                                            [value] => 1
                                                                        )

                                                                    [totalFreightDiscounts] => 0
                                                                    [surcharges] => Array
                                                                        (
                                                                            [0] => stdClass Object
                                                                                (
                                                                                    [type] => FUEL
                                                                                    [description] => Fuel Surcharge
                                                                                    [level] => PACKAGE
                                                                                    [amount] => 1.76
                                                                                )

                                                                        )

                                                                    [currency] => USD
                                                                )

                                                        )

                                                )

                                            [currency] => USD
                                        )

                                )

                            [operationalDetail] => stdClass Object
                                (
                                    [ineligibleForMoneyBackGuarantee] => 
                                    [astraDescription] => FXG
                                    [airportId] => EWR
                                    [serviceCode] => 92
                                )

                            [signatureOptionType] => SERVICE_DEFAULT
                            [serviceDescription] => stdClass Object
                                (
                                    [serviceId] => EP1000000134
                                    [serviceType] => FEDEX_GROUND
                                    [code] => 92
                                    [names] => Array
                                        (
                                            [0] => stdClass Object
                                                (
                                                    [type] => long
                                                    [encoding] => utf-8
                                                    [value] => FedEx Ground®
                                                )

                                            [1] => stdClass Object
                                                (
                                                    [type] => long
                                                    [encoding] => ascii
                                                    [value] => FedEx Ground
                                                )

                                            [2] => stdClass Object
                                                (
                                                    [type] => medium
                                                    [encoding] => utf-8
                                                    [value] => Ground®
                                                )

                                            [3] => stdClass Object
                                                (
                                                    [type] => medium
                                                    [encoding] => ascii
                                                    [value] => Ground
                                                )

                                            [4] => stdClass Object
                                                (
                                                    [type] => short
                                                    [encoding] => utf-8
                                                    [value] => FG
                                                )

                                            [5] => stdClass Object
                                                (
                                                    [type] => short
                                                    [encoding] => ascii
                                                    [value] => FG
                                                )

                                            [6] => stdClass Object
                                                (
                                                    [type] => abbrv
                                                    [encoding] => ascii
                                                    [value] => SG
                                                )

                                        )

                                    [description] => FedEx Ground
                                    [astraDescription] => FXG
                                )

                        )

                )

            [quoteDate] => 2023-08-02
            [encoded] => 
        )

)
```
</details>


## Contribution
Any help will be useful :) Currently I'm working on Ship, Track and Address Validation API because that's all I need for my own purposes. 
