![CI](https://github.com/WhatArmy/FedexRest/workflows/CI/badge.svg)

# General Information
Fedex has offered a new Rest API that will replace the already obsolete WSDL and SOAP-based Web Services in the future. The goal of this library is to offer a convenient and easy to use wrapper to this service.

FedEx Rest API documentation https://developer.fedex.com/api/en-us/get-started.html

## Todo
### Services
- [ ] Ship API
   - [ ] Create Shipment ([docs](https://developer.fedex.com/api/en-us/catalog/ship/docs.html#operation/Create%20Shipment))
   - [ ] Cancel Shipment ([docs](https://developer.fedex.com/api/en-us/catalog/ship/docs.html#operation/Cancel%20Shipment))
   - [ ] Create Tag ([docs](https://developer.fedex.com/api/en-us/catalog/ship/docs.html#operation/Create%20Tag))
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
- [ ] Rate Quotes API
- [ ] Service Availability API

### Other
- [x] [oAuth authorization](#authorization)

### Usage
#### Installation
`composer require whatarmy/fedex-rest "^0.3"`
#### Authorization
###### Example
```php
$auth = (new \FedexRest\Authorization\Authorize())
            ->setClientId('some Client ID')
            ->setClientSecret('some Client Secret')
            ->authorize();
```

###### Sample Response
```php
object(stdClass)#85 (4) {
  ["access_token"] => string(980) "eyJhbGciOiJiUzI1NiIsInR5cCIdIkpXVCJ9.eyJzY29wZSI0WyJDWFMiLCJTRUNVUkUiXSwiUGF5bG9hZCI6ImFLcEpEZEJ1MXN4WmY3bEpFOUxxd2g3OEFCZ3FCSzcxa2hvdkRnWHpWWUtTWkR4RjI4Wk5aREtlK1J2U04zaWY2VGJLTTFDdk9wb21ya0JZNHJHTVFtTUlOdVdFWHZVSEdlTUdkMU43bDMxSnpXSVAwQlF4UlFsN0FCMjJOdUNwZHVnNTNuV0d0RzVFQTltR3lET2NCcityeSswMkpUd0c4R3RDS1BYa05uQS8zZmpQWmFkR3JmcE5Na1VvVm9CVkpWaktNOVZ3NGNVSGM1VHZpd1MxSXpVeHY5Y0hzMEIzdnV3cUlRbXFiSlBSVVAyaWljS1JyY3RYTHczOWZqdFZXTHVud1FHZ0xtYk5YMWVyb21oSVEvaHJRQzZMWTJwTHd0bGFaRkdRVzNFPSIsImV4cCI6MTYwMjU5MTg2NiwianRpIjoiNWQ2YzJjOWEtMTAxMy00N2E4LWEwM2UtOTAyZDdmNzhlYjdjIiwiY2xpZW50X2lkIjoibDc2YWMxODQ0YzU2MzA0OGU1ODJhNzkxODcxZjUxZjFmNSJ9.cBjvx6icIl1nx7MnQ9SOvlnlBd_C20maBmMyjJGqIVRMcz5fH3eHiIQ3SkUqCXGo1oCGTG4nBqW9YoPd1aZQt6r8TrbOM3F8vc8jFSMPB9Vd4aYM_9IrDYHeqe43iZcYOJ0kcUzkXA52fxtNhAQ94JzwEeMfWRsAdUK9xt-Ed-_ZYSxEiFPRpcCUDOOv2Qj9DM4sfXnG9v-6XGbQNu02dCXYrfD3LZ7M6nFSfzbSHQ4e6Gvb8CSBh4Q6RI2dOQl7J_qyC37kR1XihlJ7TrNKC5XPn08c2Pzp89jAL_3wTlhBRCSxpJfbgoKocdoBmOCY78YeqtBrTZFQ86wvb2XIqg"
  ["token_type"] => string(6) "bearer"
  ["expires_in"] => int(3599)
  ["scope"] => string(10) "CXS SECURE"
}
```
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
            ->setShipDatestamp(Carbon::now()->addDays(3)->format('Y-m-d'))
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

## Contribution
Any help will be useful :) Currently I'm working on Ship, Track and Address Validation API because that's all I need for my own purposes. 
