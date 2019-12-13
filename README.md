## PSGC API

Live API can be found in http://bkintanar.site. (Will change once I find the time to get a domain)

Postman: https://documenter.getpostman.com/view/78990/SWE3cKFB?version=latest

Data Source: https://psa.gov.ph/classification/psgc/

### Notes from PSGC publication

1. The total number of provinces in the PSGC excludes the four (4) districts of National Capital Region which have been assigned special Province Codes persuant to Presidential Decree No. 921.
2. The City of Isabela and Cotabato City are assigned special Province Codes to show that they are not administratively part of ARMM but part of Region IX (Zamboanga Peninsula) and Region XII (SOCCSKSARGEN) repectively.
3. The sub-municipalities of the City of Manila - Tondo I/II, Binondo, Quiapo, etc., are assigned special municipal codes but not officially considered municipalities.

### Supported endpoints

```
+----------+------------------------------------------+
| Method   | URI                                      |
+----------+------------------------------------------+
| GET|HEAD | api/barangays                            |
| GET|HEAD | api/barangays/{barangay}                 |
| GET|HEAD | api/cities                               |
| GET|HEAD | api/cities/{city}                        |
| GET|HEAD | api/districts                            |
| GET|HEAD | api/districts/{district}                 |
| GET|HEAD | api/municipalities                       |
| GET|HEAD | api/municipalities/{municipality}        |
| GET|HEAD | api/provinces                            |
| GET|HEAD | api/provinces/{province}                 |
| GET|HEAD | api/regions                              |
| GET|HEAD | api/regions/{region}                     |
| GET|HEAD | api/sub-municipalities                   |
| GET|HEAD | api/sub-municipalities/{subMunicipality} |
+----------+------------------------------------------+
```

### Pagination

Default pagination is set to 15 items per page. You can modify this by passing a `per_page=#` as a query parameter.

`/api/regions?per_page=10`

### Includes

#### To include provinces
```
/api/regions?include=provinces
/api/regions/070000000?include=provinces
```

![image](https://user-images.githubusercontent.com/685928/70212704-c2cac280-1772-11ea-8e1e-d2af4ff601f9.png)


#### To include cities, municipalities in a given province
```
/api/provinces?include=cities
/api/provinces?include=municipalities
/api/provinces?include=cities,municipalities
```

![image](https://user-images.githubusercontent.com/685928/70212827-ff96b980-1772-11ea-9b05-a53b049b476a.png)

![image](https://user-images.githubusercontent.com/685928/70212937-32d94880-1773-11ea-8de5-ce18dc8dc8a9.png)

#### To include barangays
```
/api/cities?include=barangays
/api/cities/072217000?include=barangays
/api/municipalities?include=barangays
/api/municipalities/072201000?include=barangays
```

![image](https://user-images.githubusercontent.com/685928/70213145-a2e7ce80-1773-11ea-8cd8-0b65e7757bb3.png)
