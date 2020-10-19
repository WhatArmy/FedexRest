![CI](https://github.com/WhatArmy/FedexRest/workflows/CI/badge.svg)

# General Information
Fedex has offered a new Rest API that will replace the already obsolete WSDL and SOAP-based Web Services in the future. The goal of this library is to offer a convenient and easy to use wrapper to this service.

FedEx Rest API documentation https://developer.fedex.com/api/en-us/get-started.html

## Todo
### Services
- [ ] Ship API
   - [ ] Create Shipment ([docs](https://developer.fedex.com/api/en-us/catalog/ship/v1/docs.html#operation/Create%20Shipment))
   - [ ] Cancel Shipment ([docs](https://developer.fedex.com/api/en-us/catalog/ship/v1/docs.html#operation/Cancel%20Shipment))
   - [ ] Create Tag ([docs](https://developer.fedex.com/api/en-us/catalog/ship/v1/docs.html#operation/Create%20Tag))
   - [ ] Cancel Tag ([docs](https://developer.fedex.com/api/en-us/catalog/ship/v1/docs.html#operation/CancelTag))
- [ ] Track API
   - [x] [By Tracking Number](#track-by-tracking-number) ([docs](https://developer.fedex.com/api/en-us/catalog/track/v1/docs.html#operation/Track%20by%20Tracking%20Number))
   - [ ] Track Document
   - [ ] Track Multiple Piece Shipment
   - [ ] Send Notification
   - [ ] Track By Tracking Control Number
   - [ ] Track By References
- [ ] Address Validation API 
- [ ] FedEx Locations Search API 
- [ ] Ground End of Day Close API
- [ ] Pickup Request API
- [ ] Postal Code Validation API
- [ ] Rate Quotes API
- [ ] Service Availability API

### Other
- [x] [oAuth authorization](#authorization)

### Usage
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
            ->setAccessToken($this->auth->authorize()->access_token)
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
## Contribution
Any help will be useful :) Currently I'm working on Ship,Track and Address Validation API because that's all I need for my own purposes. 
