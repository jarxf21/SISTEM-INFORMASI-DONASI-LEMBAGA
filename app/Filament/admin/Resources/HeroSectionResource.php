<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HeroSectionResource\Pages;
use App\Filament\Admin\Resources\HeroSectionResource\RelationManagers;
use App\Models\HeroSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class HeroSectionResource extends Resource
{
    protected static ?string $model = HeroSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Pengaturan Beranda';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $tableWrapperWidth = 'full';

    public static function form(Form $form): Form
     {
    return $form->schema([
        TextInput::make('judul')->required()->label('Judul Hero'),
        Textarea::make('deskripsi')->required()->label('Deskripsi Hero'),
        FileUpload::make('gambar')
        ->image()->directory('hero')
        ->previewable(true)
        ->label('Gambar Hero'),
    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->sortable()->searchable(),
                TextColumn::make('deskripsi')->limit(50),
                ImageColumn::make('gambar')->disk('public'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroSections::route('/'),
            'create' => Pages\CreateHeroSection::route('/create'),
            'edit' => Pages\EditHeroSection::route('/{record}/edit'),
        ];
    }
    public static function canCreate(): bool
    {
    return HeroSection::count() === 0;
    }
}