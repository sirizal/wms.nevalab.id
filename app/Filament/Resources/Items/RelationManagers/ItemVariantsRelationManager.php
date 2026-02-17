<?php

namespace App\Filament\Resources\Items\RelationManagers;

use App\Filament\Resources\Items\Resources\ItemVariants\ItemVariantResource;
use App\Models\Item;
use App\Models\ItemVariant;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ItemVariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';

    protected static ?string $relatedResource = ItemVariantResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('sku')
                    ->label(__('filament.resources.items.relations.item_variants.fields.sku'))
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('customer_code')
                    ->label(__('filament.resources.items.relations.item_variants.fields.customer_code')),
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.resources.items.relations.item_variants.fields.name')),
                Forms\Components\TextInput::make('selling_price')
                    ->label(__('filament.resources.items.relations.item_variants.fields.selling_price'))
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('cost_price')
                    ->label(__('filament.resources.items.relations.item_variants.fields.cost_price'))
                    ->numeric(),
                Forms\Components\TextInput::make('stock_qty')
                    ->label(__('filament.resources.items.relations.item_variants.fields.stock_qty'))
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('min_stock_qty')
                    ->label(__('filament.resources.items.relations.item_variants.fields.min_stock_qty'))
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label(__('filament.resources.items.relations.item_variants.fields.is_active'))
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sku')
                    ->label(__('filament.resources.items.relations.item_variants.fields.sku'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_code')
                    ->label(__('filament.resources.items.relations.item_variants.fields.customer_code'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.items.relations.item_variants.fields.name'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('selling_price')
                    ->label(__('filament.resources.items.relations.item_variants.fields.selling_price'))
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock_qty')
                    ->label(__('filament.resources.items.relations.item_variants.fields.stock_qty'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament.resources.items.relations.item_variants.fields.is_active'))
                    ->boolean(),
            ])
            ->headerActions([
                Actions\CreateAction::make()
                    ->url(fn (): string => ItemVariantResource::getUrl('create', [
                        'item' => $this->getOwnerRecord(),
                    ]))
                    ->visible(fn (): bool => ! $this->getOwnerRecord()->itemOptions()->exists()),
                Actions\Action::make('generateVariants')
                    ->label('Generate Variants')
                    ->icon('heroicon-o-sparkles')
                    ->action(function (): void {
                        $this->generateVariants();
                    })
                    ->visible(fn (): bool => $this->getOwnerRecord()->itemOptions()->exists()),
            ])
            ->recordActions([
                EditAction::make()
                    ->url(fn ($record): string => ItemVariantResource::getUrl('edit', [
                        'item' => $this->getOwnerRecord(),
                        'record' => $record,
                    ])),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function generateVariants(): void
    {
        /** @var Item $item */
        $item = $this->getOwnerRecord();

        $options = $item->itemOptions()->with('values')->get();

        if ($options->isEmpty()) {
            Notification::make()
                ->warning()
                ->title('No Options Found')
                ->body('Please add options to this item first.')
                ->send();

            return;
        }

        $optionValuesCollection = $options->pluck('values');

        $combinations = $this->cartesian($optionValuesCollection->toArray());

        $existingVariantKeys = $item->variants()
            ->with('optionValues')
            ->get()
            ->map(fn (ItemVariant $variant) => $variant->getVariantKey())
            ->toArray();

        $newVariantsCount = 0;
        $skippedVariantsCount = 0;

        foreach ($combinations as $combination) {
            $optionValueIds = array_column($combination, 'id');
            $variantKey = ItemVariant::buildVariantKey($optionValueIds);

            if (in_array($variantKey, $existingVariantKeys)) {
                $skippedVariantsCount++;

                continue;
            }

            $sku = ItemVariant::generateSku($item, $combination);

            $variant = ItemVariant::create([
                'item_id' => $item->id,
                'sku' => $sku,
                'name' => implode(' / ', array_column($combination, 'value')),
                'selling_price' => 0,
                'cost_price' => 0,
                'stock_qty' => 0,
                'min_stock_qty' => 0,
                'is_active' => true,
            ]);

            $variant->syncOptionValues($optionValueIds);

            $existingVariantKeys[] = $variantKey;
            $newVariantsCount++;
        }

        Notification::make()
            ->title('Variants Generated')
            ->body("Created {$newVariantsCount} new variants. Skipped {$skippedVariantsCount} existing variants.")
            ->success()
            ->send();

        $this->dispatch('refreshTable');
    }

    protected function cartesian(array $arrays): array
    {
        if (empty($arrays)) {
            return [[]];
        }

        $result = [[]];

        foreach ($arrays as $index => $currentArray) {
            $append = [];

            foreach ($result as $product) {
                foreach ($currentArray as $item) {
                    $product[$index] = $item;
                    $append[] = $product;
                }
            }

            $result = $append;
        }

        return $result;
    }
}
