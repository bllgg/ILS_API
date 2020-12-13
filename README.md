# ILS_API
## read data
```
http://localhost/ils_api/<related_file_name>/read.php
```
### example
```
http://localhost/ils_api/esp/read.php
```

## read one data
```
http://localhost/ils_api/<related_file_name>/read_one.php?<related_id>=<id>
```

### example
```
http://localhost/ils_api/esp/read_one.php?esp_device="24:6F:28:A9:64:C8"
```

## insert data
```
http://localhost/ils_api/<related_file_name>/insert.php
```
And need to set the body as follows.
```
{
    "parameter_1" : value_1,
    "parameter_2" : value_2,
    "parameter_3" : value_3,
    "parameter_4" : value_4
}
```
### example:
```
http://localhost/ils_api/device/insert.php
```

```
{
    "device_id" : 555,
    "building_id" : 1,
    "x_position" : 5.6,
    "y_position" : 5.5
}
```