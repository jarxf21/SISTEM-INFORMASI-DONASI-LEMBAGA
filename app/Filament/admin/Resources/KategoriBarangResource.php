<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\KategoriBarangResource\Pages;
use App\Filament\Admin\Resources\KategoriBarangResource\RelationManagers;
use App\Models\KategoriBarang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriBarangResource extends Resource
{
    protected static ?string $model = KategoriBarang::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Donasi Barang';
    protected static ?string $navigationLabel = 'Kategori Barang ';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            
            Forms\Components\TextInput::make('nama_kategori_barang')
                ->label('Nama Kategori')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->rows(3)
                ->nullable(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id_kategori_barang')->label('ID')->sortable(),
            Tables\Columns\TextColumn::make('nama_kategori_barang')->label('Nama Kategori')->searchable(),
            Tables\Columns\TextColumn::make('deskripsi')->label('Deskripsi')->limit(50),
            Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y H:i')->label('Dibuat'),
        ]);
    }
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKategoriBarangs::route('/'),
            'create' => Pages\CreateKategoriBarang::route('/create'),
            'edit' => Pages\EditKategoriBarang::route('/{record}/edit'),
        ];
    }
}
