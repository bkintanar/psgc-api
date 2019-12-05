## How to use the PSGC API

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
