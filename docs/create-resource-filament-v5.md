# Step 1 Create Uom Resource

FilamentPHP v5 installed already.please always refer to filamentphp v5 docs.and follow below instructions :

## Navigation

- Navigation Group:"Master Item"
- Navigation Icon: heroicon-o-scale
- Sort: 3
- Globally Searchable

## Form Schema

### Use:

TextInput::make('name')
TextInput::make('code')
TextInput::make('symbol')
Select::make('uom_type_id') (relationship)
Select::make('base_uom_id') (relationship to Uom, exclude self)
TextInput::make('conversion_factor')
