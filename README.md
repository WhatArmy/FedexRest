# General Information
Fedex has offered a new Rest API that will replace the already obsolete WSDL and SOAP-based Web Services in the future. The goal of this library is to offer a convenient and easy to use wrapper to this service.

FedEx Rest API documentation https://developer.fedex.com/api/en-us/get-started.html

## Todo
### Services
- [ ] Ship API
- [ ] Track API
   - [x] by tracking number
- [ ] Address Validation API 
- [ ] FedEx Locations Search API 
- [ ] Ground End of Day Close API
- [ ] Pickup Request API
- [ ] Postal Code Validation API
- [ ] Rate Quotes API
- [ ] Service Availability API

### Other
- [x] oAuth authorization

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

## Contribution
Any help will be useful :) Currently I'm working on Ship,Track and Address Validation API because that's all I need for my own purposes. 
