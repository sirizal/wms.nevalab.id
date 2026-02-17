# Please help to create Location Data

Tech stack : Laravel 12 , Postgresql , filamentphp v5
Always follow Documentation Reference : Laravel 12 , filamentphp v5

## Model & Migration

- location_type with column : code (string,unique) , name (string,nullable) , is_physical (boolean,default(true)) , can_store_inventory(boolean,default (false))
- location with column : warehouse_id,parent_id(self reference), location_type_id (foreign_id) , code(string) , name(string,nullable) , level(integer,default(0)) , length(decimal(10,2),nullable) , width(decimal(10,2),nullable) , height(decimal(10,2),nullable) , max_weight(decimal(12,2),nullable) , is_active(boolean,default(true)) , is_locked (boolean,default(false)) , is_picking_area(boolean,default(false)),is_receiving_area(boolean,default(false)) , is_dispatch_area (boolean,default(false)) , temperature_zone(string,nullable)

## Eloquent Relationship

- Location Type HasMany Location , Location BelongsTo Location Type , Location BelongsTo Warehouse
- Warehouse HasMany Location

## Filament v5 Resource

- Create Full Resource using command ('php artisan make:filament-resource LocationType --generate')
- Create Full Resource using command ('php artisan make:filament-resource Location --generate)
- Navigation Group : "Warehouse Data"
- Navigation Icon : refer to Location Type and Location
- Apply the translation to en and id for resource
