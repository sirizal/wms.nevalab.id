<?php

namespace App\Filament\Resources\Items\Pages;

use App\Exports\SkippedItemsExport;
use App\Filament\Resources\Items\ItemResource;
use App\Imports\ItemImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ListItems extends ListRecords
{
    protected static string $resource = ItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('importItems')
                ->label('Import')
                ->icon('heroicon-m-arrow-up-tray')
                ->schema([
                    FileUpload::make('file')
                        ->label('Excel File')
                        ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                        ->required(),
                ])
                ->action(function (array $data): void {
                    $user = Auth::user();
                    $file = $data['file'];

                    $importer = new ItemImport;
                    Excel::import($importer, $file);

                    $skippedRows = $importer->getSkippedRows();

                    if (! empty($skippedRows)) {
                        $fileName = 'skipped_items_'.now()->format('Y_m_d_H_i_s').'.xlsx';

                        Excel::store(new SkippedItemsExport($skippedRows), 'exports/'.$fileName, 'public');

                        $user->notify(
                            Notification::make()
                                ->title('Import Completed with Skipped Rows')
                                ->body('Imported successfully. '.(count($importer->getSkippedRows())).' row(s) skipped due to duplicate slug.')
                                ->actions([
                                    Action::make('download')
                                        ->label('Download Skipped Rows')
                                        ->url(asset('storage/exports/'.$fileName))
                                        ->openUrlInNewTab(),
                                ])
                                ->warning()
                                ->toDatabase()
                        );
                    } else {
                        $user->notify(
                            Notification::make()
                                ->title('Import Successful')
                                ->body('Items have been imported successfully.')
                                ->success()
                                ->toDatabase()
                        );
                    }
                }),
        ];
    }
}
