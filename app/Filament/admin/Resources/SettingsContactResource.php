<?php
namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SettingsContactResource\Pages;
use App\Models\SettingsContact;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class SettingsContactResource extends Resource
{
    protected static ?string $model = SettingsContact::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $modelLabel = 'Pengaturan Kontak';
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('nomor_wa')
                ->label('Nomor WhatsApp')
                ->required()
                ->unique(ignoreRecord: true)
                ->tel()
                ->maxLength(15),

            TextInput::make('nama_email')
                ->label('Alamat Email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(100),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('nomor_wa')
            ->label('WhatsApp')->searchable(),
            TextColumn::make('nama_email')
            ->label('Email')->searchable(),
            TextColumn::make('updated_at')
            ->label('Diperbarui')
            ->dateTime()
            ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->translatedFormat('l, d F Y , H:i')),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            Tables\Actions\ViewAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

        public static function getPages(): array
        {
            return [
                'index' => Pages\ListSettingsContacts::route('/'),
                'create' => Pages\CreateSettingsContact::route('/create'),
                'edit' => Pages\EditSettingsContact::route('/{record}/edit'),
            ];
        }
}
