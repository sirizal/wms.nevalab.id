# Please help to create Warehouse Data

Tech stack : Laravel 12 , Postgresql , filamentphp v5
Always follow Documentation Reference : Laravel 12 , filamentphp v5

## Model & Migration

- Warehouse with column : id,company_id,code,name,person_in_charge,phone_no,address,country_id,province_id,district_id,sub_district_id,village_id,postal_code,latitude,longitude,is_active,is_rent,rent_period(numeric),rent_cost(decimal(15,2)),rent_expired (datetime),square_meter

## Eloquent Relationship

- Company HasMany Warehouse , Warehouse BelongsTo Company
- Warehouse make relation to country, province,district,subdistrict,village,person_in_charge to employee table

## Filament v5 Resource

- Create Full Resource using command ('php artisan create:filament-resource Warehouse --generate')
- Create dependent select for Country , province , district , subdistrict , village on WarehouseForm
- Navigation Group : "Warehouse Data"
- Navigation Icon : refer to warehouse
- Apply the translation to en and id for resource
